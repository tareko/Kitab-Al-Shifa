<?php
App::uses('AppModel', 'Model');
/**
 * BillingsItem Model
 *
 * @property Billings $Billings
 */
class BillingsItem extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'service_date' => array(
					'date' => array(
							'rule' => array('date'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Billing' => array(
			'className' => 'Billing',
			'foreignKey' => 'billing_id'
		)
	);

	public function beforeValidate($options = array()) {
		if (!empty($this->data['BillingsItem']['service_date'])) {
			$this->data['BillingsItem']['service_date'] = $this->dateFormatBeforeSave($this->data['BillingsItem']['service_date']);
		}
		return true;
	}

	public function dateFormatBeforeSave($dateString) {
		return date('Y-m-d', strtotime($dateString));
	}

	public function distinctPatientsPerDay ($ohipNumber = null, $start_date = null, $end_date = null, $conditions = array()) {
		$i = 0;
		$output = array();
		$conditions = $conditions
			+ (isset($ohipNumber)? array('Billing.healthcare_provider' => $ohipNumber): array())
			+ (isset($start_date)? array('BillingsItem.service_date >=' => $start_date): array())
			+ (isset($end_date)? array('BillingsItem.service_date <=' => $end_date): array());
		$data = $this->find('all', array(
				'fields' => array('Billing.healthcare_provider', 'service_date', 'COUNT(DISTINCT billing_id)'),
				'conditions' => $conditions,
				'group' => array('Billing.healthcare_provider', 'service_date')
				)
		);
		foreach ($data as $row) {
			$output[$i]['healthcare_provider'] = $row['Billing']['healthcare_provider'];
			$output[$i]['service_date'] = $row['BillingsItem']['service_date'];
			$output[$i]['count'] = $row[0]['COUNT(DISTINCT billing_id)'];
			$i = $i + 1;
		}
		return $output;
	}

	public function distinctPatientsPerDayAnnualAverage ($conditions = array()) {
		$i = 0;
		$data = $this->find('all', array(
				'fields' => array('Billing.healthcare_provider', 'service_date', 'COUNT(DISTINCT billing_id)'),
				'conditions' => $conditions,
				'group' => array('Billing.healthcare_provider', 'service_date')
		)
		);
		foreach ($data as $row) {
			$output[$i]['healthcare_provider'] = $row['Billing']['healthcare_provider'];
			$output[$i]['service_date'] = $row['BillingsItem']['service_date'];
			$output[$i]['count'] = $row[0]['COUNT(DISTINCT billing_id)'];
			$i = $i + 1;
		}
		return $output;
	}

	public function distinctPatientsPerShift ($shift) {
		$conditions = array(
				'service_date' => $shift['Shift']['date'],
				'Billing.healthcare_provider' => $shift['User']['Profile']['cb_ohip'],
				);
		$output = $this->distinctPatientsPerDay(null, null, null, $conditions);
		return $output;
	}
}
