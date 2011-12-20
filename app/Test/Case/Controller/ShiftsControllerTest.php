<?php
/* Shifts Test cases generated on: 2011-12-18 16:47:48 : 1324244868*/
App::uses('ShiftsController', 'Controller');
App::uses('Controller', 'Controller');

/**
 * TestShiftsController *
 */
class TestShiftsController extends ShiftsController {
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
 * ShiftsController Test Case
 *
 */
class ShiftsControllerTestCase extends ControllerTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.shifts_types');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Shifts = new TestShiftsController();
		$this->Shifts->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shifts);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/shifts/index');
		debug($result);
	}

	public function testIndexNamed() {
		$result = $this->testAction('/shifts/index/id:294');
		debug($result);
	}
	
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}

/**
 * testPdfCreate method
 *
 * @return void
 */
	public function testPdfCreate() {

	}

/**
 * testCalendarEdit method
 *
 * @return void
 */
	public function testCalendarEdit() {

	}

/**
 * testCalendarView method
 *
 * @return void
 */
	public function testCalendarView() {

	}

/**
 * testPdfView method
 *
 * @return void
 */
	public function testPdfView() {

	}

/**
 * testIcsView method
 *
 * @return void
 */
	public function testIcsView() {

	}

/**
 * testIcsList method
 *
 * @return void
 */
	public function testIcsList() {

	}

/**
 * testCalendarList method
 *
 * @return void
 */
	public function testCalendarList() {

	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

}
