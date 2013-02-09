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
//		'app.billings_item'
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

	public function testBeforeValidate() {

		$this->Billing->data['Billing']['patient_birthdate'] = '20000101';

		$result = $this->Billing->beforeValidate();
		$this->assertEquals(true, $result);
		$this->assertEquals('2000-01-01', $this->Billing->data['Billing']['patient_birthdate']);
	}

	public function testBeforeValidateEmpty() {

		unset($this->Billing->data['Billing']['patient_birthdate']);

		$result = $this->Billing->beforeValidate();
		$this->assertEquals(true, $result);
		$this->assertEquals(false, isset($this->Billing->data['Billing']['patient_birthdate']));
	}

	public function testImportNoFile() {
		$this->setExpectedException('NotFoundException');
		$result = $this->Billing->import('badfile');
	}

	public function testImport() {
		$result = $this->Billing->import(APP . 'Test' . DS . 'Files' . DS . 'billing-import.txt');
		debug ($result);
	}

	public function testImportWithOhip() {
		Configure::write('save_ohip', true);
		$result = $this->Billing->import(APP . 'Test' . DS . 'Files' . DS . 'billing-import.txt');
		debug ($result);
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
