<?php 
App::uses('Sanitize', 'Utility');

class BillingsController extends AppController {
	var $name = 'Billings';
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Cache', 'Html');


	function index() {
		$this->loadModel('BillingsItem');
		$perDay = $this->BillingsItem->distinctPatientsPerDayAnnualAverage(array('healthcare_provider' => 10800));
		debug ($perDay);
        $this->render();
	}
	/* Upload function
	 * 
	 */
	function upload() {
		if ($this->request->isPost()) {
			$data = $this->Billing->import($this->request->data['Billing']['upload']['tmp_name']);
			if ($this->Billing->saveAll($data, array('deep' => true))) {
				return $this->Session->setFlash('Successfully imported file \'' .$this->request->data['Billing']['upload']['name'] . '\'');
			}
			else {
				debug($this->Billing->validationErrors);
				debug($data);
				return $this->Session->setFlash('I\'m sorry. This file did not successfully import.');
			}
			
		}
		$this->render();
	}
	
	function export() {
		//set_time_limit(300);
		// Find fields needed without recursing through associated models
		$data = $this->Billing->find('all', array(
				'BillingsItem',
				'limit' => 10000));
		$data = $this->Billing->recombineBilling($data);
		// Define column headers for CSV file, in same array format as the data itself
		$headers = array(
				'id' => 'ID',
				'service_code' => 'Service code',
				'fee_submitted' => 'Fee submitted',
				'number_of_services' => 'Number of services',
				'service_date' => 'Service date',
				'billing_id' => 'Billing ID',
				'healthcare_provider' => 'Provider',
				'patient_birthdate' => 'Patient birthdate',
				'payment_program' => 'Payment program',
				'payee' => 'Payee',
				'referring' => 'Referring physician'
		);
		// Add headers to start of data array
		array_unshift($data,$headers);
		// Make the data available to the view (and the resulting CSV file)
		$this->set(compact('data'));
	}
	
	function patientsPerDay() {
		$this->loadModel('BillingsItem');
		$data = $this->BillingsItem->distinctPatientsPerDay();
		$headers = array(
				'healthcare_provider' => 'Provider',
				'service_date' => 'Service date',
				'COUNT(DISTINCT billing_id)' => 'Unique patients seen',
		);
		// Add headers to start of data array
		array_unshift($data,$headers);
		$this->set('data', $data);
		$this->render();
	}
	
}
?>
