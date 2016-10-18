<?php
/* Calendar Fixture generated on: 2011-12-20 00:54:26 : 1324360466 */

/**
 * CalendarFixture
 *
 */
class CalendarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'usergroups_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'comments' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'id' => '1',
			'usergroups_id' => '11',
			'name' => 'December 2011',
			'start_date' => '2011-12-01',
			'end_date' => '2011-12-22',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:46:26'
		),
		array(
			'id' => '2',
			'usergroups_id' => '11',
			'name' => 'Holiday 2011',
			'start_date' => '2011-12-23',
			'end_date' => '2012-01-06',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:46:37'
		),
		array(
			'id' => '3',
			'usergroups_id' => '11',
			'name' => 'November 2011',
			'start_date' => '2011-11-01',
			'end_date' => '2011-11-30',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:46:46'
		),
		array(
			'id' => '5',
			'usergroups_id' => '11',
			'name' => 'January 2012',
			'start_date' => '2012-01-06',
			'end_date' => '2012-01-31',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:46:58'
		),
		array(
			'id' => '6',
			'usergroups_id' => '11',
			'name' => 'February 2012',
			'start_date' => '2012-02-01',
			'end_date' => '2012-02-29',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:47:08'
		),
		array(
			'id' => '7',
			'usergroups_id' => '11',
			'name' => 'March 2012',
			'start_date' => '2012-03-01',
			'end_date' => '2012-03-31',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:47:18'
		),
		array(
			'id' => '8',
			'usergroups_id' => '11',
			'name' => 'April 2012',
			'start_date' => '2012-04-01',
			'end_date' => '2012-04-30',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:47:49'
		),
		array(
			'id' => '9',
			'usergroups_id' => '11',
			'name' => 'May 2012',
			'start_date' => '2012-05-01',
			'end_date' => '2012-05-31',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:47:42'
		),
		array(
			'id' => '10',
			'usergroups_id' => '11',
			'name' => 'June 2012',
			'start_date' => '2012-06-01',
			'end_date' => '2012-06-30',
			'published' => 1,
			'comments' => '',
			'updated' => '2011-12-15 00:47:35'
		),
 		array(
 			'id' => '11',
 			'usergroups_id' => '11',
 			'name' => 'June 2012',
 			'start_date' => '2012-07-01',
 			'end_date' => '2012-07-31',
 			'published' => 0,
 			'comments' => 'unpublished',
 			'updated' => '2011-12-15 00:47:35'
 		),
 	);
}
