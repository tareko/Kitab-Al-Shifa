<?php
App::uses('AppController', 'Controller');
/**
 * ShiftsTypes Controller
 *
 * @property ShiftsType $ShiftsType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ShiftsTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if  (isset($this->request->query['hideExpired']) && $this->request->query['hideExpired'] == 1) {
			$conditions =  array(
					'expiry_date >=' => date('Y-m-d'),
					);
			$this->Paginator->settings = array(
					'conditions' => $conditions,
			);
		}
		$this->ShiftsType->recursive = 0;
		$this->set('shiftsTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ShiftsType->exists($id)) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		$options = array('conditions' => array('ShiftsType.' . $this->ShiftsType->primaryKey => $id));
		$this->set('shiftsType', $this->ShiftsType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ShiftsType->create();
			if ($this->ShiftsType->save($this->request->data)) {
				$this->Session->setFlash(__('The shifts type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shifts type could not be saved. Please, try again.'));
			}
		}
		$locations = $this->ShiftsType->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ShiftsType->exists($id)) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShiftsType->save($this->request->data)) {
				$this->Session->setFlash(__('The shifts type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shifts type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ShiftsType.' . $this->ShiftsType->primaryKey => $id));
			$this->request->data = $this->ShiftsType->find('first', $options);
		}
		$locations = $this->ShiftsType->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ShiftsType->id = $id;
		if (!$this->ShiftsType->exists()) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ShiftsType->delete()) {
			$this->Session->setFlash(__('The shifts type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shifts type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ShiftsType->recursive = 0;
		$this->set('shiftsTypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ShiftsType->exists($id)) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		$options = array('conditions' => array('ShiftsType.' . $this->ShiftsType->primaryKey => $id));
		$this->set('shiftsType', $this->ShiftsType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ShiftsType->create();
			if ($this->ShiftsType->save($this->request->data)) {
				$this->Session->setFlash(__('The shifts type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shifts type could not be saved. Please, try again.'));
			}
		}
		$locations = $this->ShiftsType->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ShiftsType->exists($id)) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShiftsType->save($this->request->data)) {
				$this->Session->setFlash(__('The shifts type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shifts type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ShiftsType.' . $this->ShiftsType->primaryKey => $id));
			$this->request->data = $this->ShiftsType->find('first', $options);
		}
		$locations = $this->ShiftsType->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ShiftsType->id = $id;
		if (!$this->ShiftsType->exists()) {
			throw new NotFoundException(__('Invalid shifts type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ShiftsType->delete()) {
			$this->Session->setFlash(__('The shifts type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shifts type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
