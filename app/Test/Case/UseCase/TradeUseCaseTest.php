<?php
App::uses('Trade', 'Model');

/**
 * Trade Test Case
 *
 */
class TradeUseCaseTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
			'app.trade',
			'app.user',
			'app.shift',
			'app.trades_detail',
			'app.shifts_type',
			'app.location'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Trade = ClassRegistry::init('Trade');
	}


	/*
	 * Confirmed == 1
	 * Two parties
	 *
	 * Run processTrades
	 * Check results
	 * Simulate originator response (if any)
	 * Check results
	 * Run processTrades again
	 * Check results
	 * Simulate recipient response (if any)
	 * Run processTrades again
	 * Check results
	 * Run completeAccepted
	 * Check results
	 *
	 */

	public function testConfirmedTrade() {

		// Check that things are going right after first processTrades
		$this->Trade->processTrades();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 1);
		$this->assertEqual($result['Trade']['user_status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 1);

		// Second processTrades is to make sure that the shift stays the same
		$this->Trade->processTrades();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 1);
		$this->assertEqual($result['Trade']['user_status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 1);

		$this->Trade->completeAccepted();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 2);
		$this->assertEqual($result['Trade']['user_status'], 2);
		$this->assertEqual($result['TradesDetail'][0]['status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 2);
	}


	/*
	 * Confirmed == 0
	 * Two parties
	 * Submitting user == originator
	 *
	 * Run processTrades
	 * Check results
	 * Simulate originator response (if any)
	 * Check results
	 * Run processTrades again
	 * Check results
	 * Simulate recipient response (if any)
	 * Run processTrades again
	 * Check results
	 * Run completeAccepted
	 * Check results
	 *
	 */

	public function testUnconfirmedTrade1() {

		// Check that things are going right after first processTrades
		$this->Trade->processTrades();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 1);
		$this->assertEqual($result['Trade']['user_status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 1);

		// Second processTrades is to make sure that the shift stays the same
		$this->Trade->processTrades();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 1);
		$this->assertEqual($result['Trade']['user_status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 1);

		$this->Trade->completeAccepted();
		$result = $this->Trade->read(null, 1);
		$this->assertEqual($result['Trade']['status'], 2);
		$this->assertEqual($result['Trade']['user_status'], 2);
		$this->assertEqual($result['TradesDetail'][0]['status'], 2);

		$result = $this->Trade->Shift->read(null, 16);
		$this->assertEqual($result['Shift']['user_id'], 2);
	}


	// Confirmed == 0
	// Submitting user == Recipient

	// Confirmed == 0
	// Submitting user != Originator nor recipient



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
