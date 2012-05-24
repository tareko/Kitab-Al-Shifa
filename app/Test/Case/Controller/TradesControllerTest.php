<?php
App::uses('TradesController', 'Controller');
App::uses('Controller', 'Controller');

/**
 * TestTradesController *
 */
class TestTradesController extends TradesController {
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
 * TradesController Test Case
 *
 */
class TradesControllerTestCase extends ControllerTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.trade', 'app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.trades_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Trades = new TestTradesController();
		$this->Trades->constructClasses();
	}


/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/trades/index');
		debug($result);
	}
/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

/**
 * tearDown method
 *
 * @return void
 */
public function tearDown() {
	unset($this->Trades);

	parent::tearDown();
}
}
