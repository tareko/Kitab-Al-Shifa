<?php

class TradeRequest {
	/**
	 * Send method to send email requesting trade
	 * 
	 * @param string $tradesDetailId
	 * @param array $fromUser
	 * @param array $toUser
	 * @param string $shift
	 */
	public function send($tradesDetailId, $fromUser, $toUser, $shift, $method) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
		
		//Generate token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
				
		//Send out communication to receiving user
		
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
		$returnArray = array(
						'return' => true,
						'token' => $token
		);
		
		return $returnArray;
	}


	public function sendOriginator($tradeId, $user, $shift, $method) {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
	
		//Generate token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		
		//Send out communication to receiving user
	
		if ($method == 'email') {
			$email = new CakeEmail('default');
			$email->template('tradeRequestOriginator')
			->emailFormat('text')
			->to($user['email'])
			->subject('[Kitab] Shift trade request by you')
			->viewVars(array(
					'user' => $user,
					'shift' => $shift,
					'tradeId' => $tradeId,
					'token' => $token))
					->send();
		}
		$returnArray = array(
				'return' => true,
				'token' => $token
				);
		
		return $returnArray;
	}

}