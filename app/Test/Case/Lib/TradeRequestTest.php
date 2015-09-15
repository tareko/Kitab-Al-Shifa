<?php
App::import('Lib', 'TradeRequest');

class TradeRequestTest extends CakeTestCase {
	
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.calendar', 'app.trade', 'app.user_usergroup_map_jem5', 'app.usergroup_jem5', 'app.trades_detail');
	

/**
 * test memory usage
 *
 * @return void
 */
	public function testSend() {
		
	}

	public function testsendOriginator() {
		
		$this->_TradeRequest = new TradeRequest();
		App::uses('CakeEmail', 'Network/Email');
		
		$CakeEmail = $this->getMock('CakeEmail' , array('send'));

		$CakeEmail->expects($this->any())
		->method('send')
		->will($this->returnValue(false));

		$email = new CakeEmail('default');
		
		debug($CakeEmail
				->emailFormat('text')
				->to('test@test.com')
				->subject('[Kitab] Shift trade request by you')
				->send());

		$user = array(
				'email' => 'test@test.com',
				'name' => 'Test user',
				);
		$shift = array(
				'date' => '2015-01-24',
				'ShiftsType' => array(
						'Location' => array(
								'location' => 'test location'),
						'times' => '18-20h'));
				
		$result = $this->_TradeRequest->sendOriginator(5, $user, $shift, 'email');
		debug($result);
		debug('Please review debug.log for contents of email');
	}

	public function testsendOriginatorRecipientConfirmed() {
		
		$this->_TradeRequest = new TradeRequest();
		App::uses('CakeEmail', 'Network/Email');
		
		$CakeEmail = $this->getMock('CakeEmail' , array('send'));

		$CakeEmail->expects($this->any())
		->method('send')
		->will($this->returnValue(false));
		
		$user = array(
				'email' => 'test@test.com',
				'name' => 'Test user',
				);
		$shift = array(
				'date' => '2015-01-24',
				'ShiftsType' => 1);
		$result = $this->_TradeRequest->sendOriginatorRecipientConfirmed(5, $user, $shift, 'email');
		debug($result);
	}
}