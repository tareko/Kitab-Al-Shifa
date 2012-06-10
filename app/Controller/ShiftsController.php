<?php 
App::uses('Sanitize', 'Utility');

class ShiftsController extends AppController {
	var $name = 'Shifts';
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Calendar', 'Cache', 'iCal', 'PhysicianPicker');
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
		$this->Prg->commonProcess();
		$this->loadModel('Calendar');
		$conditions = array();
		if (isset($this->request->params['named']['calendar'])) {
			$calendar = $this->Calendar->findById($this->request->params['named']['calendar']);
			$conditions =  array(
					'Shift.date >=' => $calendar['Calendar']['start_date'],
					'Shift.date <=' => $calendar['Calendar']['end_date'],
					);
		}
		
		$this->set('locations', $this->Shift->ShiftsType->Location->find('list', array(
			'fields' => array('Location.location'),
//			'order' => array('ShiftsType.location_id ASC', 'ShiftsType.shift_start ASC'),
			)));
        $this->paginate['conditions'] = $this->Shift->parseCriteria($this->passedArgs);

        if (isset($this->request->params['named']['id'])) {
        	$this->set('shifts', $this->paginate(array(
        			'Shift.user_id' => $this->request->params['named']['id'])
        			+ $conditions));
        }
        else {
        	$this->set('shifts', $this->paginate());
        }
        $this->render();
	}
	
	function home() {
		$this->set('locations', $this->Shift->ShiftsType->Location->find('list', array(
				'fields' => array('Location.location'),
				//			'order' => array('ShiftsType.location_id ASC', 'ShiftsType.shift_start ASC'),
		)));
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Shift->parseCriteria($this->passedArgs);
		$this->paginate['limit'] = 5;
	
		$this->set('shifts', $this->paginate(array(
				'Shift.user_id' => $this->_usersId(), 
				'Shift.date >=' => date('Y-m-d')
				)));
		$this->set('usersId', $this->_usersId());
	}
	
	function add() {
		$this->loadModel('Profile');
		# Check if there is form data to be processed
		$saved = null;
		if (!empty($this->data)){
			foreach ($this->data['Shift'] as $dataRaw) {
				if ($dataRaw['user_id'] != '') {
					$data['Shift'][] = $dataRaw;
					$saved = 1;
				}
			}
			if ($saved == 1) {
				if ($this->Shift->saveAll($data['Shift'])) {
					$this->Session->setFlash('Shift saved');
					$this->redirect(array('action' => $this->request->params['named']['Action'].'/calendar:'.$this->request->params['named']['calendar']));
				}
				$this->Session->setFlash(__('Shift was not saved'));
				$this->redirect(array('action' => $this->request->params['named']['Action']));
 			}
		}
		
		# If no data, present an add form
		$this->set('scaffoldFields', array_keys($this->Shift->schema()));
		$this->set('shifts', $this->paginate());
		$this->set('users', $this->Shift->User->getList(NULL, NULL, true));
		
		$this->set('shiftsTypes', $this->Shift->ShiftsType->find('list', array(
			'fields' => array('ShiftsType.id', 'ShiftsType.times', 'Location.location'),
			'recursive' => '0')));
	}

	function pdfCreate() {
		$this->loadModel('Calendar');
		if (isset($this->request->params['named']['calendar'])) {
			$masterSet['calendar'] = $this->Calendar->findById($this->request->params['named']['calendar']);
			$masterSet['calendar']['lastupdated'] = $this->Shift->find('first', array(
				'fields' => array('Shift.updated'),
				'order' => array(
					'Shift.updated' => 'DESC',
				)
			));
		}
		else {
			return $this->setAction('calendarList', 'pdfCreate');
		}
		$this->set('calendars', $this->Calendar->find('list'));
		
		$shiftList = $this->Shift->find('all', array(
				'contain' => array(
					'ShiftsType' => array('Location'), 
					'User' => array('Profile')
				),
				'conditions' => array(
					'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
					'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
				)
			));

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

		foreach ($shiftList as $shift) {
			$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['User']['Profile']['cb_displayname'], 'id' => $shift['Shift']['id']);
		}
		
		$this->set('masterSet', $masterSet);
//		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
//		$this->header("Content-Type: application/pdf");
		$this->render();
	}

	/**
	 * Function for web-based editing of calendar.
	 * 
	 */
	function calendarEdit() {
		$this->Prg->commonProcess();
		$this->loadModel('Calendar');
		$this->loadModel('Profile');
		
		if (isset($this->request->params['named']['calendar'])) {
			$masterSet['calendar'] = $this->Calendar->findById($this->request->params['named']['calendar']);
		}
		else {
			return $this->setAction('calendarList', 'calendarEdit');
		}
		$this->set('calendars', $this->Calendar->find('list'));
		
		$shiftList = $this->Shift->getShiftList(
			array(
				'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
				'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
				)
			);

  		$masterSet['locations'] = $this->Shift->ShiftsType->Location->getLocations();

		$masterSet['ShiftsType'] = $this->Shift->ShiftsType->find('all', array(
			'fields' => array('ShiftsType.times', 'ShiftsType.location_id', 'ShiftsType.display_order'),
			'conditions' => array(
				'ShiftsType.start_date <=' => $masterSet['calendar']['Calendar']['start_date'],
				'ShiftsType.expiry_date >=' => $masterSet['calendar']['Calendar']['start_date'],
						),
			'order' => array('ShiftsType.display_order ASC', 'ShiftsType.shift_start ASC'),
				));


		foreach ($shiftList as $shift) {
			$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['User']['Profile']['cb_displayname'], 'id' => $shift['Shift']['id']);
		}

		$this->set('users', $this->User->getActiveUsersForGroup($masterSet['calendar']['Calendar']['usergroups_id'], false, array(), true));
		$this->set('masterSet', $masterSet);
	}

	function calendarView() {
		$this->Prg->commonProcess();
		$this->loadModel('Calendar');
		$this->loadModel('Profile');
		
		if (isset($this->request->params['named']['calendar'])) {
			$masterSet['calendar'] = $this->Calendar->findById($this->request->params['named']['calendar']);
		}
		else {
			return $this->setAction('calendarList', 'calendarView');
		}
		$this->set('calendars', $this->Calendar->find('list'));
	
		if (isset($this->request->params['named']['id'])) {
			$shiftList = $this->Shift->getShiftList(
				array(
					'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
					'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
					'Shift.user_id' => $this->request->params['named']['id'],
					)
			);
		}

		else {
			$shiftList = $this->Shift->getShiftList(
				array(
					'Shift.date >=' => $masterSet['calendar']['Calendar']['start_date'],
					'Shift.date <=' => $masterSet['calendar']['Calendar']['end_date'],
					)
			);
		}

		$masterSet['locations'] = $this->Shift->ShiftsType->Location->getLocations();
	
 		$masterSet['ShiftsType'] = $this->Shift->ShiftsType->find('all', array(
				'fields' => array('ShiftsType.times', 'ShiftsType.location_id', 'ShiftsType.display_order'),
				'conditions' => array(
					'ShiftsType.start_date <=' => $masterSet['calendar']['Calendar']['start_date'],
					'ShiftsType.expiry_date >=' => $masterSet['calendar']['Calendar']['start_date'],
		),
				'order' => array('ShiftsType.display_order ASC', 'ShiftsType.shift_start ASC'),
		));
	
	
		foreach ($shiftList as $shift) {
			$masterSet[$shift['Shift']['date']][$shift['ShiftsType']['location_id']][$shift['Shift']['shifts_type_id']] = array('name' => $shift['User']['Profile']['cb_displayname'], 'id' => $shift['Shift']['id']);
		}
		
		$this->set('masterSet', $masterSet);
		$this->render();
	}
	
	function pdfView() {
			$this->loadModel('Calendar');
			$this->set('calendars', $this->Calendar->getList());
	}


	function icsView() {
		$this->Prg->commonProcess();
		if (!isset($this->request->params['named']['id'])) {
			return $this->setAction('physicianList', 'icsView');
		}
		$shiftList = $this->Shift->getShiftList(
			array (
				'Shift.date >=' => date('Y-m-d', strtotime("-6 months")),
				'Shift.user_id' => $this->request->params['named']['id'],
			)
		);

		$locationSet = $this->Shift->ShiftsType->Location->getLocations();

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
			$masterSet[$i]['location'] = $locationSet[$shift['ShiftsType']['location_id']]['location'];
			$masterSet[$i]['shift_start'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['shift_start'];
			$masterSet[$i]['shift_end'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['shift_end'];
			$masterSet[$i]['comment'] = $shiftsTypeSet[$shift['Shift']['shifts_type_id']]['comment'];
			$masterSet[$i]['display_name'] = $shift['User']['Profile']['cb_displayname'];
			$i++;
		}

		$this->set('masterSet', $masterSet);
	}

	/**
	 * List of all physicians for icsView
	 * 
	 */
	function physicianList($physicianAction, $group = null) {
		if ($group) {
			$physicians = $this->User->getActiveUsersForGroup($group, true, true);
		}
		else {
			$physicians = $this->User->getList(null, true, true);
		}

		$this->Session->setFlash(__('Please select a physician'));
		$this->set('physicianAction', $physicianAction);
		$this->set('physicians', $physicians);
	}
	
	/**
	 * List of calendars
	 */
	public function calendarList($calendarAction) {
		$this->loadModel('Calendar');
		$this->set('calendarAction', $calendarAction);
		if (isset($this->request->params['named']['id'])) {
			$this->set('passed_id', $this->request->params['named']['id']);
		}
		$this->Session->setFlash(__('Please select a calendar'));
		$this->set('calendars', $this->Calendar->getList());
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

	public function edit($id = null) {
		$this->Shift->id = $id;
		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid shift'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Shift->save($this->request->data)) {
				$this->Session->setFlash(__('The shift has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift could not be saved. Please, try again.'));
			}
		} else {
			$this->set('physicians', $this->Shift->User->getList(NULL, NULL, true));
			$this->set('shiftsTypes', $this->Shift->ShiftsType->find('list'));
			$this->request->data = $this->Shift->read(null, $id);
		}
	}

	function wizard() {
		$params = array();
		$this->loadModel('Calendar');
		$this->Prg->commonProcess();
		$this->set('physicians', $this->User->getList(null, true, true));
		$this->set('calendars', $this->Calendar->find('list'));
		
		
		if (isset($this->request->params['named']['list'])) {
			if ($this->request->params['named']['list'] == 'all') {
				unset($this->request->params['named']['id']);
			}
			if ($this->request->params['named']['list'] == 'mine') {
				$this->request->params['named']['id'] = $this->_usersId();
			}
			
			//TODO: Needs fixing so that the 'some users' category can be selected
			if ($this->request->params['named']['list'] == 'some') {
				return $this->Session->setFlash('Apologies. That option is not available currently');
				if (isset($this->request->data['User'])) {
					$i = 0;
					foreach ($this->request->data['User'] as $users) {
						$params = $params + array('id[' .$i. ']' => $users['id']);
						$i++;
					}
				}
			}
				
				

			if (isset($this->request->params['named']['output'])) {
				if ($this->request->params['named']['output'] == 'webcal') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'calendarView') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->params['named']['output'] == 'list') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'index') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->params['named']['output'] == 'print') {
					if ($this->request->params['named']['list'] == 'mine' || $this->request->params['named']['list'] == 'some') {
						return $this->Session->setFlash('Apologies. That option is not available currently');
					}
					else {
						$this->Session->setFlash('Please select which calendar you would like to see');
						return $this->redirect(array('controller' => 'shifts', 'action' => 'pdfView') + $this->request->params['named'] + $params);
					}
				}
				elseif ($this->request->params['named']['output'] == 'ics') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'icsView') + $this->request->params['named'] + $params);
				}
			}
		}

		$this->render();
	}
	
	public function listShifts() {
		$shiftOptions = array();
		if (isset($this->request->query['date'])) {
			$shiftOptions = array_merge($shiftOptions, array('Shift.date' => $this->request->query['date']));
		}
		if (isset($this->request->query['id'])) {
			$shiftOptions = array_merge($shiftOptions, array('Shift.user_id' => $this->request->query['id']));
		}
		else {
			$shiftOptions = array_merge($shiftOptions, array('Shift.user_id' => $this->_usersId()));
			$this->set('usersId', $this->_usersId());
		}
		$this->set('shiftList', $this->Shift->getShiftList(array($shiftOptions)));
		$this->set('_serialize', array('shiftList'));
	}
	
}
?>
