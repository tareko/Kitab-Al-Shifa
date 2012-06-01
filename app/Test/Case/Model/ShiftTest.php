<?php
App::uses('Shift', 'Model');

/**
 * Shift Test Case
 *
 */
class ShiftTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.trade', 'app.trades_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Shift = ClassRegistry::init('Shift');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shift);

		parent::tearDown();
	}

/**
 * testGetShiftList method
 *
 * @return void
 */
	public function testGetShiftList() {

	}
}
