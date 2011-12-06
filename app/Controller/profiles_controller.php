<?php
App::uses('AppController', 'Controller');
/**
 * Profile Controller
 *
 * @property Profile $Profile
 */
class ProfilesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Profile->recursive = 1;
		$this->set('profiles', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$this->set('profile', $this->Profile->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Profile->create();
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Profile->read(null, $id);
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
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
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->Profile->delete()) {
			$this->Session->setFlash(__('Profile deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Profile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Profile->recursive = 0;
		$this->set('profiles', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$this->set('profile', $this->Profile->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Profile->create();
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Profile->read(null, $id);
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
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
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->Profile->delete()) {
			$this->Session->setFlash(__('Profile deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Profile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
