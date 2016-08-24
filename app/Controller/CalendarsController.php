<?php
App::uses('AppController', 'Controller');
/**
 * Calendars Controller
 *
 * @property Calendar $Calendar
 */
class CalendarsController extends AppController {

	public $scaffold = 'admin';
	public $components = array('RequestHandler', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Calendar->recursive = 0;
		$this->set('calendars', $this->paginate());
		$this->render();
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Calendar->id = $id;
		if (!$this->Calendar->exists()) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		$this->set('calendar', $this->Calendar->read(null, $id));
		return $this->render();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Calendar->create();
			if ($this->Calendar->save($this->request->data)) {
				$this->Flash->success(__('The calendar has been saved'));
				$this->set('success', true);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->alert(__('The calendar could not be saved. Please, try again.'));
				$this->set('success', false);
			}
		}
		$usergroups = $this->Calendar->Usergroup->find('list');
		$this->set(compact('usergroups'));
		return $this->render;
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Calendar->id = $id;
		if (!$this->Calendar->exists()) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Calendar->save($this->request->data)) {
				$this->Flash->success(__('The calendar has been saved'));
				$this->set('success', true);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->alert(__('The calendar could not be saved. Please, try again.'));
				$this->set('success', false);
			}
		} else {
			$this->request->data = $this->Calendar->read(null, $id);
		}
		$usergroups = $this->Calendar->Usergroup->find('list');
		$this->set(compact('usergroups'));
		return $this->render;
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
		$this->Calendar->id = $id;
		if (!$this->Calendar->exists()) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		if ($this->Calendar->delete()) {
			$this->Flash->warning(__('Calendar deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Flash->alert(__('Calendar was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
