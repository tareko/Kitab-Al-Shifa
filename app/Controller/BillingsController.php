<?php 
App::uses('Sanitize', 'Utility');

class BillingsController extends AppController {
	var $name = 'Billings';
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Cache', 'Html');


	function index() {
		$i = 0;
		$this->loadModel('BillingsItem');
		$this->loadModel('Shift');
		
		if (!isset($this->request->query['id']) || !isset($this->request->query['start_date']) || !isset($this->request->query['end_date'])) {
			return $this->render();
		}
		
		$conditions = array();
		if (isset($this->request->query['id'])) {
			$conditions = $conditions + array('user_id' => $this->request->query['id']);
		}
		if (isset($this->request->query['start_date'])) {
			$conditions = $conditions + array('Shift.date >=' => $this->request->query['start_date']);
		}
		if (isset($this->request->query['end_date'])) {
			$conditions = $conditions + array('Shift.date <=' => $this->request->query['end_date']);
		}
		

		$shiftsWorked = $this->Shift->getShiftList($conditions);
		foreach($shiftsWorked as $shift) {
			$patientsSeen[$i] = $shift;
			$patientsPerShift = $this->BillingsItem->distinctPatientsPerShift($shift);
			if ($patientsPerShift) {
				$patientsSeen[$i]['Billing'] = $patientsPerShift['0'];
			}
			else {
				$patientsSeen[$i]['Billing']['count'] = 'Unavailable';
			}
			$i = $i + 1; 
		}
		$this->set(compact('patientsSeen'));
        $this->render();
	}
	/* Upload function
	 * 
	 */
	function upload() {
		$status = array();
		if ($this->request->isPost()) {
			$failure = false;
			foreach ($this->data['Billing']['upload'] as $upload) {
				$data = $this->Billing->import($upload['tmp_name']);
				if ($this->Billing->saveAll($data, array('deep' => true))) {
					$status[] = $upload['name'] ." saved successfully";
				}
				else {
					debug($this->Billing->validationErrors);
					debug($data);
					$status[] = $upload['name'] ." failed to save";
					$failure = true;
				}
			}
			if ($failure == true) {
				$this->set(compact('status'));
				$this->Session->setFlash('I\'m sorry. One or more files did not successfully import.');
				return $this->render();
			}
			else {
				$this->set(compact('status'));
				$this->Session->setFlash('Import successful.');
				return $this->render();
			}
		}
		$this->set(compact('status'));
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
