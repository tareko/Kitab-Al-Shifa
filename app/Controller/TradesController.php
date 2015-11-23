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
		$this->loadModel('Shift');

		//Set paginate conditions from passed arguments
		$this->paginate['defaultModel'] = 'Shift';
		$this->paginate['conditions'] = $this->Shift->parseCriteria($this->passedArgs);
		if ($this->params['ext'] == 'csv') {
			unset($this->paginate['limit']);
		}
		else {
			$this->paginate['limit'] = '25';
		}
		$this->paginate['order'] = 'Shift.date ASC';

		$this->set('locations', $this->Shift->ShiftsType->Location->find('list', array(
			'fields' => array('Location.location'),
		)));

		$this->set('shifts', $this->paginate('Shift', array('Shift.marketplace' => 1)));
		$this->render();
	}

/**
 * add method
 *
 * @return void
 */
	public function index() {
		if ($this->request->isPost() && !empty($this->request->data)) {
			(!empty($this->request->data['TradesDetail']) ? $this->Trade->TradesDetail->set($this->request->data['TradesDetail']['0']): false);
			if ($this->Trade->TradesDetail->validates()) {
				$this->request->data['Trade']['submitted_by'] = $this->_usersId();
				if ($this->Trade->saveAll($this->request->data)) {
						$this->Flash->success(__('The trade has been saved'));
				} else {
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
	}

	/**
	 * Complete accepted
	 * Enter accepted shift trade into calendar
	 */
	public function completeAccepted() {
		$this->Trade->completeAccepted();
		$this->set('success', 1);
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