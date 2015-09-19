<?php
/* ShiftsType Fixture generated on: 2011-12-19 19:18:11 : 1324340291 */

/**
 * ShiftsTypeFixture
 *
 */
class ShiftsTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => NULL, 'comment' => ''),
		'shift_start' => array('type' => 'time', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'shift_end' => array('type' => 'time', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'comment' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'display_order' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => NULL, 'comment' => ''),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'expiry_date' => array('type' => 'date', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'location_id' => '1',
			'shift_start' => '08:00:00',
			'shift_end' => '16:00:00',
			'comment' => '',
			'display_order' => '2',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '10',
			'location_id' => '3',
			'shift_start' => '08:00:00',
			'shift_end' => '15:00:00',
			'comment' => '',
			'display_order' => '17',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '3',
			'location_id' => '1',
			'shift_start' => '10:00:00',
			'shift_end' => '16:00:00',
			'comment' => 'U45',
			'display_order' => '3',
			'start_date' => '2011-01-01',
			'expiry_date' => '2011-12-22'
		),
		array(
			'id' => '11',
			'location_id' => '3',
			'shift_start' => '10:00:00',
			'shift_end' => '17:00:00',
			'comment' => '',
			'display_order' => '18',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '5',
			'location_id' => '2',
			'shift_start' => '04:00:00',
			'shift_end' => '10:00:00',
			'comment' => '',
			'display_order' => '5',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '6',
			'location_id' => '2',
			'shift_start' => '08:00:00',
			'shift_end' => '16:00:00',
			'comment' => '',
			'display_order' => '6',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '7',
			'location_id' => '1',
			'shift_start' => '10:00:00',
			'shift_end' => '20:00:00',
			'comment' => 'S/S',
			'display_order' => '3',
			'start_date' => '2011-01-01',
			'expiry_date' => '2011-12-22'
		),
		array(
			'id' => '8',
			'location_id' => '2',
			'shift_start' => '10:00:00',
			'shift_end' => '18:00:00',
			'comment' => '',
			'display_order' => '7',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '9',
			'location_id' => '3',
			'shift_start' => '12:00:00',
			'shift_end' => '20:00:00',
			'comment' => '',
			'display_order' => '19',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
			'id' => '12',
			'location_id' => '1',
			'shift_start' => '04:00:00',
			'shift_end' => '10:00:00',
			'comment' => '',
			'display_order' => '1',
			'start_date' => '2011-01-01',
			'expiry_date' => '2031-12-31'
		),
		array(
				'id' => '13',
				'location_id' => '1',
				'shift_start' => '22:00:00',
				'shift_end' => '04:00:00',
				'comment' => '',
				'display_order' => '1',
				'start_date' => '2011-01-01',
				'expiry_date' => '2031-12-31'
		),
		
	);
}
