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
	public $fixtures = array('app.trade', 'app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.shifts', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.trades_detail', 'app.calendar');

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
 * testCompare method
 * Ensure that the appropriate form is put out
 *
 * @return void
 */
	public function testCompare() {

		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$result = $this->testAction('/trades/compare');
		$this->assertContains('itemName: \'data[User]', $result);
		$this->assertContains('<div class="input select"><select name="data[Calendar][id]" required="1" id="CalendarId">', $result);
	}

/**
 * testCompareSubmitted method
 * Ensure that the form redirects properly when appropriate info is entered
 *
 * @return void
 */
	public function testCompareSubmitted() {

		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Trades->expects($this->any())
			->method('_requestAllowed')
			->will($this->returnValue(true));

		$data = array(
				'User' => array(
						'0' => array(
								'id' => 1
								),
						'1' => array(
								'id' => 2
								)
				),
				'Calendar' => array(
						'id' => 1
				)
		);

		$this->testAction(
				'/trades/compare',
				array('data' => $data, 'method' => 'post')
		);
		$this->assertContains('shifts/calendarView/id[0]:1/id[1]:2/calendar:1', $this->headers['Location']);
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
