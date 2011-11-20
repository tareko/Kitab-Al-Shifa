<?php
/* Calendars Test cases generated on: 2011-11-11 16:13:39 : 1321046019*/
App::uses('Calendars', 'Controller');

/**
 * TestCalendars 
 *
 */
class TestCalendars extends Calendars {
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
 * Calendars Test Case
 *
 */
class CalendarsTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.calendar');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Calendars = new TestCalendars();
		$this->Calendar->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendars);
		ClassRegistry::flush();

		parent::tearDown();
	}

}
