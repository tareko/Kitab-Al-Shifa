<?php
App::uses('AppController', 'Controller', 'Sanitize', 'Utility');

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
	public $helpers = array('Js', 'Cache', 'PhysicianPicker', 'DatePicker', 'Time');
	public $components = array('RequestHandler', 'Search.Prg');
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
	public function index() {
		$this->loadModel('Shift');
		$this->loadModel('User');
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Trade->parseCriteria($this->passedArgs);
		$this->Trade->recursive = 0;


		if (isset($this->request->params['named']['id'])) {
			$this->set('trades', $this->paginate(array('Trade.user_id' => $this->request->params['named']['id'])));
		}
		else {
			$this->set('trades', $this->paginate());
		}
	}

	/**
	 * Admin method
	 * Method for displaying trades for administrator
	 */

	public function admin() {
		$this->loadModel('Shift');
		$this->loadModel('User');
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Trade->parseCriteria($this->passedArgs);
		$this->Trade->recursive = 0;
	
	
		if (isset($this->request->params['named']['id'])) {
			$this->set('trades', $this->paginate(array('Trade.user_id' => $this->request->params['named']['id'])));
		}
		else {
			$this->set('trades', $this->paginate(array('status' => 1)));
		}
	}
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		$this->set('trade', $this->Trade->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$shiftOptions[] = array();
		$this->loadModel('Calendar');
		if ($this->request->is('post') && $this->request->data) {
			$this->Trade->create();
			if ($this->Trade->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('The trade has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
			}
		}
		if (isset($this->request->query['id'])) {
			$this->set('usersId', $this->request->query['id']);
		}
		else {
			$this->set('usersId', $this->_usersId());
		}
		$this->render();
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Trade->save($this->request->data)) {
				$this->Session->setFlash(__('The trade has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Trade->read(null, $id);
		}
		$users = $this->Trade->User->find('list');
		$shifts = $this->Trade->Shift->find('list');
		$this->set(compact('users', 'shifts'));
	}

	function compare() {
		$params = array();
		$this->loadModel('Calendar');
		if ($this->request->is('post')) {
			if (isset($this->request->data['User']) && isset($this->request->data['Calendar'])) {
				$i = 0;
				$masterSet['calendar'] = $this->Calendar->findById($this->request->data['Calendar']['id']);
					foreach ($this->request->data['User'] as $users) {
						$params = $params + array('id[' .$i. ']' => $users['id']);
						$i++;
					}
					$params = $params + array('calendar' => $this->request->data['Calendar']['id']);
					$redirect = array('controller' => 'shifts', 'action' => 'calendarView') + $params;
				return $this->redirect($redirect);
			}
		}
		$this->set('calendars', $this->Calendar->find('list'));
		$this->render();
	}
	
	/**
	 * 
	 * Deal with unprocessed shift trade requests.
	 * Meant for a cron job.
	 * 
	 */
	public function startUnprocessed() {
		App::import('Lib', 'TradeRequest');
		$this->_TradeRequest = new TradeRequest();

		$unprocessedTrades = $this->Trade->getUnprocessedTrades();

		//Find unprocessed trade details within the trade
		foreach ($unprocessedTrades as $trade) {
			//Has the trade been approved by the originator?
			if ($trade['Trade']['user_status'] < 1) {
				//TODO: Stubbed as 'email' for now. Eventually will allow user choice through getCommunicatinoMethod
				//Get communication method preference for receiving user
				$method = $this->User->getCommunicationMethod($trade['User']['id']);
				
				$sendOriginator = $this->_TradeRequest->sendOriginator($trade['Trade']['id'], $trade['User'], $trade['Shift'], $method);
				if ($sendOriginator['return'] == true) {
					//TODO: How do we get a failure message from here?
					// Assuming success, update Status of TradesDetail to 1
					$this->Trade->read(null, $trade['Trade']['id']);
					$this->Trade->set('user_status', 1);
					$this->Trade->set('token', $sendOriginator['token']);
					$this->Trade->save();
				
					// Write log indicating trade detail was done
					CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email was sent to '. $trade['User']['name'] . ', who is owner of the trade');
				}
				else {
					CakeLog::write('TradeRequest', '[Trades][id]: '.$trade['Trade']['id'] . '; An email FAILED to '. $trade['User']['name'] . ', who is owner of the trade');
				}
			}
			else {
				foreach ($trade['TradesDetail'] as $tradesDetail) {
					//TODO: Stubbed as 'email' for now. Eventually will allow user choice through getCommunicatinoMethod
					//Get communication method preference for receiving user
					$method = $this->User->getCommunicationMethod($tradesDetail['User']['id']);
					if ($this->_TradeRequest->send($tradesDetail['id'], $trade['User'], $tradesDetail['User'], $trade['Shift'], $method) != true) {
						return $this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
					}
				}
	
				// Assuming success, update Status of Trade to 1
				$this->Trade->read(null, $trade['Trade']['id']);
				$this->Trade->set('status', 1);
				if ($this->Trade->save()) {
					// Write log indicating trade was done
					CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Changed status to 1');
				} else {
					CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; Failed to process trade');
				}
			}
		}
	}
	
	
	public function accept() {
		$this->loadModel('TradesDetail');
		$token = $this->request->query['token'];
		$tradesDetail_id = $this->request->query['tradesDetail_id'];
		$tradesDetail = $this->TradesDetail->findById($tradesDetail_id, array('TradesDetail.token'));

		if ($token = $tradesDetail['TradesDetail']['token']) {
			//TODO: Accept
		}
		else {
			//TODO: Token isn't right
		}
	}
	 
	public function reject() {
		$this->loadModel('TradesDetail');
		$token = $this->request->query['token'];
		$tradesDetail_id = $this->request->query['tradesDetail_id'];
		$tradesDetail = $this->TradesDetail->findById($tradesDetail_id, array('TradesDetail.token'));
		
		if ($token = $tradesDetail['TradesDetail']['token']) {
			//TODO: Reject
		}
		else {
			//TODO: Token isn't right
		}
	} 
}