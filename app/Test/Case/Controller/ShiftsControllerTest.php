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
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.calendar', 'app.trade');

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
		$result = $this->testAction('/shifts/add');
		debug($result);
	}

/**
 * testPdfCreate method
 *
 * @return void
 */
	public function testPdfCreateNoCalGiven() {
		$result = $this->testAction('/shifts/pdfCreate');
		debug($result);
	}

	public function testPdfCreateCalGiven() {
		$result = $this->testAction('/shifts/pdfCreate/calendar:1');
		debug($result);
	}
	
/**
 * testCalendarEdit method
 *
 * @return void
 */
	public function testCalendarEditNoCalGiven() {
		$result = $this->testAction('/shifts/calendarEdit');
		debug($result);
	}

	public function testCalendarEditCalGiven() {
		$result = $this->testAction('/shifts/calendarEdit/calendar:1');
		debug($result);
	}
	
/**
 * testCalendarView method
 *
 * @return void
 */
	public function testCalendarViewNoCalGiven() {
		$result = $this->testAction('/shifts/calendarView');
		debug($result);
	}
	
	public function testCalendarViewCalGiven() {
		$result = $this->testAction('/shifts/calendarView/calendar:1');
		debug($result);
	}

	public function testCalendarViewIdGiven() {
		$result = $this->testAction('/shifts/calendarView/calendar:1/id:2');
		debug($result);
	}
	public function testCalendarViewIdNoCalGiven() {
		$result = $this->testAction('/shifts/calendarView/id:2');
		debug($result);
	}
	
/**
 * testPdfView method
 *
 * @return void
 */
	public function testPdfView() {
		$result = $this->testAction('/shifts/pdfView');
		debug($result);
	}
	
/**
 * testIcsView method
 *
 * @return void
 */
	public function testIcsViewNoId() {
		$result = $this->testAction('/shifts/icsView');
		debug($result);
	}
	public function testIcsViewId() {
		$result = $this->testAction('/shifts/icsView/id:1');
		debug($result);
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
 * @expectedException NotFoundException
 */
	public function testDeleteNoId() {
		$this->setExpectedException('NotFoundException');
		$result = $this->testAction('/shifts/delete');
	}
	public function testDeleteId() {
		$result = $this->testAction('/shifts/delete/52');
		debug($result);
	}
	
/**
 * testEdit method
 *
 * @return void
 * @expectedException NotFoundException
 */
 	public function testEditNoId() {
		$result = $this->testAction('/shifts/edit');
		$this->setExpectedException('NotFoundException');
	}
	public function testEditId() {
		$result = $this->testAction('/shifts/edit/16');
		debug($result);
	}
	
}
