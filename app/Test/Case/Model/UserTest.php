<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.trade', 'app.trades_detail', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.user_usergroup_map_jem5', 'app.usergroup_jem5');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

/**
 * testGetList method
 *
 * @return void
 */
	public function testGetListNoArgs() {
		$result = $this->User->getList();
		$expected = array(
			'4' => array('User' => array('id' => 4), 'Profile' => array('cb_displayname' => 'Beaudoin')),
			'1' => array('User' => array('id' => 1), 'Profile' => array('cb_displayname' => 'Bynum')),
			'5' => array('User' => array('id' => 5), 'Profile' => array('cb_displayname' => 'Chatigny')),
			'3' => array('User' => array('id' => 3), 'Profile' => array('cb_displayname' => 'Cremin')),
			'2' => array('User' => array('id' => 2), 'Profile' => array('cb_displayname' => 'Morrissey')),
		);
		$this->assertEquals($expected, $result);
	}
	public function testGetListConditions() {
		$result = $this->User->getList(array('User.id' => 1));
		$expected = array(
			'1' => array('User' => array('id' => 1), 'Profile' => array('cb_displayname' => 'Bynum')),
		);
	}
	public function testGetListConditionsFull() {
		$result = $this->User->getList(array('User.id' => 1), true);
		$expected = array(
			'1' => array('User' => array('id' => 1), 'Profile' => array('firstname' => 'James', 'lastname' => 'Bynum')),
		);
	}
	public function testGetListConditionsFullList() {
		$result = $this->User->getList(array('User.id' => 1), true, true);
		$expected = array(
					'1' => 'James Bynum');
	}
	public function testGetListConditionsNotFullList() {
		$result = $this->User->getList(array('User.id' => 1), NULL, true);
		$expected = array(
						'1' => 'Bynum');
	}
	
/**
 * testGetActiveUsersForGroup method
 *
 * @return void
 */
	public function testGetActiveUsersForGroupNoArgs() {
		$this->setExpectedException('BadRequestException');
		$result = $this->User->getActiveUsersForGroup();
	}

	public function testGetActiveUsersForGroup() {
		$result = $this->User->getActiveUsersForGroup('2');
		$expected = array(
				'0' => array('User' => array('id' => 1), 'Profile' => array('cb_displayname' => 'Bynum'))
		);
		$this->assertEquals($expected, $result);
	}
	public function testGetActiveUsersForGroupFull() {
		$result = $this->User->getActiveUsersForGroup('2', true);
		$expected = array(
			'0' => array('User' => array('id' => 1), 'Profile' => array('firstname' => 'James', 'lastname' => 'Bynum')),
		);
		$this->assertEquals($expected, $result);
	}
	// TODO put in some conditions
	public function testGetActiveUsersForGroupFullConditions() {
		$result = $this->User->getActiveUsersForGroup('2', true, array());
		$expected = array(
			'0' => array('User' => array('id' => 1), 'Profile' => array('firstname' => 'James', 'lastname' => 'Bynum')),
		);
		$this->assertEquals($expected, $result);
	}
	public function testGetActiveUsersForGroupFullConditionsList() {
		$result = $this->User->getActiveUsersForGroup('2', true, array(), true);
		$expected = array('1' => 'James Bynum');
		$this->assertEquals($expected, $result);
	}
	public function testGetActiveUsersForGroupNotFullConditionsList() {
		$result = $this->User->getActiveUsersForGroup('2', false, array(), true);
		$expected = array('1' => 'Bynum');
		$this->assertEquals($expected, $result);
	}
	
	/*
	 * This test is to ensure that the correct date and time is returned when trying to ascertain
	 * limits for testing whether user is working
	 */ 
	
	public function testExcludeTimesEarlyStart() {
		$userList = array(
				0 => array('User'=> array('id' => 1)),
				1 => array('User'=> array('id' => 2)),
				2 => array('User'=> array('id' => 3)),
				3 => array('User'=> array('id' => 4)),
				4 => array('User'=> array('id' => 5)));
		$result = $this->User->excludeWorkingUsers ($userList, '523', "08:00:00");
		if (!isset($result[4]['User'])) { $result = false; }
		$this->assertFalse($result);
	}

	public function testExcludeTimesMiddleStart() {
		$userList = array(
				0 => array('User'=> array('id' => 1)),
				1 => array('User'=> array('id' => 2)),
				2 => array('User'=> array('id' => 3)),
				3 => array('User'=> array('id' => 4)),
				4 => array('User'=> array('id' => 5)));
		$result = $this->User->excludeWorkingUsers ($userList, '196', "08:00:00");
		if ($result[1]['User'] != 2) { $result = false; }
		$this->assertFalse($result);
	}
	
	public function testExcludeTimesLateStart() {
		$userList = array(
				0 => array('User'=> array('id' => 1)),
				1 => array('User'=> array('id' => 2)),
				2 => array('User'=> array('id' => 3)),
				3 => array('User'=> array('id' => 4)),
				4 => array('User'=> array('id' => 5)));
		$result = $this->User->excludeWorkingUsers ($userList, '524', "08:00:00");
			if (!isset($result[4]['User'])) { $result = false; }
		$this->assertFalse($result);
	}

	// Test lookupUserId function
	public function testLookupUserId() {
		$result = $this->User->lookupUserId('Bynum', 'lastname');
		$expected = '1';
		$this->assertEquals($expected, $result);
	}
	
	// Test lookupUserId function with not found lastname
	public function testLookupUserIdNoMatch() {
		$result = $this->User->lookupUserId('Bynum22', 'lastname');
		$expected = false;
		$this->assertEquals($expected, $result);
	}

/**
 * testGetCommunicationMethod method
 *
 * @return void
 */
	public function testGetCommunicationMethod() {
		$result = $this->User->getCommunicationMethod('1');
		$expected = 'email';
		$this->assertEquals($expected, $result);
	}

/**
 * testexcludeWorkingUsers method with no defined excludeShift
 */
	public function testExcludingWorkingUsersNoExclude() {
		$this->setExpectedException('BadRequestException');
		$result = $this->User->excludeWorkingUsers(array(), false);
	}
}
