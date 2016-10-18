<?php
App::uses('AppController', 'Controller', 'Sanitize', 'Utility', 'Router');

/**
 * Trades Controller
 *
 * @property Trade $Trade
 *
 */
class TradesController extends AppController {
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js', 'Cache', 'PhysicianPicker', 'DatePicker', 'Time', 'TradeStatus', 'Text');
	public $components = array('RequestHandler', 'Search.Prg', 'Flash');
	public $scaffold = 'admin';
	var $paginate = array(
			'recursive' => '2',
	);

/* 	public $presetVars = array(
			array('field' => 'month', 'type' => 'value'),
			array('field' => 'year', 'type' => 'value'),
			array('field' => 'location', 'type' => 'value', 'formField' => 'location', 'modelField' => 'location', 'model' => 'Location')
	);
 */

/**
 * history method
 *
 * @return void
 */
	public function history() {
		//Set paginate conditions from passed arguments
		$this->paginate['conditions'] = $this->Trade->parseCriteria($this->passedArgs);
		$this->paginate['limit'] = 10;

		//Set usersId to either the query or the current user's ID if not available
		$usersId = (isset($this->request->query['id']) ? $this->request->query['id'] : $this->_usersId());

		$archives = (isset($this->request->query['archives']) && $this->request->query['archives'] == 1 ? array() : array('Trade.status <=' => 1));

		$this->set('usersId', $usersId);

		$this->paginate = array(
				'paramType' => 'querystring',
				'recursive' => -1,
				'order' => 'Trade.status ASC',
				'limit' => 10,
				'group' => 'Trade.id',
				'fields' => array(
						'status',
						'user_id',
						'user_status',
						'token',
						'shift_id'),
				'joins' => array(array(
						'table' => 'trades_details',
						'alias' => 'TradesDetail',
						'type' => 'RIGHT',
						'conditions' => array(
								'Trade.id = TradesDetail.trade_id',
						)
				)),
				'contain' => array(
						'User' => array(
								'fields' => array(
										'name',
										'id')),
						'TradesDetail' => array(
								'fields' => array(
										'id',
										'token',
										'user_id',
										'status'),
								'User' => array(
										'fields' => array(
												'id',
												'name'))
						),
						'Shift' => array(
								'fields' => array(
										'date',
										'shifts_type_id'),
								'ShiftsType' => array(
										'fields' => array(
												'location_id',
												'times'),
										'Location' => array(
												'fields' => array(
														'location')
										)
								)
						)
				)
		);
		$this->set('trades', $this->paginate(array_merge($archives, array(
				'OR' => array(
					'Trade.user_id' => $usersId,
					'TradesDetail.user_id' => $usersId)))));
		$this->render();
	}

	/**
	 * marketplace method
	 * Shift marketplace display
	 *
	 * @return void
	 */
	public function marketplace() {
		// If the marketplace is blinded, then kick the user back to the index
		if (Configure::read('marketplace_blind') && !$this->_isAdmin()) {
			$this->Flash->alert(__('You may not access the marketplace at this time'));
			return $this->redirect(array(
					'action' => 'index'));
		}

		$this->loadModel('Shift');

		//Set paginate conditions from passed arguments
		$this->paginate['defaultModel'] = 'Shift';
		$this->paginate['conditions'] = $this->Shift->parseCriteria($this->passedArgs);
		$this->paginate['limit'] = '25';
		$this->paginate['order'] = 'Shift.date ASC';

		$this->set('locations', $this->Shift->ShiftsType->Location->find('list', array(
			'fields' => array('Location.location'),
		)));

		$this->set('shifts', $this->paginate('Shift', array('Shift.marketplace' => 1)));
		$this->render();
	}

	/**
	 * Marketplace take shift method
	 */
	public function market_take() {
		if (isset($this->request->query['id'])) {

			// Load models that we will use
			$this->loadModel('Shift');

			// Get shift information
			$this->Shift->id = $this->request->query['id'];
			$this->Shift->recursive = 2;

			// Read shift; return if invalid shift ID
			if (!$this->Shift->read()) {
				$this->Flash->alert(__('The shift you entered is invalid'));
				return $this->redirect(array(
						'action' => 'marketplace'));
			}
			$shift = $this->Shift->read()['Shift'];
			// Is shift in marketplace? If not, error and dump
			if (!$shift['marketplace'] == true) {
				$this->Flash->alert(__('The shift you entered is not in the marketplace'));
				return $this->redirect(array(
						'action' => 'marketplace'));
			}

			// Has the taking user taken more than today's limit? This is set in
			// bootstrap.php as 'marketplace_take_limit'

			if ($this->Trade->marketTradesToday($this->_usersId()) >= Configure::read('marketplace_take_limit')) {
				$this->Flash->alert(__('You have reached your marketplace limit ('.Configure::read('marketplace_take_limit').' for the day). Try again after '. Configure::read('marketplace_take_limit_restart') . '00h'));
				return $this->redirect(array(
						'action' => 'marketplace'));
			}

			// Has the limit for the giving user been crossed?
			if ($this->Trade->marketLimitReached($shift) == true) {
				$this->Flash->alert(__('Unfortunately, '. $this->Shift->read()['User']['name'].' has reached their limit for ' . date('F', strtotime($shift['date']))));
				return $this->redirect(array(
						'action' => 'marketplace'));
			}

			// Has the user confirmed? If not, ask for confirmation
			if (!isset($this->request->query['confirm']) || $this->request->query['confirm'] != 1)
			{
				$this->set('shift', $this->Shift->read());
				return $this->render();
			}

			// After all of these hurdles have been jumped, go ahead with the trade
			// Set the Trade data
			// Set the TradesDetail data

			$data = array(
					'Trade' => array(
							'user_id' => $shift['user_id'],
							'shift_id' => $shift['id'],
							'submitted_by' => $this->_usersId(),
							'consideration' => 3,
							'confirmed' => 1,
					),
					'TradesDetail' => array(
							0 => array(
									'user_id' => $this->_usersId()
							)
					)
			);


			if ($this->Trade->saveAll($data)) {
				$this->Flash->success(__('The shift has been successfully taken'));

				$this->Shift->set('marketplace', false);
				if ($this->Shift->save()) {
					$this->set('success', true);
				}
				else {
					$this->set('success', false);
				}
			} else {
				$this->Flash->alert(__('The trade could not be saved. Please try again or report the error.'));
				debug($this->Trade->validationErrors);
				$this->set('success', false);
			}
		}

		return $this->redirect(array(
				'action' => 'marketplace'));
	}

/**
 * add method
 *
 * @return void
 */
	public function index() {
		$this->set('success', false);
		if ($this->request->isPost() && !empty($this->request->data)) {
			(!empty($this->request->data['TradesDetail']) ? $this->Trade->TradesDetail->set($this->request->data['TradesDetail']['0']): false);
			if ($this->Trade->TradesDetail->validates()) {
				$this->request->data['Trade']['submitted_by'] = $this->_usersId();
				if ($this->Trade->saveAll($this->request->data)) {
					$this->set('success', true);
					$this->Flash->success(__('The trade has been saved'));
				} else {
					$this->Trade->validates();
					debug($this->Trade->validationErrors);
					$this->Flash->alert(__('The trade could not be saved. Please fix the errors below and try again.'));
				}
			} else {
				$this->Trade->set($this->request->data);
				$this->Trade->validates();
				$this->Flash->alert(__('The trade could not be saved. Please fix the errors below and try again.'));
			}
		}

		$this->set('usersId', (isset($this->request->query['id']) ? $this->request->query['id'] : $this->_usersId()));
		$this->set('groupList', $this->User->getGroupsForUser($this->_usersId(), array(), true, true));
		$this->render();
	}

	/**
	 * List of all cash shifts
	 */

	public function cashList() {
		//Set paginate conditions from passed arguments
		$this->paginate['conditions'] = $this->Trade->parseCriteria($this->passedArgs);
		$this->paginate['limit'] = 10;

		//Set usersId to either the query or the current user's ID if not available
		$usersId = (isset($this->request->query['id']) ? $this->request->query['id'] : $this->_usersId());

		$date = date_sub(date_create(), date_interval_create_from_date_string('3 months'));
		$date = date_format($date, 'Y-m-d');
		$archives = (isset($this->request->query['archives']) && $this->request->query['archives'] == 1 ?
				array() :
				array('Shift.date >=' => $date));


		$this->set('usersId', $usersId);

		$this->paginate = array(
				'paramType' => 'querystring',
				'recursive' => -1,
				'order' => 'Trade.status ASC',
				'limit' => 10,
				'group' => 'Trade.id',
				'fields' => array(
						'status',
						'user_id',
						'user_status',
						'token',
						'shift_id'),
				'joins' => array(array(
						'table' => 'trades_details',
						'alias' => 'TradesDetail',
						'type' => 'RIGHT',
						'conditions' => array(
								'Trade.id = TradesDetail.trade_id',
						)
				)),
				'contain' => array(
						'User' => array(
								'fields' => array(
										'name',
										'id')),
						'TradesDetail' => array(
								'fields' => array(
										'id',
										'token',
										'user_id',
										'status'),
								'User' => array(
										'fields' => array(
												'id',
												'name'))
						),
						'Shift' => array(
								'fields' => array(
										'date',
										'shifts_type_id'),
								'ShiftsType' => array(
										'fields' => array(
												'location_id',
												'times'),
										'Location' => array(
												'fields' => array(
														'location')
										)
								)
						)
				)
		);
		$this->set('trades', $this->paginate(array_merge($archives, array(
				'Trade.consideration' => 0,
				'Trade.status' => 2,
				'OR' => array(
						'Trade.user_id' => $usersId,
						'TradesDetail.user_id' => $usersId)))));
		$this->render();
	}

	/**
	 *
	 * Deal with unprocessed shift trade requests.
	 * Meant for a cron job.
	 *
	 */
	public function startUnprocessed() {
		$success = $this->Trade->processTrades();
		if ($success == true) {
			$this->Flash->success(__('Pending trades successfully processed'));
		}
		else {
			$this->Flash->alert(__('Pending trades not successfully processed.'));
		}
		$this->set('success', $success);
		$this->render();
	}

	/**
	 * Complete accepted
	 * Enter accepted shift trade into calendar
	 */
	public function completeAccepted() {
		$this->Trade->completeAccepted(); // Complete pending accepted trades
		$this->Trade->cleanMarketplace(); // Clean the marketplace
		$this->set('success', true);
		$this->render();
	}

	/**
	 * Function to accept trade request
	 *
	 * @throws NotFoundException
	 */
	public function accept() {
		if (!isset($this->request) ||
			!isset($this->request->query['id']) ||
			!isset($this->request->query['token'])) {
			throw new NotFoundException(__('Invalid request'));
		}
		$return = $this->Trade->changeStatus($this->request, 2);
		if ($return === TRUE) {
			$this->Flash->success(__('You have successfully accepted the trade.'));
			$this->set('success', true);
		}
		else {
			$this->Flash->alert(__('Trade has failed with the following message: ' . $return));
			$this->set('success', false);
		}
		$this->render();
	}

	public function reject() {
		if (!isset($this->request) ||
				!isset($this->request->query['id']) ||
				!isset($this->request->query['token'])) {
			throw new NotFoundException(__('Invalid request'));
		}
		$return = $this->Trade->changeStatus($this->request, 3);
		if ($return === TRUE) {
			$this->Flash->success(__('You have rejected this trade.'));
			$this->set('success', true);
		}
		else {
			$this->Flash->alert(__('Trade has failed with the following message: ' . $return));
			$this->set('success', false);
		}
		$this->render();
	}
}