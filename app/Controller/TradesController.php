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
 * index method
 *
 * @return void
 */
	public function history() {
		//Set paginate conditions from passed arguments
		$this->paginate['conditions'] = $this->Trade->parseCriteria($this->passedArgs);
		$this->paginate['limit'] = 10;

		//Set usersId to either the query or the current user's ID if not available
		$usersId = (isset($this->request->query['id']) ? $this->request->query['id'] : $this->_usersId());

		$this->set('usersId', $usersId);

		$this->paginate = array(
				'paramType' => 'querystring',
				'recursive' => -1,
				'order' => 'Trade.status ASC',
				'limit' => 10,
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
		$this->set('trades', $this->paginate(array(
				'OR' => array(
					'Trade.user_id' => $usersId,
					'TradesDetail.user_id' => $usersId))));
		
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
		//TODO: Get shifts where the Originator has accepted and at least one (and hopefully only
		// one) Recipient has accepted

		$trades = $this->Trade->find('all', array(
					'fields' => array(
						'Trade.id',
						'Trade.user_id',
						'Trade.shift_id'),
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
				$this->Trade->Shift->read(null, $trade['Trade']['shift_id']);
				$this->Trade->Shift->set('user_id', $trade['TradesDetail'][0]['user_id']);
				$this->Trade->Shift->set('updated', date("Y-m-d H:i:s",time()));
				$this->Trade->Shift->save();

				$this->Trade->read(null, $trade['Trade']['id']);
				$this->Trade->set('status', 2);
				$this->Trade->save();

				//Log successfully completed trade.
				CakeLog::write('TradeComplete', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Entered trade on calendar for shift ' . $trade['Trade']['shift_id'] . ' from ' . $trade['Trade']['user_id'] . ' to ' . $trade['TradesDetail'][0]['user_id']);
			}
		}

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