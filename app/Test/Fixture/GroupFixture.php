<?php
/* Group Fixture generated on: 2011-12-19 19:05:07 : 1324339507 */

/**
 * GroupFixture
 *
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'usergroups_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'acl' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'tradeable' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'length' => 4, 'comment' => ''),
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
			'id' => '3',
			'usergroups_id' => '11',
			'acl' => '*:view,*:index,pages:display,*:*View,Users:listUsers'
		),
		array(
			'id' => '2',
			'usergroups_id' => '12',
			'acl' => ''
		),
		array(
			'id' => '5',
			'usergroups_id' => '16',
			'acl' => ''
		),
		array(
			'id' => '6',
			'usergroups_id' => '14',
			'acl' => ''
		),
		array(
			'id' => '7',
			'usergroups_id' => '13',
			'acl' => ''
		),
		array(
			'id' => '8',
			'usergroups_id' => '25',
			'acl' => '*:*'
		),
		array(
			'id' => '9',
			'usergroups_id' => '26',
			'acl' => ''
		),
		array(
			'id' => '1',
			'usergroups_id' => '0',
			'acl' => 'Users:login,Shifts:pdfCreate,Shifts:icsView'
		),
	);
}
