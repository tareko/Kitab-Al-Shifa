<?php
App::uses('AppModel', 'Model');
/**
 * Trade Model
 *
 * @property Users $Users
 * @property Shifts $Shifts
 *
 * Status legend:
 * 	0 - Unprocessed
 *  1 - In progress
 *  2 - Complete
 *  3 - Cancelled
 *
 * User_status legend:
 * 	0 - Unprocessed
 *  1 - Email sent
 *  2 - Accepted
 *  3 - Rejected
 *
 */
class Trade extends AppModel {

	/**
	 * 	Search plugin initialization
	 */
	public $actsAs = array('Search.Searchable', 'Containable');
	public $components = array('sendTradeRequest');
	public $findMethods = array('tradeIndex' => true);
	public $order = array('Trade.updated' => 'DESC');
 	public $filterArgs = array(
/* 			array('name' => 'month', 'type' => 'value', 'field' => 'MONTH(Shift.date)'),
			array('name' => 'year', 'type' => 'value', 'field' => 'YEAR(Shift.date)'),
			array('name' => 'location', 'type' => 'value', 'field' => 'ShiftsType.location_id'),
 */	);

/**
 * Validation rules
 *
 * @var array
 */

 	//TODO: Add a validation rule so that a shift must actually belong to a user for him/her to
 	// trade it away - form security stuff

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a proper shift (numeric)',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Please select a proper shift (notempty)',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shift_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a proper shift (numeric)',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select a proper shift (notempty)',
				//'allowEmpty' => false,
				'required' => true,
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
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
	public $hasMany = array(
		'TradesDetail' => array(
			'className' => 'TradesDetail',
			'foreignKey' => 'trade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));

	public function getUnprocessedTrades($conditions = array()) {
		return $this->find('all', array(
				'recursive' => 3,
				'contain' => array(
						'Shift' => array(
								'fields' => array(
										'id',
										'date'),
								'ShiftsType' => array(
										'fields' => array(
												'times'),
										'Location' => array(
												'location')
										)
								),
						'TradesDetail' => array(
								'User' => array(
										'fields' => array(
												'id',
												'name',
												'email')
										)
								),
						'User' => array(
								'fields' => array(
										'id',
										'name',
										'email'),
								),
						),
				'conditions' => array_merge(
						array('status' => 0),
						$conditions),
		));
	}
}