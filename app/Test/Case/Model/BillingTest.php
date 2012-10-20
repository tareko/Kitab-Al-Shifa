<?php
App::uses('Billing', 'Model');

/**
 * Billing Test Case
 *
 */
class BillingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.billing',
		'app.billings_items'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Billing = ClassRegistry::init('Billing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Billing);

		parent::tearDown();
	}

}
