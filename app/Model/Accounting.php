<?php
App::uses('AppModel', 'Model');
/**
 * Accounting Model
 *
 */
class Accounting extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hour_of_week_start';
	var $virtualFields = array(
			'seconds_of_week_start' => '(hour_of_week_start * 3600)',
			'seconds_of_week_end' => '(hour_of_week_end * 3600)',
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'hour_of_week_start' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hour_of_week_end' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	function getBlockForShiftStart($date, $start_time) {
		App::uses('AccountingsException', 'Model');
		$this->AccountingsException = new AccountingsException();

		$accountingBlock = array();

		// TODO: Daylight savings?

		// TODO: Check if there are any exceptions first
		if (1 == 2) {

		}

		else {
			// If no exceptions, get the block
			$accountingBlock = $this->find('first', array(
					'conditions' => array(
							'start_date <=' => $date,
							'end_date >=' => $date,
							'seconds_of_week_start <=' => $start_time,
							'seconds_of_week_end >' => $start_time,
					),
				)
			);
		}
		return $accountingBlock;
	}

	function calculateXValueForShift ($date = null, $start_time = null, $end_time = null, $location = null) {
		$XValue = null;
		$startBlock = array();
		//Get back starting X block
		$startBlock = $this->getBlockForShiftStart($date, $start_time);
		$startBlock = $startBlock['Accounting'];

		// If the end time is not included in the shift, divide the block and grab the next block
		if (isset($startBlock['seconds_of_week_end']) && $startBlock['seconds_of_week_end'] < $end_time) {
			//Divide the block
			$XValue = (isset($XValue) ? $XValue : '') + $this->calculateXValueForShift($date, $start_time, $startBlock['seconds_of_week_end'], $location);
			$XValue = $XValue + $this->calculateXValueForShift($date, $startBlock['seconds_of_week_end'], $end_time, $location);
		}
		else {
			$XValue = ($end_time - $start_time) * $startBlock['value'];
		}

		return $XValue;

	}

	/* Calculate total salary for specified period for specified physician
	 *
	 */
	function calculateSalaryForUser($user = null, $date = array()) {
		// Get all shifts of user

		// Take individual shift

		// Break down individual shift into its hours
		// 19-03 would become 19, 20, 21, 22, 23, 00, 01, 02

		// Calculate value of each hour
			// Figure out what day of the week it is (e.g., Friday)
			// Figure out which payment block the specific hour is in
				// day * (hour+1) = Friday = 5; 1900 = 20
				// 5 * 20 = block #100
				// If not hour+1, then must contend with 00h, which breaks the multiplier
				// uniqueness above.

			// Multiply value by exceptions multiplier (e.g., holidays, stats)
			// Dec 25 0800 - 2000h = 1.25x

		// Add all hours for shift

		// Add all shifts for period

		// Add special exceptions
		// Example, split shift = $400 premium, so add or subtract

	}
}
