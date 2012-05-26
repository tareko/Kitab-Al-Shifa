<?php

class TradeRequest {
	public function send($tradesDetailId, $fromUser, $toUser, $shift, $method, $token) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
		if ($method == 'email') {
			$email = new CakeEmail('default');
			$email->template('tradeRequest')
				->emailFormat('text')
				->to($toUser['email'])
				->subject('[Kitab] Shift trade request by ' .$fromUser['name'])
				->viewVars(array(
						'fromUser' => $fromUser, 
						'toUser' => $toUser, 
						'shift' => $shift,
						'tradesDetailId' => $tradesDetailId,
						'token' => $token))
				->send();
		}
		return true;
	}
}