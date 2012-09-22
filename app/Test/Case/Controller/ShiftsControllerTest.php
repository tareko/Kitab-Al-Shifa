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
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.calendar', 'app.trade', 'app.user_usergroup_map_j17', 'app.usergroup_j17', 'app.trades_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Shifts = new TestShiftsController();
		$this->Shifts->constructClasses();
		$Shifts = $this->generate('Shifts', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Shifts->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		
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
 * Make sure a list that is specific to one person, contains all people, or is date limited is present.
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/shifts/index');
		$this->assertContains('<td>2011-12-02&nbsp;</td>
		<td><a href="/kitab/locations/view/1">Bermuda</a>&nbsp;</td>
		<td><a href="/kitab/shifts_types/view/3">10-16 U45</a>&nbsp;</td>
		<td><a href="/kitab/users/view/2">Harold Morrissey</a>&nbsp;</td>
		<td>2011-10-19 08:23:49&nbsp;</td>', $result);
	}

	public function testIndexId() {
		$result = $this->testAction('/shifts/index/id:1');
		$this->assertContains('<td>2013-12-28&nbsp;</td>
		<td><a href="/kitab/locations/view/1">Bermuda</a>&nbsp;</td>
		<td><a href="/kitab/shifts_types/view/12">04-10 </a>&nbsp;</td>
		<td><a href="/kitab/users/view/1">James Bynum</a>&nbsp;</td>
		<td>2011-10-19 16:55:23&nbsp;</td>', $result);
	}
	
	//TODO: This is probably wrong. Calendar #1 doesn't include the dates shown.
	public function testIndexCalendar() {
		$result = $this->testAction('/shifts/index/calendar:1');
		$this->assertContains('<td>2011-12-11&nbsp;</td>
		<td><a href="/kitab/locations/view/3">Come on pretty mama</a>&nbsp;</td>
		<td><a href="/kitab/shifts_types/view/10">08-15 </a>&nbsp;</td>
		<td><a href="/kitab/users/view/3">Madeline Cremin</a>&nbsp;</td>
		<td>2011-10-19 10:35:51&nbsp;</td>', $result);
		$this->assertTextNotContains('<td>2013-12-30&nbsp;</td>
		<td><a href="/kitab/locations/view/1">Bermuda</a>&nbsp;</td>
		<td><a href="/kitab/shifts_types/view/12">04-10 </a>&nbsp;</td>
		<td><a href="/kitab/users/view/3">Madeline Cremin</a>&nbsp;</td>
		<td>2011-10-19 16:55:23&nbsp;</td>', $result);
	}
	

	public function testIndexCalendarId() {
		$result = $this->testAction('/shifts/index/calendar:1/id:1');
		$this->assertContains('Page 1 of 1, showing 2 records out of 2 total, starting on record 1, ending on 2	</p>', $result);
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
		$this->setExpectedException('NotFoundException');
 		$result = $this->testAction('/shifts/edit');
	}
	public function testEditId() {
		$result = $this->testAction('/shifts/edit/16');
		debug($result);
	}

	
/**
 * testCalendarViewProperFormURL method
 *  Addresses Issue #61
 */
	
	public function testCalendarViewProperFormURL() {
		$result = $this->testAction('/shifts/calendarView/calendar:1');
		$this->assertContains('form action="/kitab/shifts/calendarView/calendar:1', $result);
	}

/**
 * testCalendarEditProperFormURL method
 *  Addresses Issue #61
 */
	
	public function testCalendarEditProperFormURL() {
		$result = $this->testAction('/shifts/calendarEdit/calendar:1/id:1');
		$this->assertContains('form action="/kitab/shifts/calendarEdit/calendar:1/id:1', $result);
	}

/**
 * testIndexProperFormURL method
 *  Addresses Issue #61
 */
	
	public function testIndexViewProperFormURL() {
		$result = $this->testAction('/shifts/index/calendar:1');
		$this->assertContains('form action="/kitab/shifts/index/calendar:1', $result);
	}
	
/**
* testHome method
*/
	
	public function testHome() {
		$this->Shifts->constructClasses();
		$Shifts = $this->generate('Shifts', array(
						'methods' => array(
								'_requestAllowed',
								'_usersId'
					),
		));
		
		$Shifts->expects($this->any())
			->method('_requestAllowed')
			->will($this->returnValue(true));
		$Shifts->expects($this->any())
			->method('_usersId')
			->will($this->returnValue(1));
		

		$result = $this->testAction('/shifts/home');
		$this->assertContains('<tr>
		<td>2013-11-22</td>
		<td>Bermuda</td>
		<td>04-10 </td>', $result);
	}
/**
* testWizard method
*/
	
	public function testWizard() {
		$result = $this->testAction('/shifts/wizard');
		$this->assertContains('<legend>Shifts To Show</legend>', $result);
	}
	
}
