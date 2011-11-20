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
	public $actsAs = array('Search.Searchable');
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
		'physician_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a physician',
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
		'Physician' => array(
			'className' => 'Physician',
			'foreignKey' => 'physician_id',
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
		),
	);

/* 	public $hasAndBelongsToMany = array(
		'Shift' => array(
			'className' => 'Shift',
			'joinTable' => 'calendars_shifts',
			'foreignKey' => 'calendar_id',
			'associationForeignKey' => 'shift_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
 */
	//public $order = array("Shift.date" => "ASC", "ShiftsType.location_id" => "ASC", "ShiftsType.shift_start" => "ASC", "ShiftsType.shift_end" => "ASC");
	public $order = array("Shift.date" => "ASC");
	var $virtualFields = array(
		'day' => 'DAY(Shift.date)',
	);	
}
