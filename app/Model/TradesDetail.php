<?php
App::uses('AppModel', 'Model');
/**
 * TradesDetail Model
 *
 * @property User $User
 * @property Trade $Trade
 * @property User $User
 * Status:	0 - Unprocessed
 * 			1 - Request sent; awaiting reply
 * 			2 - Accepted
 * 			3 - Rejected
 */
class TradesDetail extends AppModel {
	public $actsAs = array('Search.Searchable', 'Containable');
	public $order = array('updated' => 'DESC');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'trade_id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
 		'trade_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The linked trade must be known',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'A user being traded to is required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The format in which the status was submitted is incorrect',
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
		'Trade' => array(
			'className' => 'Trade',
			'foreignKey' => 'trade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
