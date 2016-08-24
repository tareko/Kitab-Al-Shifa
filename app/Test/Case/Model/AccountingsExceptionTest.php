<?php
App::uses('AccountingsException', 'Model');

/**
 * AccountingsException Test Case
 *
 */
class AccountingsExceptionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.accountings_exception'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AccountingsException = ClassRegistry::init('AccountingsException');
	}

	// Null test
	public function testNull() {
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AccountingsException);

		parent::tearDown();
	}

}
