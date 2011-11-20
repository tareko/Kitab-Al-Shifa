<?php
/* Calendar Test cases generated on: 2011-11-16 05:54:46 : 1321440886*/
App::uses('Calendar', 'Model');

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
	public $fixtures = array('app.calendar', 'app.group');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Calendar = ClassRegistry::init('Calendar');
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
