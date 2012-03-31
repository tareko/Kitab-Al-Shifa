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

/**
 * CalendarsController Test Case
 *
 */
class UrlEncodeTestCase extends ControllerTestCase {

/**
	* Test that a request with urlencoded bits in the main GET parameter are filtered out.
	*
	* @return void
	*/
	public function testGetParamWithUrlencodedElement() {
		$_GET = array();
		$_GET['/shifts/calendarView/id:1'] = '';
//		$_SERVER['PHP_SELF'] = '/app/webroot/index.php';
		$_SERVER['REQUEST_URI'] = '/shifts/calendarView/id%3A1';
	
		$request = new CakeRequest();
		$this->assertEquals(array(), $request->query);
	}
}