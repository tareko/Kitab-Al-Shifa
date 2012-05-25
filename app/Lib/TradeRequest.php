<?php

class TradeRequest {
	public function send($tradesDetailId, $fromUser, $toUser, $shift, $method) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
		$token = bin2hex(openssl_random_pseudo_bytes(16));
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
	}
}