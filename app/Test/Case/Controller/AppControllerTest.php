<?php
/* App Test cases generated on: 2011-12-18 16:21:16 : 1324243276*/
App::uses('AppController', 'Controller');

/**
 * TestAppController *
 */
class TestAppController extends AppController {
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
 * AppController Test Case
 *
 */
class AppControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.user', 'app.profile', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->App = new TestAppController();
		$this->App->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->App);

		parent::tearDown();
	}

}
