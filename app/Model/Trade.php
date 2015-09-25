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
 * Consideration legend:
 * 0 => 'Cash',
 * 1 => 'Trade',
 * 2 => 'Future consideration'
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
		if (!$this->_TradeRequest) { // Allows for mocks to work properly
			$this->_TradeRequest = new TradeRequest();
		}
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
					$sendOriginatorConfirmed = $this->_TradeRequest->send($trade['User'], $trade, $trade['TradesDetail'], $method, 'tradeCompleteConfirmedOriginator', 'Pre-confirmed trade: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
					$sendRecipientConfirmed = $this->_TradeRequest->send($trade['TradesDetail'][0]['User'], $trade, $trade['TradesDetail'], $method, 'tradeCompleteConfirmedRecipient', 'Pre-confirmed trade: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
					if ($sendOriginatorConfirmed['return'] === true && $sendRecipientConfirmed['return'] === true) {
						// Assuming success, update Status of Trade to 1
						$data = array(
								'user_status' => 2,
								'status' => 1
						);
						$data2 = array(
								'status' => 2
						);

						$success1 = $this->updateAll($data, array('Trade.id' => $trade['Trade']['id']));
						$success2 = $this->TradesDetail->updateAll($data2, array('TradesDetail.trade_id' => $trade['Trade']['id']));

						if ( $success1 && $success2) {
						// Write log indicating trade detail was done
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email confirmation was sent to '. $trade['User']['name'] .' and ' . $trade['TradesDetail'][0]['User']['name'] . ' confirming the trade');
						} else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED, but an email confirmation was sent to '. $trade['User']['name'] .' and ' . $trade['TradesDetail'][0]['User']['name'] . ' confirming the trade. DB ERROR: ');
							debug($data);
							debug($data2);
							debug($success1);
							debug($success2);
							debug($this->validationErrors);
							debug($this->TradesDetail->validationErrors);
							$failure = true;
						}
					}
					else {
						CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email confirmation FAILED to '. $trade['User']['name'] .' and ' . $trade['TradesDetail']['0']['User']['name'] . ' confirming the trade');
						$failure = true;
					}
				}

				else {

					// When user has submitted trade request, skip originator confirmation and
					// Go onto DB writes
					if ($trade['Trade']['submitted_by'] == $trade['Trade']['user_id']) {
						// Update Status of Trade to 1
						$data = array('user_status' => 2);

						if ($this->updateAll($data, array('Trade.id' => $trade['Trade']['id']))) {
							// Write log indicating trade detail was done
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; Changed status to 1. No confirmation sent');
						} else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED. Did not successfully change status to 1');
							$failure = true;
						}
					}

					else {
						$sendOriginator = $this->_TradeRequest->send($trade['User'], $trade, $trade['TradesDetail'], $method, 'tradeRequestOriginator', 'Request to trade your shift: '. $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);
						if ($sendOriginator['return'] === true) {
							// Assuming success, update Status of Trade to 1

							$data = array(
									'Trade.user_status' => "'1'",
									'Trade.token' => "'".$sendOriginator['token']."'");

							if ($this->updateAll($data, array('Trade.id' => $trade['Trade']['id']))) {
								// Write log indicating trade detail was done
								CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email was sent to '. $trade['User']['name'] . ', who is owner of the trade');
							} else {
								CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; DB write FAILED, but An email was sent to '. $trade['User']['name'] . ', who is owner of the trade');
								$failure = true;
							}
						}
						else {
							CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email FAILED to '. $trade['User']['name'] . ', who is owner of the trade');
							$failure = true;
						}
					}
				}
			}

			// If user has confirmed the desire to trade, send email to all receiving users.
			elseif ($trade['Trade']['user_status'] == 2) {
				foreach ($trade['TradesDetail'] as $tradesDetail) {

					// If user has already received email (TradesDetail['status'] == 1), then do not send email.
					if ($tradesDetail['status'] == 0) {
						$method = $this->User->getCommunicationMethod($tradesDetail['User']['id']);
						$sendDetails = $this->_TradeRequest->send($tradesDetail['User'], $trade, $tradesDetail, $method, 'tradeRequestRecipient', 'Trade request: ' . $trade['Shift']['date'] .' '. $trade['Shift']['ShiftsType']['Location']['abbreviated_name'] .' '. $trade['Shift']['ShiftsType']['times']);

						if ($sendDetails['return'] == true) {
							// Assuming success, update Status of TradesDetail to 1
							$this->TradesDetail->read(null, $tradesDetail['id']);

							$data = array(
									'TradesDetail.status' => "'1'",
									'TradesDetail.token' => "'".$sendDetails['token']."'");

							if ($this->TradesDetail->updateAll($data, array('TradesDetail.id' => $tradesDetail['id']))) {
								// Write log indicating trade detail was done
								CakeLog::write('TradeRequest', 'tradesDetail[id]: '.$tradesDetail['id'] . '; An email was sent to '. $tradesDetail['User']['name']);
							}
							else {
								// Write log indicating email succeeded but DB write failed
								CakeLog::write('TradeRequest', 'tradesDetail[id]: '.$tradesDetail['id'] . '; DB write failed but an email was sent to '. $tradesDetail['User']['name']);
								$failure = true;
							}
						}
						else {
							CakeLog::write('TradeRequest', 'tradesDetail[id]: '.$tradesDetail['id'] . '; An email FAILED to send to '. $tradesDetail['User']['name']);
							$failure = true;
						}
					}
				}

				// Assuming success, update Status of Trade to 1
				if (!$failure) {
					$data = array('status' => 1);
					if ($this->updateAll($data, array('Trade.id' => $trade['Trade']['id']))) {
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

	/**
	 * Change status of trade if correctly accepted or rejected
	 *
	 * @param array $request
	 * @param integer $status
	 */

	public function changeStatus($request = array(), $status = false) {
		$token = $request->query['token'];
		$id = $request->query['id'];

		$trade = $this->find('first', array(
				'fields' => array(
						'Trade.id',
						'Trade.token',
						'Trade.user_id',
						'Trade.shift_id',
						'Trade.status',
						'Trade.user_status'),
				'conditions' => array(
						'Trade.id' => $id),
				'contain' => array(
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
		));
		//Error exits

		// Error if $trade is empty
		if (empty($trade)) {
			return 'Trade not found';
		}

		// Error if no status is given

		elseif (!is_numeric($status)) {
			return 'Improper status was given to this function';
		}

		// Error if token is wrong
		if ($token != $trade['Trade']['token']) {
			return 'Sorry, but your token is wrong. You are not authorized to act on this trade.';
		}

		// Error if trade status != 0

		if ($trade['Trade']['status'] != 0) {
			if ($trade['Trade']['status'] == 1) {
				return 'You have already accepted this trade';
			}
			elseif ($trade['Trade']['status'] == 2) {
				return 'This trade is already complete';
			}
			elseif ($trade['Trade']['status'] == 3) {
				return 'This trade has already been cancelled';
			}
			else {
				return 'An error occurred with this trade[1]';
			}
		}

		// Error if user_status != 1 as expected

		if ($trade['Trade']['user_status'] != 1) {
			if ($trade['Trade']['user_status'] == 2) {
				return 'You have already accepted this trade';
			}
			elseif ($trade['Trade']['user_status'] == 3) {
				return 'You have already rejected this trade';
			}
			else {
				return 'An error occurred with this trade[2]';
			}
		}

		// If no errors, update status of trade
		$data = array('user_status' => $status);

		if ($this->updateAll($data, array('Trade.id' => $id))) {
			CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Changed user_status to '. $status);
			return true;
		}
		else {
			CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Error changing user_status');
			return 'An error has occured during your request[3]';
		}
	}

	/**
	 * Complete Accepted trades
	 */
	public function completeAccepted() {
		$trades = $this->find('all', array(
				'fields' => array(
						'Trade.id',
						'Trade.user_id',
						'Trade.shift_id',
						'Trade.status'),
				'conditions' => array(
						'Trade.status' => 1,
						'Trade.user_status' => 2),
				'contain' => array(
						'Shift' => array(
								'fields' => array(
										'id'
								)
						),
						'TradesDetail' => array(
								'fields' => array(
										'trade_id',
										'user_id',
										'status'
								),
								'conditions' => array(
										'status' => 2
								)
						)
				)
		));

		//TODO: Save updated shift
		foreach($trades as $trade) {
			if (isset($trade['TradesDetail'][0]['status'])) {
				$this->Shift->read(null, $trade['Trade']['shift_id']);
				$this->Shift->set('user_id', $trade['TradesDetail'][0]['user_id']);
				$this->Shift->set('updated', date("Y-m-d H:i:s",time()));
				$this->Shift->save();
				$this->updateAll(array('status' => 2), array('Trade.id' => $trade['Trade']['id'] ));

				//Log successfully completed trade.
				CakeLog::write('TradeComplete', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Entered trade on calendar for shift ' . $trade['Trade']['shift_id'] . ' from ' . $trade['Trade']['user_id'] . ' to ' . $trade['TradesDetail'][0]['user_id']);
			}
		}
	}
}