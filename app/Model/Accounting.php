<?php
App::uses('AppModel', 'Model');
/**
 * Accounting Model
 *
 */
class Accounting extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'start_time' => array(
			'time' => array(
				'rule' => array('time'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_time' => array(
			'time' => array(
				'rule' => array('time'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'multiplier' => array(
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
		'days_of_week' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'locations' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	 * Calculate the X value for a given shift
	 */

	function calculateXValueForShift ($shiftId = null) {

		// Get data for shift ID
		App::uses('Shift', 'Model');
		$this->Shift = ClassRegistry::init('Shift');
		$shift = $this->Shift->findById($shiftId);

		/* Consider two possibilities:
		 * 1. 0800 - 1600 = duration is simple subtraction
		 * 2. 1800 - 0200 = duration requires +24h to latter number
		 *
		 * In first case, take entire block for search
		 * In second case, divide block at the midnight mark and calculate as two blocks.
		 *
		 */

		// Map shifts onto actual date-times
		if ($shift['ShiftsType']['shift_start'] >= $shift['ShiftsType']['shift_end']) {
			$date = strtotime($shift['Shift']['date'] . " +1 day");

			$shift['start_date'] = new DateTime($shift['Shift']['date'] . $shift['ShiftsType']['shift_start']);
			$shift['end_date'] = new DateTime(date('Y-m-d', $date) . $shift['ShiftsType']['shift_end']);

			$shift_end = explode(":", $shift['ShiftsType']['shift_end']);
			$shift_end = $shift_end[0] . $shift_end[1] + 2400;

			$shift_start = explode(":", $shift['ShiftsType']['shift_start']);
			$shift_start = $shift_start[0] . $shift_start[1];

			$divided = true;
		}
		else {
			$shift['start_date'] = new DateTime($shift['Shift']['date'] . $shift['ShiftsType']['shift_start']);
			$shift['end_date'] = new DateTime($shift['Shift']['date'] . $shift['ShiftsType']['shift_end']);

			$shift_end = explode(":", $shift['ShiftsType']['shift_end']);
			$shift_end = $shift_end[0] . $shift_end[1];

			$shift_start = explode(":", $shift['ShiftsType']['shift_start']);
			$shift_start = $shift_start[0] . $shift_start[1];

			$divided = false;
		}


		// Get all relevant rows from accounting db
		$rules = $this->find('all', array(
				'conditions' => array(
						'start_time <=' => $shift_end,
						'end_time >=' => $shift_start,
						'start_date <=' => $shift['Shift']['date'],
						'end_date >=' => date('Y-m-d', $shift_end),
				)
		));

		// Calculate hours worked
		foreach ($rules as $rule) {
			// Is it the correct day?
			$days_of_week = json_decode($rule['Accounting']['days_of_week']);
			$target_days = ($divided ?
					array(
							$shift['start_date']->format('w'),
							$shift['start_date']->format('w') + 1 )
					:
					$shift['start_date']->format('w'));
			if(!array_intersect($target_days, $days_of_week)) { continue; }

			// Is it the correct location?
			$locations = json_decode($rule['Accounting']['locations']);
			if(!in_array($shift['ShiftsType']['location_id'], $days_of_week)) { continue; }

			debug($rule);
			// Map rule onto shift

			debug($rule['Accounting']['start_time'] . " " . $rule['Accounting']['end_time']);

			// Calculate value for each hour that is included
			if($rule['Accounting']['start_time'] <= $shift_start) {

			}

		}

		// Does shift qualify for exception?

		// Multiply hours worked by rate with following formula:
		// sum(value) * sum(multiplier) (no more than maximum) + exception


		$XValue = false;

		return $XValue;

	}

}
