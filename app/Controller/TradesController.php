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
		if ($this->request->is('post')) {
			$this->Trade->create();
			if ($this->Trade->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('The trade has been saved'));
				$this->redirect(array('action' => 'index'));
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
			foreach ($trade['TradesDetail'] as $tradesDetail) {
				$toUser = $tradesDetail['User'];
				$fromUser = $trade['User'];
				//TODO: Stubbed as 'email' for now. Eventually will allow user choice through getCommunicatinoMethod
				$method = 'email';
				//Get communication method preference for receiving user
				$method = $this->User->getCommunicationMethod($toUser['id']);
				//Send out communication to receiving user
				$token = bin2hex(openssl_random_pseudo_bytes(16));
				
				if ($this->_TradeRequest->send($tradesDetail['id'], $fromUser, $toUser, $trade['Shift'], $method, $token)) {
					// Assuming success, update Status of TradesDetail to 1
					$this->Trade->TradesDetail->read(null, $tradesDetail['id']);
					$this->Trade->TradesDetail->set('status', 1);
					$this->Trade->TradesDetail->set('token', $token);
					$this->Trade->TradesDetail->save();

					// Write log indicating trade detail was done
					CakeLog::write('TradeRequest', 'trade[Trade][id]: ' .$trade['Trade']['id'] . '; tradesDetail[id]: '.$tradesDetail['id'] . '; An email was sent to '. $toUser['name']);
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