<?php
/* Calendar Test cases generated on: 2011-11-16 05:54:46 : 1321440886*/
App::uses('Calendar', 'Model');
App::uses('Shift', 'Model');

/**
 * Calendar Test Case
 *
 */
class CalendarTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.calendar', 'app.group', 'app.usergroup', 'app.user', 'app.shiftsType', 'app.trade', 'app.shift');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Calendar = ClassRegistry::init('Calendar');
		$this->Shift = ClassRegistry::init('Shift');

	}

	/*
	 * Test last-updated call
	 */
	public function testLastUpdated () {
		$result = $this->Calendar->lastUpdated('1');
		$expected = '2011-10-19 10:36:51';
		$this->assertEquals($expected, $result);
	}

	/*
	 * Test start and end dates call
	 */
	public function testGetStartEndDates() {
		$result = $this->Calendar->getStartEndDates('1');
		$expected = array(
			'start_date' => '2011-12-01',
			'end_date' => '2011-12-22'
		);
		$this->assertEquals($expected, $result);
	}

	/*
	 * Test get list
	 */
	public function testGetList() {
		$result = $this->Calendar->getList();
		$expected = array(
			'2012-06-01' => 'June 2012'
		);
		$this->assertEquals($expected, $result[10]);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendar);
		ClassRegistry::flush();

		parent::tearDown();
	}

}
