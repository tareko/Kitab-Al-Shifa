<?php
/* Calendars Test cases generated on: 2011-12-19 19:30:08 : 1324341008*/
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

class UrlEncodeTestCase extends ControllerTestCase {

	/**
	 * Test that a request with urlencoded bits in the main GET parameter are filtered out.
	 *
	 * @return void
	 */
	public function testGetParamWithUrlencodedElement() {
		$_GET = array();
		$_GET['/shifts/calendarView/id:1'] = '';
		$_SERVER['REQUEST_URI'] = '/shifts/calendarView/id%3A1';

		$request = new CakeRequest();
		$this->assertEquals(array(), $request->query);
	}
}

/**
 * CalendarsController Test Case
 *
 */
class CalendarsControllerTestCase extends ControllerTestCase {
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

	public function testViewNoId() {
		$this->setExpectedException('NotFoundException');
		$result = $this->testAction('/calendars/view');
	}
	public function testViewWrongId() {
		$this->setExpectedException('NotFoundException');
		$result = $this->testAction('/calendars/view/1888');
	}
	public function testViewId() {
		$result = $this->testAction('/calendars/view/1');
		debug ($result);
	}
	public function testAddEmpty() {
		$result = $this->testAction('/calendars/add');
		debug ($result);
	}

	public function testAddWithData() {
	$data = array(
			'Calendar' => array(
					'usergroups_id' => 1,
					'name' => 'Test Calendar',
					'start_date' => array(
							'month' => '12',
							'day' => '11',
							'year' => '2012'),
					'end_date' => array(
							'month' => '1',
							'day' => '11',
							'year' => '2013'),
					'published' => 1,
					'comments' => 'Comments for test calendar'
			)
	);
	$result = $this->testAction(
			'/calendars/add',
			array('data' => $data, 'method' => 'post'));
	debug($result);
	}

	public function testAddWithBadData() {
//TODO: NOT WORKING
		$this->setExpectedException('NotFoundException');
		$data = array();
		$result = $this->testAction(
				'/calendars/add',
				array('data' => $data, 'method' => 'post'));
	}

	public function testEditNoId() {
		$this->setExpectedException('NotFoundException');
		$result = $this->testAction('/calendars/edit');
	}
	public function testEditWrongId() {
		$this->setExpectedException('NotFoundException');
		$result = $this->testAction('/calendars/edit/1888');
	}
	public function testEditId() {
		$result = $this->testAction('/calendars/edit/1');
		debug ($result);
	}

	public function testEditWithData() {
		$data = array(
				'Calendar' => array(
						'usergroups_id' => '1',
						'name' => 'Test Calendar',
						'start_date' => array(
								'month' => '12',
								'day' => '11',
								'year' => '2012'),
						'end_date' => array(
								'month' => '1',
								'day' => '11',
								'year' => '2013'),
						'published' => 1,
						'comments' => 'Comments for test calendar'
				)
		);
		$result = $this->testAction(
				'/calendars/edit/1',
				array('data' => $data, 'method' => 'post'));
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
