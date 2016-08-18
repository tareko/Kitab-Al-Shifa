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
	public $fixtures = array('app.trade', 'app.user', 'app.profile', 'app.shift', 'app.shifts_type', 'app.location', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.trades_detail', 'app.calendar');

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
	public function testHistory() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$result = $this->testAction('/trades/history', array('return' => 'vars'));
		$expected = array(
						'status' => '1',
						'user_id' => '5',
						'user_status' => '2',
						'token' => '15b6a69f207d8f6cd29c66b4cb729d40',
						'shift_id' => '513',
						'id' => '11');
		$this->assertEqual($result['trades'][4]['Trade'], $expected);
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

		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));

		$result = $this->testAction('/trades/index');
		$this->assertContains('<input name="data[Trade][from_user_id]" placeholder="me" class="form-control" type="text" id="TradeFromUserId"/>', $result);
		$this->assertContains('input type=\'date\' id=\'datepicker1\' class=\'form-control\'></div>', $result);
		$this->assertContains('<select name="data[Trade][shift_id]" class="form-control" id="TradeShiftId" required="required">', $result);
		$this->assertContains('<button type="submit" class="btn btn-primary">Submit</button>', $result);
	}

/*	public function testAddQueryId() {
	//Deprecated for now
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$data = array('id' => '2');
		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'get'));
		$this->assertContains('<input name="data[Trade][from_user_id]" type="text" value="2" id="TradeFromUserId"/>', $result);
	}
*/
	public function testAddPost() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		
		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		
		$data = array(
				'Trade' => array(
						'user_id' => 2,
						'shift_id' => 16,
						'confirmed' => 0,
				),
				'TradesDetail' => array(
						0 => array(
								'user_id' => 2
								),
						1 => array(
								'user_id' => 3)
						)
				);

		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$this->assertTrue($result['success']);
	}
	public function testAddPostFailedSaveBadDataNoRecipient() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId',
						'saveAssociated'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		
		$data = array(
				'Trade' => array(
						'user_id' => 1,
						'shift_id' => 16,
						'confirmed' => 0,
				),
		);

		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	public function testAddPostFailedSaveBadDataNoShift() {

		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId',
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		
		$data = array(
				'Trade' => array(
						'user_id' => 1,
						'confirmed' => 0,
				),
				'TradesDetail' => array(
						0 => array(
							'user_id' => 2
						),
						1 => array(
							'user_id' => 3)
						)
			);
		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	/* This test ensures that when a shift is added that has a previously cancelled trade, it will go through.
	 *
	 */
	public function testAddDuplicateCancelled() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(3));
		
		$data = array(
				'Trade' => array(
						'user_id' => 3,
						'shift_id' => 86,
						'confirmed' => 0,
				),
				'TradesDetail' => array(
						0 => array(
								'user_id' => 2
						),
						1 => array(
								'user_id' => 3)
				)
		);

		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$this->assertTrue($result['success']);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

	public function testStartUnprocessed() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_TradeRequest',
						'_requestAllowed'
				),
		));

		$Trades->expects($this->any())
		->method('_TradeRequest')
		->will($this->returnValue(true));
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		
		$result = $this->testAction('/trades/startUnprocessed', array('return' => 'vars'));
		$this->assertTrue($result['success']);
	}

	public function testStartUnprocessedWithFailedProcessing() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'processTrades',
						'_requestAllowed'
				),
		));
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$this->Trade = $this->getMockForModel('Trade', array(
				'processTrades'));
		$this->Trade->expects($this->any())
		->method('processTrades')
		->will($this->returnValue(false));		
		
		$result = $this->testAction('/trades/startUnprocessed', array('return' => 'vars'));
		$this->assertFalse($result['success']);
	}

/**
 * test Accept method
 *
 */
	public function testAcceptNoParams() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
						'methods' => array(
								'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept');
	}

	public function testAcceptNoId() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
							'methods' => array(
									'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?token=abcdefghijklmnopqrstuvwxyzabcdef');
	}

		public function testAcceptNoToken() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
							'methods' => array(
									'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?id=8');
	}

	public function testAcceptWrongToken() {
		$Trades = $this->generate('Trades', array(
							'methods' => array(
									'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?id=12&token=abcdefghijklmnopqrstuvwxyzabcdef');
	}

	public function testAcceptIdNotFound() {
		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?id=12352&token=abcdefghijklmnopqrstuvwxyzabcdef', array('return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	public function testAcceptCorrectIdAndToken() {
		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$result = $this->testAction('/trades/accept?id=12&token=a50e7ad2e87fe32ef46d9bb84db20012');
	}

	public function testAcceptWrongStatus() {
		$Trades = $this->generate('Trades', array(
									'methods' => array(
											'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?id=8&token=a50e7ad2e87fe32ef46d9bb84db20012', array('return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	/**
	* test Reject method
	*
	*/
	public function testRejectNoParams() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
							'methods' => array(
									'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject');
	}

	public function testRejectNoId() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?token=abcdefghijklmnopqrstuvwxyzabcdef');
	}

	public function testRejectNoToken() {
		$this->setExpectedException('NotFoundException');

		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?id=8');
	}

	public function testRejectWrongToken() {
		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?id=12&token=abcdefghijklmnopqrstuvwxyzabcdef');
	}

	public function testRejectIdNotFound() {
		$Trades = $this->generate('Trades', array(
									'methods' => array(
											'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?id=12352&token=abcdefghijklmnopqrstuvwxyzabcdef', array('return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	public function testRejectCorrectIdAndToken() {
		$Trades = $this->generate('Trades', array(
									'methods' => array(
											'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?id=12&token=a50e7ad2e87fe32ef46d9bb84db20012');
	}

	public function testRejectWrongStatus() {
		$Trades = $this->generate('Trades', array(
										'methods' => array(
												'_requestAllowed'
		),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/reject?id=8&token=a50e7ad2e87fe32ef46d9bb84db20012', array('return' => 'vars'));
		$this->assertFalse($result['success']);
	}

	public function testRejectDuplicateTrade() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'_usersId'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		$Trades->expects($this->any())
		->method('_usersId')
		->will($this->returnValue(1));
		
		$data = array(
				'Trade' => array(
						'user_id' => 1,
						'shift_id' => 16,
						'confirmed' => 0,
				),
				'TradesDetail' => array(
						0 => array(
								'user_id' => 2
								),
						1 => array(
								'user_id' => 3)
						)
				);

		$result = $this->testAction('/trades/index', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
//		$this->assertContains('This shift is already in the process', $result);
		$this->assertFalse($result['success']);
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
