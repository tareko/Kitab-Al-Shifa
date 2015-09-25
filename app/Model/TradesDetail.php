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

	/**
	 * Change status of trade detail
	 * @param array $request
	 * @param integer $status
	 * @throws NotFoundException
	 */
	public function changeStatus($request = array(), $status = false) {
		App::import('Lib', 'TradeRequest');
		$this->_TradeRequest = new TradeRequest();

		$token = $request->query['token'];
		$id = $request->query['id'];

		$tradesDetail = $this->find('first', array(
				'fields' => array(
						'TradesDetail.id',
						'TradesDetail.token',
						'TradesDetail.trade_id',
						'TradesDetail.status',
						'TradesDetail.user_id'),
				'conditions' => array(
						'TradesDetail.id' => $id),
				'contain' => array(
						'User' => array(
								'fields' => array(
										'id',
										'name',
										'email'
								)
						),
						'Trade' => array(
								'fields' => array(
										'status',
										'user_status',
										'shift_id'),
								'TradesDetail' => array(
										'fields' => array('status')
								),
								'Shift' => array(
										'fields' => array(
												'id',
												'date'),
										'ShiftsType' => array(
												'fields' => array(
														'times'),
												'Location' => array(
														'location'
												)
										)
								),
								'User' => array(
										'fields' => array(
												'id',
												'name',
												'email'
										)
								)
						)
				)
		));


		//Error exits
		// Error if $tradesDetail is empty
		if (empty($tradesDetail)) {
			return 'Trade not found';
		}

		elseif (!is_numeric($status)) {
			return 'Improper status was given to this function';
		}

		// Error if token is wrong
		elseif ($token != $tradesDetail['TradesDetail']['token']) {
			return 'Sorry, but your token is wrong. You are not authorized to act on this trade.';
		}

		// Error if trade status != 1

		if ($tradesDetail['Trade']['status'] ==  0) {
			return 'This trade has not been processed yet[1]';
		}

		if ($tradesDetail['Trade']['user_status'] !=  2) {
				return 'This trade has not been processed yet[2]';
			}

		// Error if tradesDetail status != 1
		elseif ($tradesDetail['TradesDetail']['status'] != 1) {
			if ($tradesDetail['TradesDetail']['status'] == 0) {
				return 'This trade has not been processed yet[3]';
			}
			elseif ($tradesDetail['TradesDetail']['status'] == 2) {
				return 'You have already accepted this trade';
			}
			elseif ($tradesDetail['TradesDetail']['status'] == 3) {
				return 'You have already rejected this trade';
			}
			else {
				return 'An error occurred with this trade[1]';
			}
		}

		// Check to see if the trade has already been taken by somebody else. If so,
		// then render that page and exit.
		$alreadyTaken = $this->alreadyTaken($tradesDetail);
		if ($alreadyTaken['return']) {
			return 'This shift has already been taken by '.$alreadyTaken['user']['name'];
		}

		$this->read(null, $id);
		$this->set('status', $status);
		if ($this->save()) {

			$this->_TradeRequest->sendRecipientStatusChange($status, $tradesDetail);
			CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Changed status to '. $status);
			return true;
		}
		else {
			CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Error changing status');
			return 'An error has occured during your request[1]';
		}
	}

	/**
	 * Tests if the trade is already complete or another user has taken it
	 **/

	public function alreadyTaken($tradesDetail) {
		foreach ($tradesDetail['Trade']['TradesDetail'] as $detail) {
			if ($detail['status'] == 2) {
				return array(
						'return' => true,
						'user' => $detail['User']);
			}
		}
		return array('return' => false);
	}
}
