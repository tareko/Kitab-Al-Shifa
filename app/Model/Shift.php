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
			'checkMultipleUnique' => array(
				'rule' => array('checkMultipleUnique', array('date', 'shifts_type_id')),
				'message' => 'There is already another shift that matches this one. Please select a different date or shift.'
			),
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
		$this->Calendar = ClassRegistry::init('Calendar');
		$masterSet['calendar'] = $this->Calendar->findById($calendar);
		$masterSet['calendar']['lastupdated'] = $this->Calendar->lastUpdated($calendar);

		$idCondition = (isset($id) ? array('Shift.user_id' => $id) : array());

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
				) + $idCondition
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
	 * Get all physicians who worked any shifts during a certain period
	 *
	 * @param unknown $start_date
	 * @param unknown $end_date
	 */

	function usersWhoWorkedShifts($start_date = NULL, $end_date = NULL) {
		$options = array(
				'conditions' => array(
						'date >=' => $start_date,
						'date <=' => $end_date,
						),
				'fields'=>array(
						'user_id',
				),
				'contain' => array(
						'User' => array(
								'fields' => 'name'
						)
				),
				'group' => 'user_id',
				'recursive' => -1,
		);
		return $this->find('all', $options);
	}

	/**
	 * The shifts worked by a one or more users
	 *
	 * @param array $user
	 * @param unknown_type $start_date
	 * @param unknown_type $end_date
	 * @param array $conditions
	 * @return array $output
	 */
	function shiftsWorkedbyUser ($users = array(), $start_date = NULL, $end_date = NULL, $conditions = array()) {
		$return = array();
		foreach($users as $user) {
			$conditionsUser = array_merge($conditions, array(
				'User.id' => $user['Shift']['user_id'],
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
			$return[$user['Shift']['user_id']] = $this->User->find('all', array(
					'contain' => array(
							'Shift' => array(
									'fields' => array('id', 'date'),
									'conditions' => $conditionsShift,
									'ShiftsType' => array(
										'fields' => array('id', 'shift_start', 'shift_end'),
										'Location' => array(
											'fields' => 'id')),
									)),
					'conditions' => $conditionsUser,
					'recursive' => '3',
			));
		}
		return $return;
	}

	/**
	 * The hours worked by one or more users
	 *
	 * @param array $users
	 * @param unknown_type $start_date
	 * @param unknown_type $end_date
	 * @param array $conditions
	 * @return array $output
	 */

	function secondsWorkedbyUser ($users = array(), $start_date = NULL, $end_date = NULL, $conditions = array()) {
		$return = array();
		foreach($users as $user) {
			$profiles = $this->shiftsWorkedbyUser(array($user), $start_date, $end_date, $conditions);
			foreach ($profiles as $profile) {
				$secondsWorked = array();
				foreach($profile['0']['Shift'] as $shift) {
					// More usable variables for end and start times
					$start = $shift['ShiftsType']['shift_start'];
					$end = $shift['ShiftsType']['shift_end'];

					// Calculate time worked in seconds per location
					$secondsWorked[$shift['ShiftsType']['Location']['id']] = (isset($secondsWorked[$shift['ShiftsType']['Location']['id']]) ? $secondsWorked[$shift['ShiftsType']['Location']['id']] : 0) + ($end < $start ? strtotime($end . " + 24 hours") : strtotime($end)) - strtotime($start);
				}
			}
			$return[$user['Shift']['user_id']] = $secondsWorked;
		}
		return $return;
	}

	function secondsToHours ($seconds = null) {
		$hours = array();
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

	/**
	 * Check multiple fields to see if they are unique
	 *
	 * @param array $data
	 * @param array $fields
	 * @return boolean
	 */
	function checkMultipleUnique ($data, $fields) {
		$data = $this->data;
		if (!is_array($fields)) {
			$fields = array($fields);
		}
		return $this->isUnique($fields, false);
	}

	/**
	 * Import function to import shifts into database
	 */
	function import ($filename = null, $calendar = null, $discard = 3) {
		// Get start dates for file
		App::uses('Calendar', 'Model');
		$this->Calendar = new Calendar();
		if (is_null($calendar) || !isset($calendar) || empty($calendar) || empty($filename) || is_null($filename)) {
			return false;
		}
		$calendar = $this->Calendar->getStartEndDates($calendar);
		if (!$calendar) {
			return false;
		}

		// Get all shift types for calendar

		// Open the file
		ini_set('track_errors', 1);
		if (($handle = fopen($filename, "r")) === FALSE) {
			throw new NotFoundException("Failed opening file: error was ".$php_errormsg);
		}

		// Start parsing for shifts
		$data = array();
		$output = array();

		$row = 1;

		$shiftsType = $this->ShiftsType->find('all', array(
				'fields' => array('id', 'display_order'),
				'recursive' => 0,
				'conditions' => array(
						'start_date <=' => $calendar['start_date'],
						'expiry_date >=' => $calendar['start_date'],
				),
				'order' => array('display_order ASC', 'shift_start ASC'),
		));

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			// Discard first N lines. If none present, select 3
			if ($row <= $discard) { $row++ ; continue; }
			$num = count($data);
			$date = date ( 'Y-m-j', strtotime( '+'.$row - $discard - 1 .' day', strtotime($calendar['start_date'])));
			for ($c=0; $c < $num; $c++) {
				// Discard first column
				if ($c == 0) { continue; }

				// If blank, continue
				if (empty($data[$c])) { continue; }

				// Look up user ID if entry not blank
				$userId = $this->User->lookupUserId($data[$c], 'cb_displayname');

				// If entry is not found, skip to next entry and leave blank.
				if ($userId == false) { continue ; }

				$output[] = array(
						'user_id' => $userId,
						'date' => $date,
						'shifts_type_id' => $shiftsType[$c-1]['ShiftsType']['id']
						);

				// Save information into overall save array (shifts_type and user_id)
			}
			$row++;
		}
		fclose($handle);
		return $output;
	}
}