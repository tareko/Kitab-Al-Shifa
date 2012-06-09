<?php
/**
 * TradesDetailFixture
 *
 */
class TradesDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'trade_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'timestamp' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '2',
			'trade_id' => '1',
			'user_id' => '2',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '3',
			'trade_id' => '1',
			'user_id' => '3',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '4',
			'trade_id' => '2',
			'user_id' => '4',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '5',
			'trade_id' => '2',
			'user_id' => '5',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '6',
			'trade_id' => '3',
			'user_id' => '1',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '7',
			'trade_id' => '3',
			'user_id' => '2',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '8',
			'trade_id' => '4',
			'user_id' => '3',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '9',
			'trade_id' => '4',
			'user_id' => '4',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '10',
			'trade_id' => '5',
			'user_id' => '5',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '11',
			'trade_id' => '5',
			'user_id' => '4',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '12',
			'trade_id' => '6',
			'user_id' => '1',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '13',
			'trade_id' => '6',
			'user_id' => '2',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '14',
			'trade_id' => '7',
			'user_id' => '3',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '15',
			'trade_id' => '7',
			'user_id' => '4',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '16',
			'trade_id' => '8',
			'user_id' => '5',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '17',
			'trade_id' => '8',
			'user_id' => '1',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '18',
			'trade_id' => '9',
			'user_id' => '2',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '19',
			'trade_id' => '9',
			'user_id' => '3',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '20',
			'trade_id' => '10',
			'user_id' => '4',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '21',
			'trade_id' => '10',
			'user_id' => '3',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
	);
}
