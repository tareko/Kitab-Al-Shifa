<?php
App::uses('Shift', 'Model');

/**
 * Shift Test Case
 *
 */
class ShiftTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.shift', 'app.user', 'app.profile', 'app.usergroup', 'app.group', 'app.user_usergroup_map', 'app.shifts_type', 'app.location', 'app.trade', 'app.trades_detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Shift = ClassRegistry::init('Shift');
	}


	/**
	 * Check if two entries with the same date and shift_types_id can be added
	 */

	public function testPreventDuplicateShifts() {

		// Set the data to a duplicate set as per the fixture
		$data = array(
			'user_id' => '1',
			'date' => '2011-12-01',
			'shifts_type_id' => '1',
		);

		$this->Shift->set($data);

		//Ensure the data does not validate
		$this->assertFalse($this->Shift->validates());
	}
	
	// Test import function
	public function testImport() {
		$result = $this->Shift->import(APP . 'Test' . DS . 'Files' . DS . 'shift-import.csv', 1);
		debug ($result);
		die;
	}
	
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shift);

		parent::tearDown();
	}

/**
 * testGetShiftList method
 *
 * @return void
 */
	public function testGetShiftList() {

	}
}
