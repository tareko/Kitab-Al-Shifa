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
 * 			2 - Rejected
 * 			3 - Accepted
 */
class TradesDetail extends AppModel {
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
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'A user being traded to is required',
				'allowEmpty' => false,
				//'required' => false,
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

	public function getUnprocessedTradesDetail($tradeId = NULL, $conditions = array()) {
		return $this->find('all', array(
				'recursive' => 0,
//				'contain' => array('User'),
				'conditions' => array_merge(
						array(
							'TradesDetail.status' => 0,
							'TradesDetail.trade_id' => $tradeId),
						$conditions),
		));
	}


	/**
	 * Function to process trades
	 * @param array $trade
	 * @return boolean
	 */
	public function processTrade ($tradeId = NULL) {
		$this->User = new User();
		App::import('Lib', 'TradeRequest');
		$this->_TradeRequest = new TradeRequest();
		//Return false if no $trade is given. We really don't want to process all trades
		if (!isset($tradeId)) {
			return false;
		}
		//Find unprocessed trade details within the trade
		$tradeList = $this->getUnprocessedTradesDetail($tradeId['Trade']['id']);
		foreach ($tradeList as $trade) {
			$toUser = $trade['User'];
			$fromUser = $tradeId['User'];
			$method = 'email';
			//Get communication method preference for receiving user
			$method = $this->User->getCommunicationMethod($toUser);
			//Send out communication to receiving user
			$this->_TradeRequest->send($fromUser, $toUser, $method);
			//Assuming success, update Status to 1
		}
	}

}
