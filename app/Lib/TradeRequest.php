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

	
	/**
	 * sendOriginatorStatusChange method
	 * This method will send the originator of a trade a communication advising of a change in
	 * status of the trade, usually accepted or rejected.
	 * 
	 * @param integer $status
	 * @param array $trade
	 * @param string $method
	 */
	public function sendOriginatorStatusChange ($status, $trade, $method = 'email') {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
	
		//Send out communication to originating user
		$statusWord = 'ERROR';
		if ($status == 2) {
			$statusWord = 'ACCEPTED';
		}
		if ($status == 3) {
			$statusWord = 'REJECTED';
		}
		
		if ($method == 'email') {
			$email = new CakeEmail('default');
			$email->template('tradeRequestOriginatorStatusChange')
			->emailFormat('text')
			->to($trade['User']['email'])
			->subject('[Kitab] Shift trade status update')
			->viewVars(array(
						'user' => $trade['User'],
						'statusWord' => $statusWord,
						'shift' => $trade['Shift']))
			->send();
		}
		return true;
	}

	/**
	* sendRecipientStatusChange method
	* This method will send the recipient of a trade a communication advising of a change in
	* status of the trade, usually accepted or rejected.
	*
	* @param integer $status
	* @param array $trade
	* @param string $method
	*/
	public function sendRecipientStatusChange ($status, $tradesDetail, $method = 'email') {
		App::uses('CakeEmail', 'Network/Email');
		App::uses('TimeHelper', 'View/Helper');
	
		//Send out communication to originating user
		$statusWord = 'ERROR';
		if ($status == 2) {
			$statusWord = 'ACCEPTED';
		}
		if ($status == 3) {
			$statusWord = 'REJECTED';
		}
	
		if ($method == 'email') {
			$email = new CakeEmail('default');
			
			//Send a message to the recipient about the decision
			/*$email->template('tradeRequestRecipientStatusChange')
				->emailFormat('text')
				->to($tradesDetail['User']['email'])
				->subject('[Kitab] Shift trade status update')
				->viewVars(array(
							'userOriginator' => $tradesDetail['Trade']['User'],
							'userRecipient' => $tradesDetail['User'],
							'statusWord' => $statusWord,
							'shift' => $tradesDetail['Trade']['Shift']))
				->send();
			*/
			//Send a message to the originator about the decision
			$email = new CakeEmail('default');
			$email->template('tradeRequestRecipientStatusChangeToOriginator')
				->emailFormat('text')
				->to($tradesDetail['Trade']['User']['email'])
				->subject('[Kitab] '.$tradesDetail['User']['name'].' accepted your trade')
				->viewVars(array(
							'userOriginator' => $tradesDetail['Trade']['User'],
							'userRecipient' => $tradesDetail['User'],
							'statusWord' => $statusWord,
							'shift' => $tradesDetail['Trade']['Shift']))
				->send();
		}
		return true;
	}
}