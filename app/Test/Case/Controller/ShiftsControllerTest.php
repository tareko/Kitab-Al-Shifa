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
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.calendar', 'app.trade', 'app.user_usergroup_map_jem5', 'app.usergroup_jem5', 'app.trades_detail');

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
		<td><a href="/locations/view/1">Bermuda</a>&nbsp;</td>
		<td><a href="/shifts_types/view/3">1000-1600 U45</a>&nbsp;</td>
		<td><a href="/users/view/2">Harold Morrissey</a>&nbsp;</td>
		<td>2011-10-19 08:23:49&nbsp;</td>', $result);
	}

	public function testIndexId() {
		$result = $this->testAction('/shifts/index/id:1');
		$this->assertContains('<td><a href="/shifts_types/view/8">1000-1800 </a>&nbsp;</td>', $result);
	}

	//TODO: This is probably wrong. Calendar #1 doesn't include the dates shown.
	public function testIndexCalendar() {
		$result = $this->testAction('/shifts/index/calendar:1');
		$this->assertContains('<td><a href="/shifts_types/view/6">0800-1600 </a>&nbsp;</td>', $result);
		$this->assertTextNotContains('<td><a href="/kitab/shifts_types/view/12">04-10 </a>&nbsp;</td>', $result);
	}


	public function testIndexCalendarId() {
		$result = $this->testAction('/shifts/index/calendar:1/id:1');
		$this->assertContains('Page 1 of 1, showing 2 records out of 2 total, starting on record 1, ending on 2	</p>', $result);
	}

	/**
	 * testAdd method
	 * Display empty add page
	 * @return void
	 */
	public function testAdd1() {
		$result = $this->testAction('/shifts/add');
		$this->assertContains('<select name="data[Shift][0][date][year]" id="Shift0DateYear"', $result);
	}

	/**
	 * testAdd method
	 * $this->data with save == true
	 * @return void
	 */
	public function testAdd2() {

		$data = array(
			'Shift' => array(
				0 => array(
					'user_id' => '2',
					'date' => array(
						'month' => '01',
						'day' => '01',
						'year' => '2034'
					),
					'shifts_type_id' => '2'
				)
			)
		);


		$Shifts = $this->generate('Shifts', array(
				'methods' => array(
						'_requestAllowed'),
				'components' => array(
						'Flash' => array('success')),
				)
		);

		$Shifts->Flash
		->expects($this->once())
		->method('success');

		$Shifts->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$this->Shift = $this->getMockForModel('Shift', array(
				'saveAll'));

		// Mock saveAll function
		$this->Shift->expects($this->any())
		->method('saveAll')
		->will($this->returnValue(true));

		$result = $this->testAction('/shifts/add', array('data' => $data, 'method' => 'post'));
	}

	/**
	 * testAdd method
	 * $this->data with save == true
	 * @return void
	 */
	public function testAdd3() {

		$data = array(
				'Shift' => array(
						0 => array(
								'user_id' => '2',
								'date' => array(
										'month' => '01',
										'day' => '01',
										'year' => '2034'
								),
								'shifts_type_id' => '2'
						)
				)
		);


		$Shifts = $this->generate('Shifts', array(
				'methods' => array(
						'_requestAllowed'),
				'components' => array(
						'Flash' => array('alert')),
		)
		);

		$Shifts->Flash
		->expects($this->once())
		->method('alert');

		$Shifts->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$this->Shift = $this->getMockForModel('Shift', array(
				'saveAll'));

		// Mock saveAll function
		$this->Shift->expects($this->any())
		->method('saveAll')
		->will($this->returnValue(false));

		$result = $this->testAction('/shifts/add', array('data' => $data, 'method' => 'post'));
	}

/**
 * testCalendarEdit method
 *
 * @return void
 */

	// CalendarEdit with no calendar given
	public function testCalendarEditNoCalGiven() {
		$Shifts = $this->generate('Shifts', array(
				'methods' => array(
						'_requestAllowed'),
				'components' => array(
						'Flash' => array('alert')),
		)
		);

		$Shifts->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$this->testAction('/shifts/calendarEdit');
		$this->assertContains('/shifts/calendarList?calendar_action=calendarEdit', $this->headers['Location']);
	}

	public function testCalendarEditCalGiven() {
		$this->testAction('/shifts/calendarEdit/calendar:1');
		$this->assertContains('<form action="/shifts/add/Action:calendarEdit/calendar:1"', $this->view);
	}

/**
 * testCalendarView method
 *
 * @return void
 */
	public function testCalendarViewNoCalGiven() {
		$this->testAction('/shifts/calendarView');
		$this->assertContains('/shifts/calendarList?calendar_action=calendarView', $this->headers['Location']);
	}

	public function testCalendarViewCalGiven() {
		$result = $this->testAction('/shifts/calendarView/calendar:1');
		$this->assertContains('<td>Thu, Dec 1</td> <td>&nbsp;</td> <td>&nbsp;</td> <td><a href="/shifts/edit/16">Bynum</a></td>', $this->contents);
	}

	public function testCalendarViewIdGiven() {
		$result = $this->testAction('/shifts/calendarView/calendar:1/id:2');
		$this->assertContains('<td>Fri, Dec 2</td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> <td><a href="/shifts/edit/52">Morrissey</a></td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td>', $this->contents);
	}
	public function testCalendarViewIdNoCalGiven() {
		$result = $this->testAction('/shifts/calendarView/id:2');
		$this->assertEqual($result, null);
	}


/**
 * testIcsView method
 *
 * @return void
 */
	public function testIcsViewNoId() {
		$result = $this->testAction('/shifts/icsView');
		$this->assertContains('<form action="/shifts/icsView" id="ShiftPhysic', $result);
	}

	public function testIcsViewId() {
		$this->markTestIncomplete('testIcsViewId broken due to inability to mock $this->iCal->render');
/*
		$Shifts = $this->generate('Shifts', array(
		    'helpers' => array(
		    		'iCal'
		    		)
		));

		$this->iCal = new iCalHelper(new View());
		$this->iCal = $this->getMock('iCal', array('render'));

 		$this->iCal->expects($this->once())
			->method('render')
			->will($this->returnValue(true));
//		$result = $this->testAction('/shifts/icsView/id:1');
		debug($this->iCal->render);
 */
	}

/**
 * testCalendarList method
 *
 * @return void
 */
	public function testCalendarList() {
		$this->markTestIncomplete('testCalendarList not implemented.');
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

	public function testDeleteNotPost() {
		$this->setExpectedException('NotFoundException');
		$this->testAction('/shifts/delete', array('data' => null, 'method' => 'get'));
	}

	public function testDeleteId() {
		$this->testAction('/shifts/delete/52');
		$this->assertContains('/shifts', $this->headers['Location']);
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
		$this->testAction('/shifts/edit/16');
		$this->assertContains('form action="/shifts/edit/16" id="ShiftEditForm"', $this->contents);
	}

	// Tests to make sure that delete and so on is possible. Tests issue #113
	public function testEditId2() {
		$result = $this->testAction('/shifts/edit/16', array('return' => 'vars'));
		$this->assertContains('Bynum', $result['physicians']['1']);
		$this->assertContains('1 - 2200 - 0400', $result['shiftsTypes']['13']);
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
		$this->assertContains('<h2>My upcoming shifts:</h2>', $result);
	}
/**
* testWizard method
*/

	public function testWizard() {
		$result = $this->testAction('/shifts/wizard');
		$this->assertContains('<h2>Which calendar do you want to see?</h2>', $result);
	}

/**
* testMarketplace method
*/

	// Only save if proper user
	public function testMarketplaceUser() {
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
		$result = $this->testAction('/shifts/marketplace/16/1', array('return' => 'vars'));
		$this->markTestIncomplete('testMarketplaceUser not implemented.');
	}

}
