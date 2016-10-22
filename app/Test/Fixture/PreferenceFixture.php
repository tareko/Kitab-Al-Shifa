<?php
/**
 * Preference Fixture
 */
class PreferenceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 16, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false),
		'field' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
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
			'field' => 'ShiftLimit.1',
			'value' => '10'
		),
		array(
			'id' => '2',
			'user_id' => '2',
			'field' => 'ShiftLimit.1',
			'value' => ''
		),
		array(
			'id' => '3',
			'user_id' => '3',
			'field' => 'ShiftLimit.1',
			'value' => '8'
		),
		array(
			'id' => '4',
			'user_id' => '4',
			'field' => 'ShiftLimit.1',
			'value' => ''
		),
		array(
			'id' => '5',
			'user_id' => '5',
			'field' => 'ShiftLimit.1',
			'value' => 'Evening'
		),
	);

}