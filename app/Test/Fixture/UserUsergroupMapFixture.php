<?php
/* UserUsergroupMap Fixture generated on: 2011-12-19 13:40:56 : 1324320056 */

/**
 * UserUsergroupMapFixture
 *
 */
class UserUsergroupMapFixture extends CakeTestFixture {
/**
 * Table name
 *
 * @var string
 */
	public $table = 'user_usergroup_map';
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
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => 'Foreign Key to #__users.id'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index', 'collate' => NULL, 'comment' => 'Foreign Key to #__usergroups.id'),
		'indexes' => array('PRIMARY' => array('column' => array('user_id', 'group_id'), 'unique' => 1)),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => '1',
			'group_id' => '2'
		),
		array(
			'user_id' => '1',
			'group_id' => '8'
		),
		array(
			'user_id' => '1',
			'group_id' => '11'
		),
		array(
			'user_id' => '1',
			'group_id' => '18'
		),
		array(
			'user_id' => '1',
			'group_id' => '20'
		),
		array(
			'user_id' => '1',
			'group_id' => '22'
		),
		array(
			'user_id' => '2',
			'group_id' => '8'
		),
		array(
			'user_id' => '2',
			'group_id' => '11'
		),
		array(
			'user_id' => '2',
			'group_id' => '18'
		),
		array(
			'user_id' => '2',
			'group_id' => '19'
		),
		array(
			'user_id' => '2',
			'group_id' => '20'
		),
		array(
			'user_id' => '2',
			'group_id' => '26'
		),
		array(
			'user_id' => '7',
			'group_id' => '4'
		),
		array(
			'user_id' => '7',
			'group_id' => '11'
		),
		array(
			'user_id' => '7',
			'group_id' => '18'
		),
		array(
			'user_id' => '7',
			'group_id' => '19'
		),
		array(
			'user_id' => '8',
			'group_id' => '2'
		),
		array(
			'user_id' => '8',
			'group_id' => '11'
		),
		array(
			'user_id' => '8',
			'group_id' => '18'
		),
		array(
			'user_id' => '9',
			'group_id' => '2'
		),
	);
}
