<?php
/**
 * BillingsItemFixture
 *
 */
class BillingsItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'service_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 5, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fee_submitted' => array('type' => 'integer', 'null' => false, 'default' => null),
		'number_of_services' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'billings_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			
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
			'service_code' => 'Lor',
			'fee_submitted' => 1,
			'number_of_services' => 1,
			'service_date' => '2012-10-20',
			'billings_id' => 1
		),
	);

}
