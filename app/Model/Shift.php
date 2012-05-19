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
									'fields' => array('cb_displayname')
				))),
				'conditions' => $conditions,
				'recursive' => '2',
			));

	}
}
