<?php
/* Usergroup Fixture generated on: 2011-12-19 13:25:38 : 1324319138 */

/**
 * UsergroupFixture
 *
 */
class UsergroupFixture extends CakeTestFixture {
/**
 * Import
 *
 * @var array
 */
//	public $import = array('connection' => 'joomla');

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => 'Primary Key'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index', 'collate' => NULL, 'comment' => 'Adjacency List Reference Id'),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index', 'collate' => NULL, 'comment' => 'Nested set lft.'),
		'rgt' => array('type' => 'integer', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => 'Nested set rgt.'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_usergroup_parent_title_lookup' => array('column' => array('parent_id', 'title'), 'unique' => 1), 'idx_usergroup_title_lookup' => array('column' => 'title', 'unique' => 0), 'idx_usergroup_adjacency_lookup' => array('column' => 'parent_id', 'unique' => 0), 'idx_usergroup_nested_set_lookup' => array('column' => array('lft', 'rgt'), 'unique' => 0)),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'parent_id' => '0',
			'lft' => '1',
			'rgt' => '52',
			'title' => 'Public'
		),
		array(
			'id' => '2',
			'parent_id' => '1',
			'lft' => '18',
			'rgt' => '49',
			'title' => 'Registered'
		),
		array(
			'id' => '3',
			'parent_id' => '2',
			'lft' => '19',
			'rgt' => '24',
			'title' => 'Author'
		),
		array(
			'id' => '4',
			'parent_id' => '3',
			'lft' => '20',
			'rgt' => '23',
			'title' => 'Editor'
		),
		array(
			'id' => '5',
			'parent_id' => '4',
			'lft' => '21',
			'rgt' => '22',
			'title' => 'Publisher'
		),
		array(
			'id' => '6',
			'parent_id' => '1',
			'lft' => '14',
			'rgt' => '17',
			'title' => 'Manager'
		),
		array(
			'id' => '7',
			'parent_id' => '6',
			'lft' => '15',
			'rgt' => '16',
			'title' => 'Administrator'
		),
		array(
			'id' => '8',
			'parent_id' => '1',
			'lft' => '50',
			'rgt' => '51',
			'title' => 'Super Users'
		),
		array(
			'id' => '9',
			'parent_id' => '1',
			'lft' => '2',
			'rgt' => '3',
			'title' => 'Administrative Contacts'
		),
		array(
			'id' => '10',
			'parent_id' => '2',
			'lft' => '25',
			'rgt' => '46',
			'title' => 'Forum Users'
		),
		array(
			'id' => '11',
			'parent_id' => '20',
			'lft' => '29',
			'rgt' => '34',
			'title' => 'Adult Emergency Physicians'
		),
		array(
			'id' => '12',
			'parent_id' => '20',
			'lft' => '35',
			'rgt' => '36',
			'title' => 'Pediatric Emergency Physicians'
		),
		array(
			'id' => '13',
			'parent_id' => '21',
			'lft' => '43',
			'rgt' => '44',
			'title' => 'Royal College Emergency Residents'
		),
		array(
			'id' => '14',
			'parent_id' => '21',
			'lft' => '39',
			'rgt' => '40',
			'title' => 'CCFP-EM Residents'
		),
		array(
			'id' => '15',
			'parent_id' => '21',
			'lft' => '41',
			'rgt' => '42',
			'title' => 'Pediatric Emergency Fellows'
		),
		array(
			'id' => '16',
			'parent_id' => '10',
			'lft' => '26',
			'rgt' => '27',
			'title' => 'Administrative Staff'
		),
		array(
			'id' => '17',
			'parent_id' => '1',
			'lft' => '6',
			'rgt' => '7',
			'title' => 'Former Staff'
		),
		array(
			'id' => '20',
			'parent_id' => '10',
			'lft' => '28',
			'rgt' => '37',
			'title' => 'Consultants'
		),
	);
}
