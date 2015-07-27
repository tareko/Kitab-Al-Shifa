<?php
App::uses('AppModel', 'Model');
/**
 * Billing Model
 *
 * @property BillingsItem $BillingsItem
 */
class Billing extends AppModel {

	public $actsAs = array('Containable');

	/**
	 * Associations
	 * @var unknown_type
	 */
	public $hasMany = array(
			'BillingsItem' => array(
					'className' => 'BillingsItem',
					'foreignKey' => 'billing_id',
			)
	);
	public $belongsTo = array(

			//Not working
			'Profile' => array(
					'classname' => 'Profile',
					'foreignKey' => 'cb_ohip',
					'associationForeignKey'  => 'healthcare_provider',
			),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'patient_birthdate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'payment_program' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'payee' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*
 		'referring' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
 		),
*/
	);

	public function beforeValidate($options = array()) {
		if (!empty($this->data['Billing']['patient_birthdate'])) {
			$this->data['Billing']['patient_birthdate'] = $this->dateFormatBeforeSave($this->data['Billing']['patient_birthdate']);
		}
		return true;
	}

	public function dateFormatBeforeSave($dateString) {
		return date('Y-m-d', strtotime($dateString));
	}

	/**
	 * Imports MOHLTC file into DB
	 * See MOHLTC Technical specifications: Interface to Health Care Systems
	 * http://health.gov.on.ca/english/providers/pub/ohip/tech_specific/tech_specific_mn.html
	 *
	 * Special thanks to Tigrang for some amazing help!
	 *
	 * @param string $filename
	 */
	function import ($filename) {
		// Open the file
		ini_set('track_errors', 1);
		if (!$file = @fopen($filename, 'r')) {
			throw new NotFoundException("Failed opening file: error was ".$php_errormsg);
		}

		// Start parsing for health encounters
		$data = array();
		$i = 0;
		$j = 0;

		while($row = fgets($file)) {
			if (substr($row, 0, 3) == 'HEB') {
				$i = $i + 1;
				$data_provider[$i] = $this->parseFields($row, 'HEB');
			}
			if (substr($row, 0, 3) == 'HEH') {
				$j = $j + 1;
				$data[$j]['Billing'] = $this->parseFields($row, 'HEH');
				$data[$j]['Billing']['healthcare_provider'] = $data_provider[$i]['healthcare_provider'];
			}
			if (substr($row, 0, 3) == 'HER') {
				$data[$j]['BillingsItem'][] = $this->parseFields($row, 'HER');
			}
			if (substr($row, 0, 3) == 'HET') {
				$data[$j]['BillingsItem'][] = $this->parseFields($row, 'HET');
				if (substr($row, 41, 1) != ' ') {
					$data[$j]['BillingsItem'][] = $this->parseFields(substr($row, 38), 'HET');
				}
			}
		}
		return $data;
	}

	function parseFields($row, $section) {
		$schema = array(
				'HEB' => array(
						'healthcare_provider' => array(
								'start' => 29,
								'length' => 6)
				),
				'HEH' => array(
						'patient_birthdate' => array(
								'start' => 15,
								'length' => 8),
						'payment_program' => array(
								'start' => 31,
								'length' => 3),
						'payee' => array(
								'start' => 34,
								'length' => 1),
						'referring' => array(
								'start' => 35,
								'length' => 6),
				),
				'HER' => array(
						'field_name' => array(
								'start' => 1,
								'length' => 2,)
				),
				'HET' => array(
						'service_code' => array(
								'start' => 3,
								'length' => 5),
						'fee_submitted' => array(
								'start' => 10,
								'length' => 6),
						'number_of_services' => array(
								'start' => 16,
								'length' => 2),
						'service_date' => array(
								'start' => 18,
								'length' => 8)
				),
		);

		//OHIP Number
		if (Configure::read('save_ohip') == true) {
			$schema['HEH']['ohip'] = array(
				'start' => 3,
				'length' => 10);
		}

		$fields = array();
		foreach($schema[$section] as $field => $opts) {
			$fields[$field] = substr($row, $opts['start'], $opts['length']);
		}
		return $fields;
	}

	/**
	 * Recombine billings into one array for ease of CSV export
	 * @param array $data
	 */

	public function recombineBilling ($data) {
		$i = 0;
		foreach ($data as $row) {
			foreach ($row['BillingsItem'] as $item) {
				$output[$i] = $item;
				$output[$i]['healthcare_provider'] = $row['Billing']['healthcare_provider'];
				$output[$i]['patient_birthdate'] = $row['Billing']['patient_birthdate'];
				$output[$i]['payment_program'] = $row['Billing']['payment_program'];
				$output[$i]['payee'] = $row['Billing']['payee'];
				$output[$i]['referring'] = $row['Billing']['referring'];
				$i = $i + 1;
			}
		}
		return $output;
	}

	/**
	 * How much was spent per Patient. Receive patient identifier as OHIP number.
	 *
	 * @param string $ohip
	 * @param array $conditions
	 */

	public function spentPerPatient($ohip = null, $conditions = array()) {
		$conditions = $conditions + array('Billing.ohip' => $ohip);
		$output = $this->BillingsItem->find('all', array(
					'fields' => array('SUM(fee_submitted)'),
					'conditions' => $conditions,
				)
		);
		return $output[0][0]['SUM(fee_submitted)'];
	}
}
