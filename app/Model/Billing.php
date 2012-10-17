<?php
/**
 * Billing Model
 *
 */
class Billing extends AppModel {
	
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
		// Set the filename to read from
		$filename = TMP . 'uploads' . DS . 'Billing' . DS . $filename;

		// Open the file
		if (!$file = fopen($filename, 'r')) {
			return false;
		}
		
		// Start parsing for health encounters
		$data = array();
		$i = 0;
		$j = 0;

		while($row = fgets($file)) {
			if (substr($row, 0, 3) == 'HEB') {
				$i = $i + 1;
				$data[$i] = $this->parseFields($row, 'HEB');
			}
			if (substr($row, 0, 3) == 'HEH') {
				$j = $j + 1;
				$data[$i][$j] = $this->parseFields($row, 'HEH');
			}
			if (substr($row, 0, 3) == 'HER') {
				$data[$i][$j]['Items'][] = $this->parseFields($row, 'HER');
			}
			if (substr($row, 0, 3) == 'HET') {
				$data[$i][$j]['Items'][] = $this->parseFields($row, 'HET');
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
		$fields = array();
		foreach($schema[$section] as $field => $opts) {
			$fields[$field] = substr($row, $opts['start'], $opts['length']);
		}
		return $fields;
	}
	
}
