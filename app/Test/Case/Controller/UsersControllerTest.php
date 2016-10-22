<?php
/* Users Test cases generated on: 2011-12-06 04:28:56 : 1323163736*/
App::uses('UsersController', 'Controller');
App::uses('Controller', 'Controller');

/**
 * TestUsersController *
 */
class TestUsersController extends UsersController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * UsersController Test Case
 *
 */
class UsersControllerTestCase extends ControllerTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
			'app.user',
			'app.profile',
			'app.shift',
			'app.usergroup',
			'app.user_usergroup_map',
			'app.group',
			'app.preference',
			'app.calendar',
			'app.trade',
			'app.trades_detail'
		);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Users = new TestUsersController();
		$this->Users->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Users);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {

	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {

	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {

	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {

	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {

	}
/**
 * testListUsers method
 *
 */

	public function testListUsersPermissionDenied() {
		$Users = $this->generate('Users', array(
						'methods' => array(
							'_requestAllowed'
						),
		));

		$Users->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/users/listUsers');
		$this->assertEqual($result, '');
	}

	public function testListUsersPermissionGranted() {
		$Users = $this->generate('Users', array(
						'methods' => array(
							'_requestAllowed',
							'_usersId'
						),
		));

		$Users->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$Users->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));

		$result = $this->testAction('/users/listUsers.json');
		$this->assertEqual($result, '');
	}

	// Test if non-admin user can give other people's preferences
	public function testPrefUserNotAdminPermissionDenied() {
		$Users = $this->generate('Users', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId',
						'_isadmin'
				),
		));

		$Users->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Users->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		$Users->expects($this->any())
		->method('_isadmin')
		->will($this->returnValue(false));

		$result = $this->testAction('/users/preferences?id=2', array('return' => 'vars'));
		$this->assertEqual($result['user']['User']['id'], 1);
		$this->assertEqual($result['admin'], false);
	}

	// Make sure admin user can get/set other people's preferences
	public function testPrefUserAdminPermissionAllowed() {
		$Users = $this->generate('Users', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId',
						'_isadmin'
				),
		));

		$Users->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Users->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		$Users->expects($this->any())
		->method('_isadmin')
		->will($this->returnValue(true));

		$result = $this->testAction('/users/preferences?id=2', array('return' => 'vars'));
		$this->assertEqual($result['user']['User']['id'], 2);
		$this->assertEqual($result['admin'], true);
	}

}
