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
				'message' => 'Please select a proper user (numeric)',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please select a proper user (notBlank)',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		'checkConfirmAndMultiple' => array(
				'rule' => array('checkConfirmAndMultiple'),
				'message' => 'You cannot bypass confirmation when there are multiple recipients',
				'required' => true,
			)
		),
		'shift_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a proper shift',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please select a proper shift',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkDuplicate' => array(
				'rule' => 'checkDuplicate',
				'message' => 'This shift is already in the process of being traded! Please cancel the pre-existing trade before trying to trade this shift again'
			),
			'checkShiftExists' => array(
				'rule' => 'checkShiftExists',
				'message' => 'This shift does not exist'
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
		'SubmittedUser' => array(
			'className' => 'User',
			'foreignKey' => 'submitted_by',
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
												'location',
												'abbreviated_name')
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
						'SubmittedUser' => array(
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

	/*
	 * Check duplicate trade and return true if duplicate found
	*
	*/
	public function checkDuplicate($check) {
		$trade = $this->find('first', array(
				'fields' => array(
						'Trade.user_id',
						'Trade.shift_id',
						'Trade.user_status',
						'Trade.status'),
				'conditions' => array(
						'Trade.user_status <' => 2,
						'Trade.status !=' => 2,
						'Trade.user_id' => $this->data['Trade']['user_id'],
						'Trade.shift_id' => $this->data['Trade' ]['shift_id']),
		));
		return ($trade ? false : true);
	}
	
	/*
	 * Check if a shift exists in shift model
	 * 
	 */
	public function checkShiftExists(){
		return $this->Shift->exists($this->data[$this->alias]['shift_id']);
	}
	
	/* 
	 * Don't allow "no confirmation messages" if multiple recipients
	 */
	
	public function checkConfirmAndMultiple() {
		if ($this->data['Trade']['confirmed'] == 1 && count($this->data['TradesDetail']) > 1) {
			$multiple = true;
		}
		else { $multiple = false; }
		return ($multiple ? false : true);
	}
	
	/*
	 * Process pending trades
	 */
	
	public function processTrades() {
		$failure = false;
		// Set up libraries and get pending Trades
		App::import('Lib', 'TradeRequest');
		$this->_TradeRequest = new TradeRequest();
		$unprocessedTrades = $this->getUnprocessedTrades();
		
		//Find unprocessed trade details within the trade
		foreach ($unprocessedTrades as $trade) {

			// The trade must be approved by the originator in one of two ways:
			// - Originator initiates the trade (from user account)
			// - Originator confirms trade (if sent by another party)

			if ($trade['Trade']['user_status'] < 1) {
				//TODO: Stubbed as 'email' for now. Eventually will allow user choice through getCommunicatinoMethod
				//Get communication method preference for receiving user

				$method = $this->User->getCommunicationMethod($trade['User']['id']);

				// If trade does not need confirmation, skip confirmation messages and set appropriate flags for completion.
				// Send email to originating and receiving users telling them deal is done.

				if ($trade['Trade']['confirmed'] == 1) {

					// Send email confirming that trade has been made
					$sendOriginatorConfirmed = $this->_TradeRequest->send($trade['User'], $trade, $trade['TradesDetail'], $method, 'tradeCompleteConfirmedOriginator', '[pre-Confirmed] Shift trade has been made: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
					$sendRecipientConfirmed = $this->_TradeRequest->send($trade['TradesDetail']['User'], $trade, $trade['TradesDetail'], $method, 'tradeCompleteConfirmedRecipient', '[pre-Confirmed] Shift trade has been made: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
					if ($sendOriginatorConfirmed && $sendRecipientConfirmed) {
						// Assuming success, update Status of Trade to 1
						$this->read(null, $trade['Trade']['id']);
						$this->set('user_status', 2);
						$this->set('status', 2);
						$this->validator()->remove('shift_id', 'checkDuplicate');

						if ($this->save()) {
							// Write log indicating trade detail was done
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email confirmation was sent to '. $trade['User']['name'] .' and ' . $trade['TradesDetail'][0]['User']['name'] . ' confirming the trade');
						} else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED, but an email confirmation was sent to '. $trade['User']['name'] .' and ' . $trade['TradesDetail'][0]['User']['name'] . ' confirming the trade');
							debug($this->validationErrors);
							$failure = true;
						}
					}
					else {
						CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email confirmation FAILED to '. $trade['User']['name'] .' and ' . $trade['TradesDetail']['0']['User']['name'] . ' confirming the trade');
					}
				}
				
				else {
					
					// When user has submitted trade request, skip originator confirmation and
					// Go onto DB writes
					if ($trade['Trade']['submitted_by'] == $trade['Trade']['user_id']) {
						// Update Status of Trade to 1
						$this->read(null, $trade['Trade']['id']);
						$this->set('user_status', 2);
						$this->validator()->remove('shift_id', 'checkDuplicate');

						if ($this->save()) {
							// Write log indicating trade detail was done
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; Changed status to 1. No confirmation sent');
						} else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED. Did not successfully change status to 1');
							$failure = true;
						}
					}

					else {
						$sendOriginator = $this->_TradeRequest->send($trade['User'], $trade, $trade['TradesDetail'], $method, 'tradeRequestOriginator', 'Request to trade your shift: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
						if ($sendOriginator['return'] == true) {
							// Assuming success, update Status of Trade to 1
							$this->read(null, $trade['Trade']['id']);
							$this->set('user_status', 1);
							$this->set('token', $sendOriginator['token']);
							$this->validator()->remove('shift_id', 'checkDuplicate');
							
							if ($this->save()) {			
								// Write log indicating trade detail was done
								CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email was sent to '. $trade['User']['name'] . ', who is owner of the trade');
							} else {
								CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED, but An email was sent to '. $trade['User']['name'] . ', who is owner of the trade');
								$failure = true;
							}
						}
						else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email FAILED to '. $trade['User']['name'] . ', who is owner of the trade');
						}
					}
				}
			}

			// If user has confirmed the desire to trade, send email to all receiving users.
			if ($trade['Trade']['user_status'] == 2) {
				foreach ($trade['TradesDetail'] as $tradesDetail) {

					// If user has already received email (TradesDetail['status'] == 1), then do not send email.
					if ($tradesDetail['status'] == 0) {
						$method = $this->User->getCommunicationMethod($tradesDetail['User']['id']);
						$sendDetails = $this->_TradeRequest->send($tradesDetail['User'], $trade, $tradesDetail, $method, 'tradeRequestRecipient', 'Trade request from ' .$trade['User']['name'] . ': '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);

						if ($sendDetails['return'] == true) {
							// Assuming success, update Status of TradesDetail to 1
							$this->TradesDetail->read(null, $tradesDetail['id']);
							$this->TradesDetail->set('status', 1);
							$this->TradesDetail->set('token', $sendDetails['token']);
							$this->TradesDetail->save();
			
							// Write log indicating trade detail was done
							CakeLog::write('TradeRequest', 'tradesDetail[id]: '.$tradesDetail['id'] . '; An email was sent to '. $tradesDetail['User']['name']);
						}
						else {
							$failure = true;
						}
					}
				}
		
				// Assuming success, update Status of Trade to 1
				if (!$failure) {
					$this->read(null, $trade['Trade']['id']);
					$this->set('status', 1);
					if ($this->save()) {
						// Write log indicating trade was done
						CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Changed status to 1');
					} else {
						CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Failed to process trade');
						$failure = true;
					}
				}
			}
		}
		return ($failure == false ? true : false);
	}
}