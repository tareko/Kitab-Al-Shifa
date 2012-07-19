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
		
		$result = $this->testAction('/trades/add');
		$this->assertContains('<input name="data[Trade][from_user_id]" type="text" value="me" id="TradeFromUserId"/>', $result);
		$this->assertContains('<div id="datepicker1"></div>', $result);
		$this->assertContains('<select name="data[Trade][shift_id]" id="TradeShiftId">', $result);
		$this->assertContains('<ul id="tags">
	</ul>', $result);
		$this->assertContains('<div class="submit"><input  type="submit" value="Submit"/></div>', $result);
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
		$result = $this->testAction('/trades/add', array('data' => $data, 'method' => 'get'));
		$this->assertContains('<input name="data[Trade][from_user_id]" type="text" value="2" id="TradeFromUserId"/>', $result);
	}
*/
	public function testAddPost() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$data = array(
				'Trade' => array(
						'user_id' => 2,
						'shift_id' => 16,
				),
				'TradesDetail' => array(
						0 => array(
								'user_id' => 2
								),
						1 => array(
								'user_id' => 3)
						)
				);

		$result = $this->testAction('/trades/add', array('data' => $data, 'method' => 'post'));
		$this->assertEqual($this->headers['Location'], 'http://127.0.0.1/kitab/trades');
	}
	public function testAddPostFailedSaveBadDataNoRecipient() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed',
						'saveAssociated'
				),
		));

		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$data = array(
				'Trade' => array(
						'user_id' => 1,
						'shift_id' => 16,
				),
		);
	
		$result = $this->testAction('/trades/add', array('data' => $data, 'method' => 'post'));
		$this->assertContains('<div class="error-message">Please enter at least one recipient</div>', $result);
	}
	
	public function testAddPostFailedSaveBadDataNoShift() {
	
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
		
		$data = array(
				'Trade' => array(
						'user_id' => 1,
			),
				'TradesDetail' => array(
						0 => array(
							'user_id' => 2
						),
						1 => array(
							'user_id' => 3)
						)
			);
		$result = $this->testAction('/trades/add', array('data' => $data, 'method' => 'post'));
		$this->assertContains('<div class="error-message">Please select a proper shift (numeric)</div>', $result);
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



	public function testStartUnprocessed() {
		//TODO: Fix broken test
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_TradeRequest'
				),
		));

		$Trades->expects($this->any())
		->method('_TradeRequest')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/startUnprocessed');
		$this->assertContains('Success', $result);
	}

	public function testStartUnprocessedWithFailedTradeRequest() {
		//TODO: Fix Broken test
		
		App::import('Lib', 'TradeRequest');

		$Trades->_TradeRequest = new TradeRequest();
		
		$Trades->_TradeRequest = $this->getMockBuilder('_TradeRequest')
			->setMethods(array('send'))
			->disableOriginalConstructor()
			->getMock();
		
		$Trades->_TradeRequest->expects($this->any())
		->method('send')
 		->will($this->returnValue(array(
  			'return' => false,
  			'token' => 'abcdefghijklmnopqrstuvwxyzabcdef'
  		)));
 			
		$result = $this->testAction('/trades/startUnprocessed');
		debug($result);
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
		$this->setExpectedException('NotFoundException');
	
		$Trades = $this->generate('Trades', array(
								'methods' => array(
										'_requestAllowed'
		),
		));
	
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$result = $this->testAction('/trades/accept?id=12352&token=abcdefghijklmnopqrstuvwxyzabcdef');
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
		$this->setExpectedException('NotFoundException');
		
		$Trades = $this->generate('Trades', array(
									'methods' => array(
											'_requestAllowed'
		),
		));
	
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
	
		$result = $this->testAction('/trades/accept?id=8&token=a50e7ad2e87fe32ef46d9bb84db20012');
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
		$this->setExpectedException('NotFoundException');
	
		$Trades = $this->generate('Trades', array(
									'methods' => array(
											'_requestAllowed'
		),
		));
	
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
	
		$result = $this->testAction('/trades/reject?id=12352&token=abcdefghijklmnopqrstuvwxyzabcdef');
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
		$this->setExpectedException('NotFoundException');
	
		$Trades = $this->generate('Trades', array(
										'methods' => array(
												'_requestAllowed'
		),
		));
	
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));
	
		$result = $this->testAction('/trades/reject?id=8&token=a50e7ad2e87fe32ef46d9bb84db20012');
	}
	
	public function testRejectDuplicateTrade() {
		$Trades = $this->generate('Trades', array(
				'methods' => array(
						'_requestAllowed'
				),
		));
		
		$Trades->expects($this->any())
		->method('_requestAllowed')
		->will($this->returnValue(true));

		$data = array(
				'Trade' => array(
						'user_id' => 1,
						'shift_id' => 16,
				),
				'TradesDetail' => array(
						0 => array(
								'user_id' => 2
								),
						1 => array(
								'user_id' => 3)
						)
				);

		$result = $this->testAction('/trades/add', array('data' => $data, 'method' => 'post'));
		$this->assertContains('This shift is already in the process', $result);
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
