<?php
App::uses('AccountingsExceptionsController', 'Controller');

/**
 * AccountingsExceptionsController Test Case
 *
 */
class AccountingsExceptionsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.accountings_exception',
		'app.user',
		'app.profile',
		'app.shift',
		'app.shifts_type',
		'app.location',
		'app.trade',
		'app.trades_detail',
		'app.usergroup',
		'app.group',
		'app.user_usergroup_map'
	);

	/**
	 * testIndex method
	 *
	 * @return void
	 */
	public function testIndex() {
	}

}
