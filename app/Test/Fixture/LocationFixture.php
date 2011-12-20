<?php
/* Location Fixture generated on: 2011-12-19 13:22:09 : 1324318929 */

/**
 * LocationFixture
 *
 */
class LocationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 32, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'location' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'abbreviated_name' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'location' => 'Bermuda',
			'abbreviated_name' => 'Ber'
		),
		array(
			'id' => '2',
			'location' => 'Bahamas',
			'abbreviated_name' => 'Bah'
		),
		array(
			'id' => '3',
			'location' => 'Come on pretty mama',
			'abbreviated_name' => 'COPM'
		),
	);
}
