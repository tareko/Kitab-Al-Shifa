<?php
App::uses('Trade', 'Model');

/**
 * Trade Test Case
 *
 */
class TradeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.trade', 'app.user', 'app.shift', 'app.trades_detail', 'app.shifts_type', 'app.location');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Trade = ClassRegistry::init('Trade');
	}


	public function testGetUnprocessedTrades() {
		$result = $this->Trade->getUnprocessedTrades();
		$expected = array(
			'Trade' => array(
				'id' => '2',
				'user_id' => '1',
				'shift_id' => '167',
				'status' => '0',
				'user_status' => '0',
				'submitted_by' => '2',
				'confirmed' => '0',
				'token' => '',
				'updated' => '2012-05-23 11:59:32',
				'message' => null,
				'consideration' => '1'
			),
			'User' => array(
				'id' => '1',
				'name' => 'James Bynum',
				'email' => 'false1@false.com'
			),
			'SubmittedUser' => array(
				'id' => '2',
				'name' => 'Harold Morrissey',
				'email' => 'false2@false.com'
			),
			'Shift' => array(
				'id' => '167',
				'date' => '2011-12-09',
				'shifts_type_id' => '8',
				'ShiftsType' => array(
					'location_id' => '2',
					'times' => '1000-1800 ',
					'Location' => array(
						'location' => 'Bahamas',
						'abbreviated_name' => 'Bah'
					)
				)
			),
			'TradesDetail' => array(
				0 => array(
					'id' => '3',
					'trade_id' => '2',
					'user_id' => '3',
					'token' => '71cad469c97b8fbab04332e9aabee3a8',
					'status' => '2',
					'timestamp' => '2012-05-23 11:29:36',
					'User' => array(
						'id' => '3',
						'name' => 'Madeline Cremin',
						'email' => 'false3@false.com'
					)
				),
				1 => array(
						'id' => '4',
						'trade_id' => '2',
						'user_id' => '4',
						'token' => '71cad469c97b8fbab04332e9aabee3a8',
						'status' => '3',
						'timestamp' => '2012-05-23 11:29:36',
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						)
				),
				2 => array(
						'id' => '5',
						'trade_id' => '2',
						'user_id' => '5',
						'token' => '71cad469c97b8fbab04332e9aabee3a8',
						'status' => '4',
						'timestamp' => '2012-05-24 01:03:30',
						'User' => array(
								'id' => '5',
								'name' => 'Sabine Chatigny',
								'email' => 'false5@false.com'
						)
				)
			)
		);
		$this->assertEquals($expected, $result[9]);
	}

	public function testcheckConfirmAndMultipleNoConfirm() {

		$this->Trade->data = array(
				'Trade' => array(
						'confirmed' => 0
				),
				'TradesDetail' => array(
						0 => array(0 => 0),
						1 => array(1 => 1)
				));
		$result = $this->Trade->checkConfirmAndMultiple();
		$this->assertEqual($result, true);
	}

	public function testcheckConfirmAndMultipleConfirmFail() {

		$this->Trade->data = array(
				'Trade' => array(
						'confirmed' => 1
				),
				'TradesDetail' => array(
						0 => array(0 => 0),
						1 => array(1 => 1)
				));
		$result = $this->Trade->checkConfirmAndMultiple();
		$this->assertEqual($result, false);
	}

	public function testcheckConfirmAndMultipleConfirmSingle() {

		$this->Trade->data = array(
				'Trade' => array(
						'confirmed' => 1
				),
				'TradesDetail' => array(
						0 => array(0 => 0),
				));
		$result = $this->Trade->checkConfirmAndMultiple();
		$this->assertEqual($result, true);
	}

	// Test checkDuplicates with no duplicate
	public function testcheckDuplicates() {

		$this->Trade->data = array(
				'Trade' => array(
						'user_id' => 194,
						'shift_id' => 1
				));
		$result = $this->Trade->checkDuplicate($this->Trade->data);
		$this->assertEqual($result, true);
	}

	// Test checkDuplicates with duplicate
	public function testcheckDuplicatesFalse() {

		$this->Trade->data = array(
				'Trade' => array(
						'user_id' => 4,
						'shift_id' => 483
				));
		$result = $this->Trade->checkDuplicate($this->Trade->data);
		$this->assertEqual($result, false);
	}

	// Test checkShiftExists with existing shift
	public function testcheckShiftExists() {
		$this->Trade->data = array(
				'Trade' => array(
						'shift_id' => 483
				));
		$result = $this->Trade->checkShiftExists();
		$this->assertEqual($result, true);
	}

	// Test checkShiftExists with non-existing shift
	public function testcheckShiftExistsFalse() {
		$this->Trade->data = array(
				'Trade' => array(
						'shift_id' => 4833333
				));
		$result = $this->Trade->checkShiftExists();
		$this->assertEqual($result, false);
	}



	// processTrades => user_status < 1
		//  ['Trade']['Confirmed'] == 1
			// $this->_TradeRequest->send == true
				// $this->updateAll() == true
	public function testprocessTrades1() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '1',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
										)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
								)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => true)));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, true);
	}


	// Simulate bad DB write
	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 1
	// $this->_TradeRequest->send == true
	// $this->updateAll() == false
	public function testprocessTrades2() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '1',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => true)));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// Simulate bad email send
	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 1
	// $this->_TradeRequest->send == true
	// $this->updateAll() == false
	public function testprocessTrades3() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '1',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => false)));
		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 0
		// $trade['Trade']['submitted_by'] == $trade['Trade']['user_id']
	// $this->_TradeRequest->send == true
	// $this->updateAll() == false
	public function testprocessTrades4() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '4',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => true)));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, true);
	}

	// Simulate bad DB write
	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 0
		// $trade['Trade']['submitted_by'] == $trade['Trade']['user_id']
	// $this->_TradeRequest->send == true
	// $this->updateAll() == false
	public function testprocessTrades5() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '4',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array('return' => true)));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 0
		// $trade['Trade']['submitted_by'] != $trade['Trade']['user_id']
	// $this->_TradeRequest->send == true
	// $this->updateAll() == true
	public function testprocessTrades6() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => true,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, true);
	}

	// Simulate bad DB write
	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 0
		// $trade['Trade']['submitted_by'] != $trade['Trade']['user_id']
	// $this->_TradeRequest->send == true
	// $this->updateAll() == true
	public function testprocessTrades7() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => true,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// Simulate bad email send
	// processTrades => user_status < 1
	//  ['Trade']['Confirmed'] == 0
	// $trade['Trade']['submitted_by'] != $trade['Trade']['user_id']
	// $this->_TradeRequest->send == true
	// $this->updateAll() == true
	public function testprocessTrades8() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '0',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))
				),
		);

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => false,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// processTrades => user_status == 2
		// $tradesDetail['status'] == 0
			// $sendDetails['return'] == $this->_TradeRequest->send == true
		// !$failure

	public function testprocessTrades9() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '2',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
										)
								)
						),
						'TradesDetail' => array( 0 => array(
								'id' => 1,
								'status' => '0',
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))));

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));

		$this->Trade->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'updateAll'));

		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => true,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$this->Trade->TradesDetail->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, true);
	}

	// Bad DB write
	// processTrades => user_status == 2
	// $tradesDetail['status'] == 0
	// $sendDetails['return'] == $this->_TradeRequest->send == true
	// !$failure

	public function testprocessTrades10() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '2',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'id' => 1,
								'status' => '0',
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))));

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));

				$this->Trade->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'updateAll'));

		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => true,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		$this->Trade->TradesDetail->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// Bad email send
	// processTrades => user_status == 2
	// $tradesDetail['status'] == 0
	// $sendDetails['return'] == $this->_TradeRequest->send == true
	// !$failure

	public function testprocessTrades11() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '2',
								'submitted_by' => '2',
								'confirmed' => '0',
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'id' => 1,
								'status' => '0',
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))));

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));
		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock email function
		$this->Trade->_TradeRequest = $this->getMock('_TradeRequest', array('send'));
		$this->Trade->_TradeRequest->expects($this->any())
		->method('send')
		->will($this->returnValue(array(
				'return' => false,
				'token' => 'a50e7ad2e87fe32ef46d9bb84db20012')));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, false);
	}

	// Does TradeRequest load when not mocked?
	public function testprocessTrades12() {
		// Set array mock for processTrades
		$processTradesMock = array(
				0 => array(
						'Trade' => array(
								'id' => '12',
								'user_id' => '4',
								'shift_id' => '483',
								'status' => '0',
								'user_status' => '2',
								'submitted_by' => '2',
								'message' => '0',
								'confirmed' => '0',
								'consideration' => 1,
								'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
								'updated' => '2012-05-23 11:59:42'
						),
						'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
						),
						'SubmittedUser' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
						),
						'Shift' => array(
								'id' => '483',
								'date' => '2011-12-26',
								'shifts_type_id' => '11',
								'ShiftsType' => array(
										'location_id' => '3',
										'times' => '1000-1700 ',
										'Location' => array(
												'location' => 'Come on pretty mama',
												'abbreviated_name' => 'COPM'
		)
								)
						),
						'TradesDetail' => array( 0 => array(
								'id' => 1,
								'status' => '0',
								'User' => array(
										'id' => '2',
										'name' => 'Harold Morrissey',
										'email' => 'false2@false.com'
		)))));

		$this->Trade = $this->getMockForModel('Trade', array(
				'getUnprocessedTrades',
				'updateAll'));

		$this->Trade->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'updateAll'));

		$this->Trade->expects($this->any())
		->method('getUnprocessedTrades')
		->will($this->returnValue($processTradesMock));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$this->Trade->TradesDetail->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		$result = $this->Trade->processTrades();
		$this->assertEqual($result, true);
	}

	// Test change Status function

	public function testchangeStatus() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
					'id' => '20',
					'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '9';
		$this->Trade->request->query['token'] = 'ad096b2b5654477ab9f4708f1ca6e2c7';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, true);
	}

	// Test change Status function
	// Trade not found

	public function testchangeStatus2() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '999';
		$this->Trade->request->query['token'] = 'ad096b2b5654477ab9f4708f1ca6e2c7';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'Trade not found');
	}

	// Test change Status function
	// ['Trade']['status'] == 1

	public function testchangeStatus3() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '10';
		$this->Trade->request->query['token'] = '15b6a69f207d8f6cd29c66b4cb729d39';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'You have already accepted this trade');
	}

	// Test change Status function
	// ['Trade']['status'] == 2

	public function testchangeStatus4() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '13';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'This trade is already complete');
	}

	// Test change Status function
	// ['Trade']['status'] == 3

	public function testchangeStatus5() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '14';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'This trade has already been cancelled');
	}

	// Test change Status function
	// ['Trade']['status'] == 4
	public function testchangeStatus6() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '15';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'An error occurred with this trade[1]');
	}

	// Test change Status function
	// ['Trade']['status'] == 0
	// ['Trade']['user_status'] != 1 = 0
	public function testchangeStatus7() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '1';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'An error occurred with this trade[2]');
	}

	// Test change Status function
	// ['Trade']['status'] == 0
	// ['Trade']['user_status'] != 1 = 2
	public function testchangeStatus8() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '7';
		$this->Trade->request->query['token'] = '696a521644768fe95e28505b5c8e602b';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'You have already accepted this trade');
	}

	// Test change Status function
	// ['Trade']['status'] == 0
	// ['Trade']['user_status'] != 1 = 3
	public function testchangeStatus9() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '6';
		$this->Trade->request->query['token'] = 'e8aa4be97281849d511568b450ee2b7f';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'You have already rejected this trade');
	}

	// Test change Status function
	// ['Trade']['status'] == 0
	// ['Trade']['user_status'] == 1
	// Token incorrect
	public function testchangeStatus10() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(true));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '12';
		$this->Trade->request->query['token'] = 'ad096b2b5654477ab9f4708f1ca6e2c7';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'Sorry, but your token is wrong. You are not authorized to act on this trade.');
	}

	// Test change Status function
	// ['Trade']['status'] == 0
	// ['Trade']['user_status'] == 1
	// Token corrent
	// Bad DB write
	public function testchangeStatus11() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '12';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 2);
		$this->assertEqual($result, 'An error has occured during your request[3]');
	}

	// No status given
	public function testchangeStatus12() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '12';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request);
		$this->assertEqual($result, 'Improper status was given to this function');
	}


	// Non-numeric status given
	public function testchangeStatus13() {

		$this->Trade = $this->getMockForModel('Trade', array(
				'updateAll'));

		// Mock updateAll function
		$this->Trade->expects($this->any())
		->method('updateAll')
		->will($this->returnValue(false));

		// Mock data request function
		$this->Trade->request = $this->getMock('CakeRequest', array('query'));
		$this->Trade->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->Trade->request->query['id'] = '12';
		$this->Trade->request->query['token'] = 'a50e7ad2e87fe32ef46d9bb84db20012';
		$result = $this->Trade->changeStatus($this->Trade->request, 'bad');
		$this->assertEqual($result, 'Improper status was given to this function');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Trade);

		parent::tearDown();
	}

}
