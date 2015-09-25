<?php
/**
 * TradeFixture
 *
 */
class TradeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'message' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'user_status' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'consideration' => array('type' => 'integer', 'null' => false, 'default' => 1),
		'submitted_by' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'confirmed' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'token' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'updated' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'user_id' => '1',
			'shift_id' => '16',
			'status' => '0',
			'user_status' => '0',
			'submitted_by' => 1,
			'confirmed' => 1,
			'message' => 'Test message',
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
			'updated' => '2012-05-23 11:59:31'
		),
	array(
			'id' => '2',
			'user_id' => '1',
			'shift_id' => '167',
			'status' => '0',
			'user_status' => '0',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => '',
			'updated' => '2012-05-23 11:59:32'
		),
	array(
			'id' => '3',
			'user_id' => '2',
			'shift_id' => '52',
			'status' => '0',
			'user_status' => '4',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'ba8bbb41dc0356d6849a00c18b2044de',
			'updated' => '2012-05-23 11:59:33'
		),
	array(
			'id' => '4',
			'user_id' => '2',
			'shift_id' => '196',
			'status' => '0',
			'user_status' => '4',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => '1daeeb555a5afa403d36cb6683f113a1',
			'updated' => '2012-05-23 11:59:34'
		),
	array(
			'id' => '5',
			'user_id' => '3',
			'shift_id' => '86',
			'status' => '0',
			'user_status' => '3',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'd5182d222b2a3cac6ce9fbeb9476d71f',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '6',
			'user_id' => '3',
			'shift_id' => '213',
			'status' => '0',
			'user_status' => '3',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'e8aa4be97281849d511568b450ee2b7f',
			'updated' => '2012-05-23 11:59:36'
		),
	array(
			'id' => '7',
			'user_id' => '4',
			'shift_id' => '137',
			'status' => '0',
			'user_status' => '2',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => '696a521644768fe95e28505b5c8e602b',
			'updated' => '2012-05-23 11:59:37'
		),
	array(
			'id' => '8',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '0',
			'user_status' => '2',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20000',
			'updated' => '2012-05-23 11:59:38'
		),
	array(
			'id' => '9',
			'user_id' => '5',
			'shift_id' => '153',
			'status' => '0',
			'user_status' => '1',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'ad096b2b5654477ab9f4708f1ca6e2c7',
			'updated' => '2012-05-23 11:59:39'
		),
	array(
			'id' => '10',
			'user_id' => '5',
			'shift_id' => '513',
			'status' => '1',
			'user_status' => '2',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => '15b6a69f207d8f6cd29c66b4cb729d39',
			'updated' => '2012-05-23 11:59:40'
		),
	array(
			'id' => '11',
			'user_id' => '5',
			'shift_id' => '513',
			'status' => '1',
			'user_status' => '2',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => '15b6a69f207d8f6cd29c66b4cb729d40',
			'updated' => '2012-05-23 11:59:41'
		),
	array(
			'id' => '12',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '0',
			'user_status' => '1',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
			'updated' => '2012-05-23 11:59:42'
		),
	array(
			'id' => '13',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '2',
			'user_status' => '2',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
			'updated' => '2012-05-23 11:59:42'
		),
	array(
			'id' => '14',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '3',
			'user_status' => '0',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
			'updated' => '2012-05-23 11:59:42'
		),
	array(
			'id' => '15',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '4',
			'user_status' => '0',
			'submitted_by' => 2,
			'confirmed' => 0,
			'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
			'updated' => '2012-05-23 11:59:42'
		),
	);
}
