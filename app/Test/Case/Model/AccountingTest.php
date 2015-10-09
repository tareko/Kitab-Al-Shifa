<?php
App::uses('Accounting', 'Model');

/**
 * Accounting Test Case
 */
class AccountingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.accounting',
		'app.calendar',
		'app.group',
		'app.usergroup',
		'app.user',
		'app.shiftsType',
		'app.trade',
		'app.shift'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Accounting = ClassRegistry::init('Accounting');
	}


	/** Calculate X value
	 *
	 */

	public function testCalculateXValue() {
		$this->Shift = ClassRegistry::init('Shift');
		$result = $this->Accounting->calculateXValueForShift(524);
		debug($result);
	}
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Accounting);

		parent::tearDown();
	}

}
