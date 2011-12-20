<?php
/* User Fixture generated on: 2011-12-19 13:23:55 : 1324319035 */

/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {
/**
 * Import
 *
 * @var array
 */
	public $import = array('connection' => 'joomla');

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'username' => array('type' => 'string', 'null' => false, 'length' => 150, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'usertype' => array('type' => 'string', 'null' => false, 'length' => 25, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'block' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'sendEmail' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'registerDate' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00', 'collate' => NULL, 'comment' => ''),
		'lastvisitDate' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00', 'collate' => NULL, 'comment' => ''),
		'activation' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'params' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'usertype' => array('column' => 'usertype', 'unique' => 0), 'idx_name' => array('column' => 'name', 'unique' => 0), 'idx_block' => array('column' => 'block', 'unique' => 0), 'username' => array('column' => 'username', 'unique' => 0), 'email' => array('column' => 'email', 'unique' => 0)),
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
			'name' => 'James Bynum',
			'username' => 'jbynum',
			'email' => 'false1@false.com',
			'password' => '',
			'usertype' => 'Registered',
			'block' => '0',
			'sendEmail' => '1',
			'registerDate' => '2000-01-01 01:59:00',
			'lastvisitDate' => '2011-12-14 06:06:08',
			'activation' => '',
			'params' => '{"admin_style":"","admin_language":"","language":"","editor":"switcher","helpsite":"","timezone":"","mc_default_style":null}'
		),
		array(
			'id' => '2',
			'name' => 'Harold Morrissey',
			'username' => 'hmorrissey',
			'email' => 'false2@false.com',
			'password' => '',
			'usertype' => 'Registered',
			'block' => '0',
			'sendEmail' => '1',
			'registerDate' => '2000-01-01 00:07:00',
			'lastvisitDate' => '2011-12-10 23:43:01',
			'activation' => '',
			'params' => '{"language":"","editor":"","timezone":"","admin_style":"","admin_language":"","helpsite":""}'
		),
		array(
			'id' => '3',
			'name' => 'Madeline Cremin',
			'username' => 'mcremin',
			'email' => 'false3@false.com',
			'password' => '',
			'usertype' => 'Registered',
			'block' => '0',
			'sendEmail' => '0',
			'registerDate' => '2000-01-01 16:38:00',
			'lastvisitDate' => '2011-12-10 23:39:49',
			'activation' => '',
			'params' => '{"editor":"","timezone":"UTC"}'
		),
		array(
			'id' => '4',
			'name' => 'Jacqueline Beaudoin',
			'username' => 'jbeaudoin',
			'email' => 'false4@false.com',
			'password' => '',
			'usertype' => 'Registered',
			'block' => '0',
			'sendEmail' => '1',
			'registerDate' => '2000-01-01 16:42:00',
			'lastvisitDate' => '2011-12-13 18:30:26',
			'activation' => '',
			'params' => '{"editor":"","timezone":"UTC"}'
		),
		array(
			'id' => '5',
			'name' => 'Sabine Chatigny',
			'username' => 'schatigny',
			'email' => 'false5@false.com',
			'password' => '',
			'usertype' => 'Registered',
			'block' => '0',
			'sendEmail' => '1',
			'registerDate' => '2000-01-01 16:43:00',
			'lastvisitDate' => '2011-12-14 16:01:14',
			'activation' => '',
			'params' => '{"editor":"","timezone":"UTC"}'
		),
	);
}