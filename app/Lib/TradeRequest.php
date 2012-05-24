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
			$this->request->data = $this->Trade->read(null, $id);
				if ($this->Trade->save($this->request->data)) {
					$this->Session->setFlash(__('The trade has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
				}
			}
		}	
	
	
	public function send($fromUser, $toUser, $shift, $method) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('AppHelper', 'View/Helper');
		App::uses('TimeHelper', 'View/Helper');
		App::uses('HtmlHelper', 'View/Helper');
		$this->Html = new HtmlHelper('Default');
		$this->Time = new TimeHelper('Default');

		$fromShift = $this->Time->nice($shift['date']) .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times'];
		if ($method == 'email') {
		$message = 'Dear '. $toUser['name'].',\n\n
You have received a trade request from '.$fromUser['name'].'.\n\n
The proposed trade is as follows:\n
You take: '. $fromShift .'\n'
//TODO: Two-way trades
//.$fromUser['name'].' takes '
//.'YOUR SHIFT\n\n'
.'Please review this trade carefully.\n\n
To *ACCEPT*, click here:\n'
.$this->Html->url('accept')
		//AGREE LINK

.'\n\n
To *REJECT*, click here:\n'
.$this->Html->url('reject')
//REJECT LINK\n\n
.'Thank you for your consideration,\n\n
Kitab Al Shifa Mail Bot : )';

			$email = new CakeEmail('default');
			$email->to($toUser['email'])
				->subject('[Kitab] Shift trade request by ' .$fromUser['name'])
				->send($message);
		}
	}
}