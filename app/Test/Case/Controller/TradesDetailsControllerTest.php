<?php
App::uses('TradesDetailsController', 'Controller');
App::uses('Controller', 'Controller');

/**
 * TestTradesDetailsController *
 */
class TestTradesDetailsController extends TradesDetailsController {
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
 * TradesDetailsController Test Case
 *
 */
class TradesDetailsControllerTestCase extends ControllerTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.trades_detail', 'app.trade', 'app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TradesDetails = new TestTradesDetailsController();
		$this->TradesDetails->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TradesDetails);

		parent::tearDown();
	}

/**
 * testProcessTrade method
 *
 * @return void
 */
	public function testProcessTrade() {
		
	}
}
