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
			'trade_id' => '27',
			'user_id' => '79',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '3',
			'trade_id' => '27',
			'user_id' => '1',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '4',
			'trade_id' => '27',
			'user_id' => '7',
			'status' => '0',
			'timestamp' => '2012-05-23 11:29:36'
		),
		array(
			'id' => '5',
			'trade_id' => '28',
			'user_id' => '242',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '6',
			'trade_id' => '28',
			'user_id' => '269',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
		array(
			'id' => '7',
			'trade_id' => '28',
			'user_id' => '1',
			'status' => '0',
			'timestamp' => '2012-05-24 01:03:30'
		),
	);
}
