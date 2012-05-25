<?php

class TradeRequest {

	/**
	 * Function to process trades
	 * @param array $trade
	 * @return boolean
	 */
	public function process ($unprocessedTrades = NULL) {
		
		$this->User = new User();
		
		//Return false if no $unprocessedTrades are given.
		if (!isset($unprocessedTrades)) {
			return false;
		}
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
				if ($this->send($fromUser, $toUser, $trade['Shift'], $method)) {
					//TODO: Assuming success, update Status of TradesDetail to 1
				}
			}
			//TODO: Assuming success, update Status of Trade to 1
//			$this->request->data = $this->Trade->read(null, $id);
//				if ($this->Trade->save($this->request->data)) {
//					$this->Session->setFlash(__('The trade has been saved'));
//					$this->redirect(array('action' => 'index'));
//				} else {
//					$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
//				}
			}
		}	


	public function send($fromUser, $toUser, $shift, $method) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
		if ($method == 'email') {
			$email = new CakeEmail('default');
			$email->template('tradeRequest')
				->to($toUser['email'])
				->subject('[Kitab] Shift trade request by ' .$fromUser['name'])
				->viewVars(array('fromUser' => $fromUser, 
						'toUser' => $toUser, 
						'shift' => $shift))
				->send();
		}
	}
}