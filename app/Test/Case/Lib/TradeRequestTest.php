<?php
App::import('Lib', 'TradeRequest');

class TradeRequestTest extends CakeTestCase {

	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.calendar', 'app.trade', 'app.user_usergroup_map_jem5', 'app.usergroup_jem5', 'app.trades_detail');


/**
 * test memory usage
 *
 * @return void
 */

	public function testsend() {

		// Mock email function
		$this->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => true)));

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

		$result = $this->_TradeRequest->send(5, $user, $shift, 'email');
		$this->assertEqual($result['return'], true);
	}
}