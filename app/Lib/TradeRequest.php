<?php

class TradeRequest {
	public function send($fromUser, $toUser, $method) {
		App::uses('CakeEmail', 'Network/Email');
		if ($method == 'email') {
		$message = 'Dear '. $toUser['name'].',\n\n
You have received a trade request from '.$fromUser['name'].'.\n\n
The proposed trade is as follows:\n
You take THEIR SHIFT\n
'.$fromUser['name'].' takes YOUR SHIFT\n\n
To *ACCEPT*, click here:\n
AGREE LINK
\n\n
To *REJECT*, click here:\n
REJECT LINK\n\n
Thank you for your response,\n
Kitab Al Shifa Mail Bot : )';
			
			$email = new CakeEmail('default');
			$email->to($toUser['email'])
				->subject('[Kitab] Shift trade with' .$fromUser['name'])
				->send($message);
		}
	}
}