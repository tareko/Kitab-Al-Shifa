<?php
/**
 * AccountingFixture
 *
 */
class AccountingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'hour_of_week_start' => array('type' => 'integer', 'null' => false, 'default' => null),
		'hour_of_week_end' => array('type' => 'integer', 'null' => false, 'default' => null),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10),
		'updated' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 0)
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
			'id' => 1,
			'hour_of_week_start' => 1,
			'hour_of_week_end' => 1,
			'start_date' => '2012-12-29',
			'end_date' => '2012-12-29',
			'value' => 1,
			'updated' => 1356780674
		),
	);

}
