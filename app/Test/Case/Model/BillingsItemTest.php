<?php
App::uses('BillingsItem', 'Model');

/**
 * BillingsItem Test Case
 *
 */
class BillingsItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.billings_item',
		'app.billings'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BillingsItem = ClassRegistry::init('BillingsItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BillingsItem);

		parent::tearDown();
	}

}
