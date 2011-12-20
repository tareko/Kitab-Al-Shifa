<?php
/* Calendars Test cases generated on: 2011-12-18 16:16:50 : 1324243010*/
App::uses('CalendarsController', 'Controller');
App::uses('Controller', 'Controller');

/**
 * TestCalendarsController *
 */
class TestCalendarsController extends CalendarsController {
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
 * CalendarsController Test Case
 *
 */
class CalendarsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.calendar', 'app.usergroup', 'app.group', 'app.user', 'app.profile', 'app.shifts', 'app.user_usergroup_map');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Calendars = new TestCalendarsController();
		$this->Calendars->constructClasses();
	}

	
    public function testIndex() {
        $result = $this->testAction('/calendars/index');
        debug($result);
    }
		
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendars);

		parent::tearDown();
	}

}
