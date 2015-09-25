<?php
App::uses('TradesDetail', 'Model');

/**
 * TradesDetail Test Case
 */
class TradesDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.trades_detail',
		'app.trade',
		'app.user',
		'app.profile',
		'app.shift',
		'app.shifts_type',
		'app.location',
		'app.billing',
		'app.billings_item',
		'app.usergroup',
		'app.group',
		'app.user_usergroup_map'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TradesDetail = ClassRegistry::init('TradesDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TradesDetail);

		parent::tearDown();
	}

/**
 * testChangeStatus method
 *
 * @return void
 */

	// Incorrect trade id
	public function testChangeStatus() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '999';
		$this->TradesDetail->request->query['token'] = 'ad096b2b5654477ab9f4708f1ca6e2c7';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request);
		$this->assertEqual($result, 'Trade not found');
	}

	// Status not entered
	public function testChangeStatus2() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '9';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request);
		$this->assertEqual($result, 'Improper status was given to this function');
	}

	// Status not numeric
	public function testChangeStatus3() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '9';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 'bad');
		$this->assertEqual($result, 'Improper status was given to this function');
	}

	// Incorrect token
	public function testChangeStatus4() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '9';
		$this->TradesDetail->request->query['token'] = '5c5cf690c597e59d24415d20a89af30f';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'Sorry, but your token is wrong. You are not authorized to act on this trade.');
	}

	// Status == 0
	public function testChangeStatus5() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '2';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'This trade has not been processed yet[1]');
	}

	// Status == 2
	public function testChangeStatus6() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '20';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'You have already accepted this trade');
	}

	// Status == 3
	public function testChangeStatus7() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '4';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'You have already rejected this trade');
	}

	// Status == 4
	public function testChangeStatus8() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '5';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'An error occurred with this trade[1]');
	}

	// Status == 1
	// Already taken
	public function testChangeStatus9() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save',
				//'alreadyTaken'
				));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

/* 		$this->TradesDetail->expects($this->any())
		->method('alreadyTaken')
		->will($this->returnValue(array('return' => true)));
 */
		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '6';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'This shift has already been taken by Harold Morrissey');
	}

	// Status == 1
	// Already taken == false
	// Save == true
	public function testChangeStatus10() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save',
				'alreadyTaken'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(true));

		$this->TradesDetail->expects($this->any())
		->method('alreadyTaken')
		->will($this->returnValue(array('return' => false)));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '6';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, true);
	}

	// Status == 1
	// Already taken == false
	// Save == false
	public function testChangeStatus11() {
		$this->TradesDetail = $this->getMockForModel('TradesDetail', array(
				'save',
				'alreadyTaken'));

		// Mock save function
		$this->TradesDetail->expects($this->any())
		->method('save')
		->will($this->returnValue(false));

		$this->TradesDetail->expects($this->any())
		->method('alreadyTaken')
		->will($this->returnValue(array('return' => false)));

		// Mock data request function
		$this->TradesDetail->request = $this->getMock('CakeRequest', array('query'));
		$this->TradesDetail->request->expects($this->any())
		->method('query')
		->will($this->returnValue(array(
				'id' => '20',
				'token' => '1f110efce2852a90db905418edbe8932')));

		$this->TradesDetail->request->query['id'] = '6';
		$this->TradesDetail->request->query['token'] = '71cad469c97b8fbab04332e9aabee3a8';
		$result = $this->TradesDetail->changeStatus($this->TradesDetail->request, 2);
		$this->assertEqual($result, 'An error has occured during your request[1]');
	}

/**
 * testAlreadyTaken method
 *
 * @return void
 */
	public function testAlreadyTaken() {
		$this->markTestIncomplete('testAlreadyTaken not implemented.');
	}

}
