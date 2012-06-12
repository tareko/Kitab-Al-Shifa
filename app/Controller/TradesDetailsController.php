<?php
App::uses('AppController', 'Controller');
/**
 * TradesDetails Controller
 *
 * @property TradesDetail $TradesDetail
 */
class TradesDetailsController extends AppController {

	
	public $helpers = array('Js', 'Cache', 'PhysicianPicker', 'DatePicker', 'Time');
	public $components = array('RequestHandler', 'Search.Prg');
	public $scaffold = 'admin';
	var $paginate = array(
				'recursive' => '2',
	);

	public function accept() {
		$return = $this->changeStatus($this->request, 2);
		if ($return == true) {
			return $this->Session->setFlash(__('You have successfully accepted the trade.'));
		}
		else {
			return $return;
		}
		$this->render();
	}
	 
	public function reject() {
		$return = $this->changeStatus($this->request, 3);
		if ($return == true) {
			return $this->Session->setFlash(__('You have rejected this trade.'));
		}
		else {
			return $return;
		}
		$this->render();
	}
	
	
	public function changeStatus($request, $status) {
		if (!isset($this->request) || !isset($this->request->query['id']) || !isset($this->request->query['token'])) {
			throw new NotFoundException(__('Invalid trade or trade parameters missing'));
		}
		
		$token = $request->query['token'];
		$id = $request->query['id'];
		
		$tradesDetail = $this->TradesDetail->find('all', array(
					'fields' => array(
						'TradesDetail.token',
						'TradesDetail.trade_id'),
					'conditions' => array(
						'TradesDetail.id' => $id,
						'TradesDetail.status' => 1),
					'contain' => array(
						'Trade' => array(
							'fields' => array(
								'status',
								'user_status'),
							'TradesDetail' => array(
									'fields' => array('status')
							)
						)
					)
				)
		);
		
		if (empty($tradesDetail)) {
			throw new NotFoundException(__('Trade not found or already acted upon'));
		}

		// Check to see if the trade has already been taken by somebody else. If so, 
		// then render that page and exit.
		if ($this->alreadyTaken($tradesDetail)) {
			$this->Session->setFlash(__('Shift already taken!'));
			return $this->render('alreadyTaken');
		}
		
		if ($token == $tradesDetail['0']['TradesDetail']['token']) {
			$this->TradesDetail->read(null, $id);
			$this->TradesDetail->set('status', $status);
			if ($this->TradesDetail->save()) {
				return true;
				CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Changed status to '. $status);
			}
			else {
				return $this->Session->setFlash(__('An error has occured during your request.'));
				CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Error changing status');
			}
		}
		else {
			return $this->Session->setFlash(__('Sorry, but your token is wrong. You are not authorized to accept or reject this trade.'));
			CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Wrong token');
		}
	}
	
	public function alreadyTaken($tradesDetail) {

		if ($tradesDetail['0']['Trade']['status'] !=  1
			|| $tradesDetail['0']['Trade']['user_status'] !=  2) {
			return true;
		}
		foreach ($tradesDetail['0']['Trade']['TradesDetail'] as $detail) {
			if ($detail['status'] == 2) {
				return true;
			} 
		}
		
		return false;
	}
}