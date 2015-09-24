<?php
App::uses('AppController', 'Controller');
/**
 * TradesDetails Controller
 *
 * @property TradesDetail $TradesDetail
 */
class TradesDetailsController extends AppController {


	public $helpers = array('Js', 'Cache', 'PhysicianPicker', 'DatePicker', 'Time');
	public $components = array('RequestHandler', 'Search.Prg', 'Flash');
	public $scaffold = 'admin';
	var $paginate = array(
				'recursive' => '2',
	);

	public function accept() {
		// Throw exception if improperly formed request
		if (!isset($this->request) ||
				!isset($this->request->query['id']) ||
				!isset($this->request->query['token'])) {
			throw new NotFoundException(__('Invalid request'));
		}

		$return = $this->TradesDetail->changeStatus($this->request, 2);
		if ($return === true) {
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
		// Throw exception if improperly formed request
		if (!isset($this->request) ||
				!isset($this->request->query['id']) ||
				!isset($this->request->query['token'])) {
			throw new NotFoundException(__('Invalid request'));
		}

		$return = $this->TradesDetail->changeStatus($this->request, 3);
		if ($return === true) {
			$this->Flash->success(__('You have rejected the trade.'));
			$this->set('success', true);
		}
		else {
			$this->Flash->alert(__('Trade operation (reject) has failed with the following message: ' . $return));
			$this->set('success', false);
		}
		$this->render();
	}
}