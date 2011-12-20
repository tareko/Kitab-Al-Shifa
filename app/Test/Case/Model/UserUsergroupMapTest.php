<?php
/* UserUsergroupMap Test cases generated on: 2011-12-19 18:49:45 : 1324338585*/
App::uses('UserUsergroupMap', 'Model');

/**
 * UserUsergroupMap Test Case
 *
 */
class UserUsergroupMapTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.user_usergroup_map');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->UserUsergroupMap = ClassRegistry::init('UserUsergroupMap');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserUsergroupMap);

		parent::tearDown();
	}

}
