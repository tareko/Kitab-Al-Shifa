<?php 
class ShiftsController extends AppController {
	var $scaffold;
	var $name = 'Shifts';
	
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Calendar');

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
					$this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Shift was not deleted'));
				$this->redirect(array('action' => 'index'));
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

	function viewPdf() {
		//Figure out month and year of calendar to display
		if (isset($this->request->named['month']['month'])) {
			$masterSet['month'] = $this->request->named['month']['month'];
		}
		else {
			$masterSet['month'] = date('m');
		}
		if (isset($this->request->named['year']['year'])) {
			$masterSet['year'] = $this->request->named['year']['year'];
		}
		else {
			$masterSet['year'] = date('Y');
		}

		$shiftList = $this->Shift->find('all', array(
			'fields' => array('Shift.id', 'Shift.physician_id', 'Shift.shifts_type_id', 'Shift.date', 'Shift.day', 'Physician.physician_name', 'ShiftsType.id', 'ShiftsType.location_id', 'ShiftsType.shift_start'),
			'conditions' => array(
				'Shift.date >=' => date('Y-m-d', strtotime($masterSet['year'] ."-". $masterSet['month'] ."-01")),
				'Shift.date <' => date('Y-m-d', strtotime($masterSet['year'] ."-". ($masterSet['month'] + 1) ."-01"))),
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
				'ShiftsType.start_date <=' => date('Y-m-d', strtotime($masterSet['year'] ."-". $masterSet['month'] ."-01")),
				'ShiftsType.expiry_date >=' => date('Y-m-d', strtotime($masterSet['year'] ."-". $masterSet['month'] ."-01"))
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
			$masterSet[date('j', strtotime($shift['Shift']['date']))][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['Physician']['physician_name'], 'id' => $shift['Shift']['id']);
		}
		$this->set('masterSet', $masterSet);
		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
		$this->header("Content-Type: application/pdf");
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

	public function delete($id = null) {
$this->loadModel('ShiftsType');
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