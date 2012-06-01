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
	public $fixtures = array('app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.trade', 'app.trades_detail', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map');

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
	public function testGetActiveUsersForGroup() {

	}
/**
 * testGetCommunicationMethod method
 *
 * @return void
 */
	public function testGetCommunicationMethod() {

	}
}
