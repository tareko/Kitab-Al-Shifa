<?php
/**
 * Shift Model
 *
 * @property Physician $Physician
 * @property ShiftsType $ShiftsType
 */
class Shift extends AppModel {

/**
 * 	Search plugin initialization
 */
	public $actsAs = array('Search.Searchable', 'Containable');
	public $filterArgs = array(
		array('name' => 'month', 'type' => 'value', 'field' => 'MONTH(Shift.date)'),
		array('name' => 'year', 'type' => 'value', 'field' => 'YEAR(Shift.date)'),
		array('name' => 'location', 'type' => 'value', 'field' => 'ShiftsType.location_id'),
		);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a person working the shift',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Please enter a shift date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shifts_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select the type of shift',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ShiftsType' => array(
			'className' => 'ShiftsType',
			'foreignKey' => 'shifts_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * HasMany associations
 *
 * @var array
 */
	public $hasMany = array(
			'Trade' => array(
					'className' => 'Trade',
					'foreignKey' => 'shift_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
	);

	//public $order = array("Shift.date" => "ASC", "ShiftsType.location_id" => "ASC", "ShiftsType.shift_start" => "ASC", "ShiftsType.shift_end" => "ASC");
	public $order = array("Shift.date" => "ASC");
	var $virtualFields = array(
		'day' => 'DAY(Shift.date)',
	);

	/**
	* Function to get a list of shifts
	*
	* @param mixed Conditions for the SQL search in array form
	* @return mixed An array of location id's and abbreviated names.
	*/
	function getShiftList($conditions) {
		return $this->find('all', array(
				'contain' => array(
					'ShiftsType' => array(
						'fields' => array('id', 'shift_start', 'shift_end'),
						'Location' => array(
							'fields' => 'location')),
					'User' => array(
							'fields' => array('name'),
							'Profile' => array(
									'fields' => array('cb_displayname', 'cb_ohip')
				))),
				'conditions' => $conditions,
				'recursive' => '2',
			));

	}

	function getMasterSet ($calendar = NULL, $id = NULL) {
		App::uses('Calendar', 'Model');
		$this->Calendar = new Calendar();
		$masterSet['calendar'] = $this->Calendar->findById($calendar);
		$masterSet['calendar']['lastupdated'] = $this->Calendar->lastUpdated($calendar);

		$shiftList = $this->find('all', array(
				'contain' => array(
						'ShiftsType' => array(
								'fields' => array('id')),
						'ShiftsType.Location' => array(
								'fields' => array('Location.id')),
						'User' => array(
								'fields' => array('id', 'username')),
						'User.Profile' => array(
								'fields' => array('Profile.cb_displayname'))
				),
				'conditions' => array(
						'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
						'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
						'Shift.user_id' => $id,
				)
		));

		$locations_raw = $this->ShiftsType->Location->find('all', array(
				'fields' => array('Location.id', 'Location.location', 'Location.abbreviated_name'),
				'recursive' => '0'
		));
		foreach ($locations_raw as $location) {
			$masterSet['locations'][$location['Location']['id']]['location'] = $location['Location']['location'];
			$masterSet['locations'][$location['Location']['id']]['abbreviated_name'] = $location['Location']['abbreviated_name'];
		}
		$masterSet['ShiftsType'] = $this->ShiftsType->find('all', array(
				'fields' => array('ShiftsType.times', 'ShiftsType.location_id', 'ShiftsType.display_order'),
				'conditions' => array(
						'ShiftsType.start_date <=' => $masterSet['calendar']['Calendar']['start_date'],
						'ShiftsType.expiry_date >=' => $masterSet['calendar']['Calendar']['start_date'],
				),
				'order' => array('ShiftsType.display_order ASC', 'ShiftsType.shift_start ASC'),
		));

		foreach ($shiftList as $shift) {
			if (!isset($shift['User']['Profile']['cb_displayname'])) {
				$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => '', 'id' => $shift['Shift']['id']);
			}
			else {
				$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['User']['Profile']['cb_displayname'], 'id' => $shift['Shift']['id']);
			}
		}
		return $masterSet;
	}

	/**
	 * The shifts worked by a physician (or several physicians) by OHIP Number
	 *
	 * @param unknown_type $healthcare_provider
	 * @param unknown_type $start_date
	 * @param unknown_type $end_date
	 * @param array $conditions
	 * @return array $output
	 */
	function shiftsWorkedbyOhipNumber ($healthcare_provider = NULL, $start_date = NULL, $end_date = NULL, $conditions = array()) {
		$conditionsProfile = array_merge($conditions, array(
			'Profile.cb_ohip' => $healthcare_provider,
		));
		$conditionsShift = array();
		if ($start_date) {
			$conditionsShift = array_merge($conditionsShift, array(
					'Shift.date >=' => $start_date
					));
		}
		if ($end_date) {
			$conditionsShift = array_merge($conditionsShift, array(
					'Shift.date <=' => $end_date,
					));
		}

		return $this->User->Profile->find('all', array(
				'contain' => array(
						'Shift' => array(
								'fields' => array('id', 'date'),
								'conditions' => $conditionsShift,
								'ShiftsType' => array(
									'fields' => array('id', 'shift_start', 'shift_end'),
									'Location' => array(
										'fields' => 'location')),
								'User' => array(
									'fields' => array('name'),
								))),
				'fields' => array('cb_ohip'),
				'conditions' => $conditionsProfile,
				'recursive' => '3',
		));

	}

	/**
	 * The hours worked by a physician (or several physicians) by OHIP Number
	 *
	 * @param unknown_type $healthcare_provider
	 * @param unknown_type $start_date
	 * @param unknown_type $end_date
	 * @param array $conditions
	 * @return array $output
	 */

	function secondsWorkedbyOhipNumber ($healthcare_provider = NULL, $start_date = NULL, $end_date = NULL, $conditions = array()) {
		$secondsWorked = array();
		$profiles = $this->shiftsWorkedbyOhipNumber($healthcare_provider, $start_date, $end_date, $conditions);
		foreach ($profiles as $profile) {
			foreach($profile['Shift'] as $shift) {
				// More usable variables for end and start times
				$start = $shift['ShiftsType']['shift_start'];
				$end = $shift['ShiftsType']['shift_end'];

				// Calculate time worked in seconds per location
				$secondsWorked[$shift['ShiftsType']['Location']['location']] = (isset($secondsWorked[$shift['ShiftsType']['Location']['location']]) ? $secondsWorked[$shift['ShiftsType']['Location']['location']] : 0) + ($end < $start ? strtotime($end . " + 24 hours") : strtotime($end)) - strtotime($start);
			}
		}
		return $secondsWorked;

	}

	function secondsToHours ($seconds = null) {
		if (is_array($seconds)) {
			foreach ($seconds as $id => $second) {
				$hours[$id] = $second / 3600;
			}
		}
		else {
			$hours = $seconds / 3600;
		}
		return $hours;
	}
}
