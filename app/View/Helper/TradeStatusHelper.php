<?php
class TradeStatusHelper extends AppHelper {
	public $helpers = array('Text');

	function TradeStatus($trade, $usersId) {

		$recipients = array();

		//Get all of the tradesDetail users
		foreach ($trade['TradesDetail'] as $tradesDetail) {
			if (!empty($tradesDetail['User']['name'])) {
				$recipients = $recipients + array($tradesDetail['User']['name']);
			}
		}

		//Set variables for easier reading
		$trade_status = array(
				0 => 'Awaiting response from ' . $trade['User']['name'],
				1 => 'Awaiting response from ' . $this->Text->toList($recipients),
				2 => 'Completed',
				3 => 'Refused or canceled'
		);
		if ($trade['Trade']['status'] == 0 && $trade['Trade']['user_status'] == 0) {
			return 'Unprocessed by Kitab Al-Shifa';
		}
		if ($trade['Trade']['status'] == 1 && $trade['TradesDetail'][0]['status'] == 0) {
			return 'Kitab Al-Shifa is waiting to send a message to ' . $this->Text->toList($recipients);
		}
		if ($trade['Trade']['status'] == 0 && $trade['Trade']['user_status'] == 3) {
			return $trade['User']['name'] . ' has declined this trade';
		}

		if ($trade['Trade']['status'] == 1 && $trade['TradesDetail'][0]['status'] == 3) {
			return $trade['TradesDetail'][0]['User']['name'] . ' has declined this trade';
		}
		return $trade_status[$trade['Trade']['status']];
	}
}