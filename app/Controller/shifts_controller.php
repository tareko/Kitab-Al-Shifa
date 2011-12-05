<?php 
class ShiftsController extends AppController {
	var $scaffold;
	var $name = 'Shifts';
	
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Calendar', 'Cache', 'iCal');
//	public $cacheAction = "1 hour";

	var $paginate = array(
		'recursive' => '2',
//		'order' => array('ShiftsType.location_id' => 'ASC', 'ShiftsType.shift_start' => 'ASC', 'ShiftsType.shift_end' => 'ASC')
	);

	public $presetVars = array(
		array('field' => 'month', 'type' => 'value'),
		array('field' => 'year', 'type' => 'value'),
        array('field' => 'location', 'type' => 'value', 'formField' => 'location', 'modelField' => 'location', 'model' => 'Location')
		);

	function index() {
		$this->set('locations', $this->Shift->ShiftsType->Location->find('list', array(
			'fields' => array('Location.location'),
//			'order' => array('ShiftsType.location_id ASC', 'ShiftsType.shift_start ASC'),
			)));
		$this->Prg->commonProcess();
        $this->paginate['conditions'] = $this->Shift->parseCriteria($this->passedArgs);
		$this->set('shifts', $this->paginate());
	}
	
	function add() {
		# Check if there is form data to be processed
		$saved = null;
		if (!empty($this->data)){
			foreach ($this->data['Shift'] as $dataRaw) {
				if ($dataRaw['physician_id'] != '') {
					$data['Shift'][] = $dataRaw;
					$saved = 1;
				}
			}
			if ($saved == 1) {
				if ($this->Shift->saveAll($data['Shift'])) {
					$this->Session->setFlash('Shift saved');
					$this->redirect(array('action' => 'viewCalendar'));
				}
				$this->Session->setFlash(__('Shift was not deleted'));
				$this->redirect(array('action' => 'viewCalendar'));
 			}
		}
		
		# If no data, present an add form
		$this->set('scaffoldFields', array_keys($this->Shift->schema()));
		$this->set('shifts', $this->paginate());
		$this->set('physicians', $this->Shift->Physician->find('list', array(
			'fields' => array('Physician.id', 'Physician.physician_name'),
			'order'=>array('Physician.physician_name ASC'))));

		$this->set('shiftsTypes', $this->Shift->ShiftsType->find('list', array(
			'fields' => array('ShiftsType.id', 'ShiftsType.times', 'Location.location'),
			'recursive' => '2')));
	}

	function createPdf() {
		$this->loadModel('Calendar');
		if (isset($this->request->named['calendar']['calendar'])) {
			$masterSet['calendar'] = $this->Calendar->findById($this->request->named['calendar']['calendar']);
			$masterSet['calendar']['id'] = $this->request->named['calendar']['calendar'];
		}
		else {
			//$calendar = $this->Shift->Calendar->findById('1');
			$masterSet['calendar'] = $this->Calendar->findById('1');
			$masterSet['calendar']['id'] = 1;
		}
		$this->set('calendars', $this->Calendar->find('list'));
		
		$shiftList = $this->Shift->find('all', array(
			'fields' => array('Shift.id', 'Shift.physician_id', 'Shift.shifts_type_id', 'Shift.date', 'Shift.day', 'Physician.physician_name', 'ShiftsType.id', 'ShiftsType.location_id', 'ShiftsType.shift_start'),
//			'order' => array('ShiftsType.location_id ASC', 'ShiftsType.shift_start ASC'),
			'conditions' => array(
				'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
				'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
			),
			'recursive' => '2'));

		$locations_raw = $this->Shift->ShiftsType->Location->find('all', array(
			'fields' => array('Location.id', 'Location.location', 'Location.abbreviated_name'),
			'recursive' => '0'
			));
		foreach ($locations_raw as $location) {
			$masterSet['locations'][$location['Location']['id']]['location'] = $location['Location']['location'];
			$masterSet['locations'][$location['Location']['id']]['abbreviated_name'] = $location['Location']['abbreviated_name']; 
		}
		$masterSet['ShiftsType'] = $this->Shift->ShiftsType->find('all', array(
			'fields' => array('ShiftsType.times', 'ShiftsType.location_id', 'ShiftsType.display_order'),
			'conditions' => array(
				'ShiftsType.start_date <=' => $masterSet['calendar']['Calendar']['start_date'],
				'ShiftsType.expiry_date >=' => $masterSet['calendar']['Calendar']['start_date'],
				),
			'order' => array('ShiftsType.display_order ASC', 'ShiftsType.shift_start ASC'),
				));

		// Count out shifts per site so that each location column can be properly populated
/*		$locationArray = null;
		foreach ($masterSet['locations'] as $id => $location) {
		$count = $this->Shift->ShiftsType->find('count', array(
			'conditions' => array('ShiftsType.location_id' => $id),
			));
			$locationArray[$id] = array($location => $count);
		}
		$masterSet[0] = $locationArray;
*/

		foreach ($shiftList as $shift) {
			$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['Physician']['physician_name'], 'id' => $shift['Shift']['id']);
		}
		
		$this->set('masterSet', $masterSet);
//		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
//		$this->header("Content-Type: application/pdf");
		$this->render();
	}

	function viewCalendar() {
		$this->Prg->commonProcess();
		$this->loadModel('Calendar');
		if (isset($this->request->named['calendar']['calendar'])) {
			$masterSet['calendar'] = $this->Calendar->findById($this->request->named['calendar']['calendar']);
		}
		else {
			//$calendar = $this->Shift->Calendar->findById('1');
			$masterSet['calendar'] = $this->Calendar->findById('1');
		}
		$this->set('calendars', $this->Calendar->find('list'));
		
		$shiftList = $this->Shift->find('all', array(
			'fields' => array('Shift.id', 'Shift.physician_id', 'Shift.shifts_type_id', 'Shift.date', 'Shift.day', 'Physician.physician_name', 'ShiftsType.id', 'ShiftsType.location_id', 'ShiftsType.shift_start'),
//			'order' => array('ShiftsType.location_id ASC', 'ShiftsType.shift_start ASC'),
			'conditions' => array(
				'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
				'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
			),
			'recursive' => '2'));
		$locations_raw = $this->Shift->ShiftsType->Location->find('all', array(
			'fields' => array('Location.id', 'Location.location', 'Location.abbreviated_name'),
			'recursive' => '0'
			));
		foreach ($locations_raw as $location) {
			$masterSet['locations'][$location['Location']['id']]['location'] = $location['Location']['location'];
			$masterSet['locations'][$location['Location']['id']]['abbreviated_name'] = $location['Location']['abbreviated_name']; 
		}
		$masterSet['ShiftsType'] = $this->Shift->ShiftsType->find('all', array(
			'fields' => array('ShiftsType.times', 'ShiftsType.location_id', 'ShiftsType.display_order'),
			'conditions' => array(
				'ShiftsType.start_date <=' => $masterSet['calendar']['Calendar']['start_date'],
				'ShiftsType.expiry_date >=' => $masterSet['calendar']['Calendar']['start_date'],
						),
			'order' => array('ShiftsType.display_order ASC', 'ShiftsType.shift_start ASC'),
				));

		// Count out shifts per site so that each location column can be properly populated
/*		$locationArray = null;
		foreach ($masterSet['locations'] as $id => $location) {
		$count = $this->Shift->ShiftsType->find('count', array(
			'conditions' => array('ShiftsType.location_id' => $id),
			));
			$locationArray[$id] = array($location['location'] => $count);
		}
		$masterSet[0] = $locationArray;
*/
		foreach ($shiftList as $shift) {
			$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['Physician']['physician_name'], 'id' => $shift['Shift']['id']);
		}
		
		//Editing the calendar: Get list of physicians
		$this->set('physicians', $this->Shift->Physician->find('list', array(
			'fields' => array('Physician.id', 'Physician.physician_name'),
			'order'=>array('Physician.physician_name ASC'))));
		
		
		$this->set('masterSet', $masterSet);
	}

	function viewPdf() {
		$this->loadModel('Calendar');
		$this->set('calendars', $this->Calendar->find('list', array(
			'fields' => array('Calendar.start_date', 'Calendar.name', 'Calendar.id'),
			'order'=>array('Calendar.start_date ASC'))));
		$this->render();
	}


	function viewIcs() {
		if (!isset($this->request->named['id']['id'])) {
			return $this->setAction('viewIcsList');
		}
		else {
			$shiftList = $this->Shift->find('all', array(
				'fields' => array('Shift.id', 'Shift.physician_id', 'Shift.shifts_type_id', 'Shift.date', 'Shift.day', 'Physician.physician_name', 'ShiftsType.id', 'ShiftsType.location_id', 'ShiftsType.shift_start'),
				'conditions' => array(
					'Shift.date >=' => date('Y-m-d', strtotime("-6 months")),
					'Shift.physician_id' => $this->request->named['id']['id'],
					),
				'recursive' => '2'));
			$locations_raw = $this->Shift->ShiftsType->Location->find('all', array(
				'fields' => array('Location.id', 'Location.location', 'Location.abbreviated_name'),
				'recursive' => '0'
				));
			foreach ($locations_raw as $location) {
				$locationSet[$location['Location']['id']] = $location['Location']['location'];
//				$masterSet['locations'][$location['Location']['id']]['abbreviated_name'] = $location['Location']['abbreviated_name']; 
			}

			$shiftsTypeSetRaw = $this->Shift->ShiftsType->find('all', array(
				'fields' => array('ShiftsType.comment', 'ShiftsType.shift_start', 'ShiftsType.shift_end'),
				'conditions' => array(
					'ShiftsType.expiry_date >=' => date('Y-m-d', strtotime("-6 months")),
					),
				'recursive' => '0',
				)
			);
			foreach ($shiftsTypeSetRaw as $shiftsTypeSetRaw) {
				$shiftsTypeSet[$shiftsTypeSetRaw['ShiftsType']['id']]['comment'] = $shiftsTypeSetRaw['ShiftsType']['comment'];
				$shiftsTypeSet[$shiftsTypeSetRaw['ShiftsType']['id']]['shift_start'] = $shiftsTypeSetRaw['ShiftsType']['shift_start'];
				$shiftsTypeSet[$shiftsTypeSetRaw['ShiftsType']['id']]['shift_end'] = $shiftsTypeSetRaw['ShiftsType']['shift_end'];
			}
					
			$i = 1;
			foreach ($shiftList as $shift) {
				$masterSet[$i]['id'] = $shift['Shift']['id'];
				$masterSet[$i]['date'] = $shift['Shift']['date'];
				$masterSet[$i]['location'] = $locationSet[$shift['ShiftsType']['location_id']];
				$masterSet[$i]['shift_start'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['shift_start'];
				$masterSet[$i]['shift_end'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['shift_end'];
				$masterSet[$i]['comment'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['comment'];
				$masterSet[$i]['physician_name'] = $shift['Physician']['physician_name'];
				$i++;
			}
			//Editing the calendar: Get list of physicians
			$this->set('physicians', $this->Shift->Physician->find('list', array(
				'fields' => array('Physician.id', 'Physician.physician_name'),
				'order'=>array('Physician.physician_name ASC'))));
			
			
			$this->set('masterSet', $masterSet);
		}
	}


	function viewIcsList() {
		$this->set('physicians', $this->Shift->Physician->find('list', array(
				'fields' => array('Physician.id', 'Physician.physician_name'),
				'order'=>array('Physician.physician_name ASC'))));
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Shift->id = $id;
		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid Shift'));
		}
		if ($this->Shift->delete()) {
			$this->Session->setFlash(__('Shift deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Shift was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>
