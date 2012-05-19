<?php
App::uses('AppController', 'Controller', 'Sanitize', 'Utility');

/**
 * Trades Controller
 *
 * @property Trade $Trade
 */
class TradesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js', 'Cache', 'PhysicianPicker', 'DatePicker');
	public $components = array('RequestHandler', 'Search.Prg');
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
		$this->Prg->commonProcess();
		$shiftOptions[] = array();
		
		$this->loadModel('Calendar');
		if ($this->request->is('post')) {
			$this->Trade->create();
			if ($this->Trade->save($this->request->data)) {
				$this->Session->setFlash(__('The trade has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
			}
		}
		if (isset($this->request->query['date'])) {
			$shiftOptions = array_merge($shiftOptions, array('Shift.date' => $this->request->query['date']));				
		}
		if (isset($this->request->query['id'])) {
			$shiftOptions = array_merge($shiftOptions, array('Shift.user_id' => $this->request->query['id']));				
		}
		else {
			$shiftOptions = array_merge($shiftOptions, array('Shift.user_id' => $this->_usersId()));
			$this->set('usersId', $this->_usersId());
		}
		$shiftList = $this->Trade->Shift->getShiftList(array($shiftOptions));
		$shifts = '';
 		foreach ($shiftList as $shift) {
			$shifts .= date('["Y", "m", "d"],', strtotime($shift['Shift']['date']));
		}

		$physicians = $this->User->getList(null, true, true);
		$calendars = $this->Calendar->find('list');
		$this->set(compact('shifts', 'calendars', 'physicians', 'shiftList'));
		$this->set('_serialize', array('shiftList'));
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
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		if ($this->Trade->delete()) {
			$this->Session->setFlash(__('Trade deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Trade was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Trade->recursive = 0;
		$this->set('trades', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		$this->set('trade', $this->Trade->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Trade->create();
			if ($this->Trade->save($this->request->data)) {
				$this->Session->setFlash(__('The trade has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
			}
		}
		$users = $this->Trade->User->find('list');
		$shifts = $this->Trade->Shift->find('list');
		$this->set(compact('users', 'shifts'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		if ($this->Trade->delete()) {
			$this->Session->setFlash(__('Trade deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Trade was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
