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
			'notempty' => array(
				'rule' => array('notempty'),
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

	/**
	 * Calculate the value of X for a given series of shifts
	 *
	 * @param array $shifts
	 * @return array
	 */
	function calculateX($shifts = array()) {
		$output = array();
		foreach ($shifts as $shift) {
			$output['ohip'] = $shift['Profile']['cb_ohip'];
			$output['id'] = $shift['Profile']['id'];
			foreach ($shift['Shift'] as $shift) {

				//Calculate day of week from date
				$day = date('N', strtotime($shift['date'])) - 1;

				//Calculate start hour for shift on week scale
				$start_time = strtotime($shift['ShiftsType']['shift_start'] . " +" . $day * 24 ." hours") - strtotime("00:00:00");

				//Calculate proper end hour - add 24h if necessary
				$end_time = strtotime($shift['ShiftsType']['shift_end'] . ($shift['ShiftsType']['shift_end'] > $shift['ShiftsType']['shift_start'] ?"": "+24 hours") . " +" . $day * 24 ." hours") - strtotime("00:00:00");

				//Add X value to previously stored value for location
				$output[$shift['ShiftsType']['Location']['location']] = (isset($output[$shift['ShiftsType']['Location']['location']]) ? $output[$shift['ShiftsType']['Location']['location']] : '') + $this->calculateXValueForShift($shift['date'], $start_time, $end_time, $shift['ShiftsType']['Location']['location']);
			}
		}
		return $output;
	}

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
}
