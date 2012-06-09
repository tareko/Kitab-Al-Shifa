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
		'updated' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
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
			'id' => '1',
			'user_id' => '1',
			'shift_id' => '16',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '2',
			'user_id' => '1',
			'shift_id' => '167',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '3',
			'user_id' => '2',
			'shift_id' => '52',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '4',
			'user_id' => '2',
			'shift_id' => '196',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '5',
			'user_id' => '3',
			'shift_id' => '86',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '6',
			'user_id' => '3',
			'shift_id' => '213',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '7',
			'user_id' => '4',
			'shift_id' => '137',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '8',
			'user_id' => '4',
			'shift_id' => '483',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '9',
			'user_id' => '5',
			'shift_id' => '153',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	array(
			'id' => '10',
			'user_id' => '5',
			'shift_id' => '513',
			'status' => '0',
			'updated' => '2012-05-23 11:59:35'
		),
	);
}
