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
		
		App::import('Lib', 'TradeRequest');
		$this->_TradeRequest = new TradeRequest();
		
		$token = $request->query['token'];
		$id = $request->query['id'];
		
		$tradesDetail = $this->TradesDetail->find('first', array(
					'fields' => array(
						'TradesDetail.id',
						'TradesDetail.token',
						'TradesDetail.trade_id',
						'TradesDetail.user_id'),
					'conditions' => array(
						'TradesDetail.id' => $id,
						'TradesDetail.status' => 1),
					'contain' => array(
						'User' => array(
							'fields' => array(
								'id',
								'name',
								'email'
							)
						),
						'Trade' => array(
							'fields' => array(
								'status',
								'user_status',
								'shift_id'),
							'TradesDetail' => array(
								'fields' => array('status')
							),
							'Shift' => array(
								'fields' => array(
									'id',
									'date'),
								'ShiftsType' => array(
									'fields' => array(
										'times'),
									'Location' => array(
										'location'
									)
								)
							),
							'User' => array(
								'fields' => array(
									'id',
									'name',
									'email'
								)
							)
						)
					)
		));
		
		if (empty($tradesDetail)) {
			throw new NotFoundException(__('Trade not found or already acted upon'));
		}

		// Check to see if the trade has already been taken by somebody else. If so, 
		// then render that page and exit.
		if ($this->alreadyTaken($tradesDetail)) {
			$this->Session->setFlash(__('Shift already taken!'));
			return $this->render('alreadyTaken');
		}
		
		if ($token == $tradesDetail['TradesDetail']['token']) {
			$this->TradesDetail->read(null, $id);
			$this->TradesDetail->set('status', $status);
			if ($this->TradesDetail->save()) {

				//No need for 
				//$this->_TradeRequest->sendRecipientStatusChange($status, $tradesDetail);
				CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Changed status to '. $status);
				return true;
			}
			else {
				CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Error changing status');
				return $this->Session->setFlash(__('An error has occured during your request.'));
			}
		}
		else {
			return $this->Session->setFlash(__('Sorry, but your token is wrong. You are not authorized to accept or reject this trade.'));
			CakeLog::write('TradeRequest', '[TradesDetail][id]: ' .$tradesDetail['TradesDetail']['id'] . '; Wrong token');
		}
	}
	
	public function alreadyTaken($tradesDetail) {

		if ($tradesDetail['Trade']['status'] !=  1
			|| $tradesDetail['Trade']['user_status'] !=  2) {
			return true;
		}
		foreach ($tradesDetail['Trade']['TradesDetail'] as $detail) {
			if ($detail['status'] == 2) {
				return true;
			} 
		}
		
		return false;
	}
}