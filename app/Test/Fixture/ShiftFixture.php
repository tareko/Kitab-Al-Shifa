<?php
/* Shift Fixture generated on: 2011-12-19 19:16:21 : 1324340181 */

/**
 * ShiftFixture
 *
 */
class ShiftFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => NULL, 'comment' => ''),
		'date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'shifts_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => NULL, 'comment' => ''),
		'updated' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'collate' => NULL, 'comment' => ''),
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
			'id' => '16',
			'user_id' => '1',
			'date' => '2011-12-01',
			'shifts_type_id' => '1',
			'updated' => '2011-10-16 12:13:02'
		),
		array(
			'id' => '52',
			'user_id' => '2',
			'date' => '2011-12-02',
			'shifts_type_id' => '3',
			'updated' => '2011-10-19 08:23:49'
		),
		array(
			'id' => '86',
			'user_id' => '3',
			'date' => '2011-12-04',
			'shifts_type_id' => '5',
			'updated' => '2011-10-19 10:10:18'
		),
		array(
			'id' => '137',
			'user_id' => '4',
			'date' => '2011-12-07',
			'shifts_type_id' => '6',
			'updated' => '2011-10-19 10:24:30'
		),
		array(
			'id' => '153',
			'user_id' => '5',
			'date' => '2011-12-08',
			'shifts_type_id' => '7',
			'updated' => '2011-10-19 10:24:30'
		),
		array(
			'id' => '167',
			'user_id' => '1',
			'date' => '2011-12-09',
			'shifts_type_id' => '8',
			'updated' => '2011-10-19 10:24:30'
		),
		array(
			'id' => '196',
			'user_id' => '2',
			'date' => '2011-12-10',
			'shifts_type_id' => '9',
			'updated' => '2011-10-19 10:35:51'
		),
		array(
			'id' => '213',
			'user_id' => '3',
			'date' => '2011-12-11',
			'shifts_type_id' => '10',
			'updated' => '2011-10-19 10:35:51'
		),
		array(
			'id' => '483',
			'user_id' => '4',
			'date' => '2011-12-26',
			'shifts_type_id' => '11',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '513',
			'user_id' => '5',
			'date' => '2011-12-28',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '514',
			'user_id' => '1',
			'date' => '2013-12-28',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '515',
			'user_id' => '2',
			'date' => '2013-12-29',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '516',
			'user_id' => '3',
			'date' => '2013-12-30',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '517',
			'user_id' => '4',
			'date' => '2013-11-20',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '518',
			'user_id' => '5',
			'date' => '2013-11-21',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
		array(
			'id' => '519',
			'user_id' => '1',
			'date' => '2013-11-22',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
			array(
			'id' => '520',
			'user_id' => '2',
			'date' => '2013-11-23',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
			array(
			'id' => '521',
			'user_id' => '3',
			'date' => '2013-11-24',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
			array(
			'id' => '522',
			'user_id' => '4',
			'date' => '2013-11-25',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
			array(
			'id' => '523',
			'user_id' => '5',
			'date' => '2013-11-26',
			'shifts_type_id' => '12',
			'updated' => '2011-10-19 16:55:23'
		),
	);
}
