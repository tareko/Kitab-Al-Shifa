<?php
App::uses('Sanitize', 'Utility');
App::uses('AppController', 'Controller');


class ShiftsController extends AppController {
	var $name = 'Shifts';
	var $components = array('RequestHandler', 'Search.Prg', 'Flash');
	var $scaffold = 'admin';
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

        // If the calendar is unpublished, only allow the user to see their own schedule,
        // unless user is an admin

        if(isset($calendar) && !$calendar['Calendar']['published'] && !$this->_isAdmin()) {
        	$this->set('shifts', $this->paginate(array(
        			'Shift.user_id' => $this->_usersId())
        			+ $conditions));
        }

        // Pull only the IDs entered
        elseif (isset($this->request->params['named']['id'])) {
        	$this->set('shifts', $this->paginate(array(
        			'Shift.user_id' => $this->request->params['named']['id'])
        			+ $conditions));
        }



        else {
        	$this->set('shifts', $this->paginate($conditions));
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
		$this->render();
	}

	function add() {
		$this->loadModel('Profile');
		# Check if there is form data to be processed
		$saved = false;

		if (!empty($this->data)){
			foreach ($this->data['Shift'] as $dataRaw) {
				if ($dataRaw['user_id'] != '') {
					$data['Shift'][] = $dataRaw;
					$saved = true;
				}
			}
			if ($saved == true) {
				if ($this->Shift->saveAll($data['Shift'])) {
					$this->Flash->success(__('Shift saved'));
				}
				else {
					$this->Flash->alert(__('Shift was not saved'));
				}
			}
		}

		# If no data, present an add form
		$this->set('scaffoldFields', array_keys($this->Shift->schema()));
		$this->set('users', $this->Shift->User->getList(NULL, NULL, true));

		$this->set('shiftsTypes', $this->Shift->ShiftsType->find('list', array(
				'fields' => array('ShiftsType.id', 'ShiftsType.times', 'Location.location'),
				'recursive' => '0')));
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
			return $this->redirect(array(
					'action' => 'calendarList',
					'?' => array(
							'calendar_action' => 'calendarEdit')));
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
		$this->render();
	}

	function calendarView() {
 		$this->Prg->commonProcess();
 		$this->loadModel('Calendar');

		if (!isset($this->request->params['named']['calendar'])) {
					return $this->redirect(array(
					'action' => 'calendarList',
					'?' => array(
							'calendar_action' => 'calendarView')));
		}

		$calendar = $this->request->params['named']['calendar'];

		// If the calendar is unpublished, only allow the user to see their own schedule,
		// unless user is an admin

		if(isset($calendar) && !$this->Calendar->findById($calendar)['Calendar']['published'] && !$this->_isAdmin()) {
			$id = $this->_usersId();
		}
		elseif(isset($this->request->params['named']['id'])) {
			$id = $this->request->params['named']['id'];
		}

		else {
			$id = null;
		}
		$masterSet = $this->Shift->getMasterSet($calendar, $id);

		$this->pdfConfig = array(
				'filename' => "EMA_Schedule-".$masterSet['calendar']['Calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf"
				);

		$this->set('calendars', $this->Calendar->find('list'));
		$this->set('masterSet', $masterSet);

		$this->render();
	}

	function icsView() {
		$masterSet = array();

		if (strlen(strstr($this->request->referer(), 'wizard'))>0) {
			$this->set('id', $this->request->params['named']['id']);
			return $this->render('ics_link');
		}

		if (isset($this->request->data['Shift'][0]['id'])) {
			$this->request->params['named']['id'] = $this->request->data['Shift'][0]['id'];
		}
		if (!isset($this->request->params['named']['id'])) {
			return $this->setAction('physicianList', 'icsView');
		}
		$shiftList = $this->Shift->getShiftList(
			array (
				'Shift.date >=' => date('Y-m-d', strtotime("-6 months")),
				'Shift.date <' => Configure::read('ics_date_limit'),
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
		$this->render();
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

		$this->Flash->warning(__('Please select a physician'));
		$this->set('physicianAction', $physicianAction);
		$this->set('physicians', $physicians);
		$this->render();
	}

	/**
	 * List of calendars
	 */
	public function calendarList($calendarAction = false) {
		$this->loadModel('Calendar');
		if (empty($this->request->query['calendar_action']) && !$calendarAction) {
			$this->set('failure', true);
			return $this->Flash->alert(__('No action has been chosen'));
		}
		$this->set('calendarAction', (!$calendarAction ? $this->request->query['calendar_action'] : $calendarAction));

		if (isset($this->request->params['named']['id'])) {
			$this->set('passed_id', $this->request->params['named']['id']);
		}
		$this->Flash->warning(__('Please select a calendar'));
		$this->set('calendars', $this->Calendar->getList());
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}
		$this->Shift->id = $id;
		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid Shift'));
		}
		if ($this->Shift->delete()) {
			$this->Flash->warning(__('Shift deleted'));
			return $this->redirect(array('action'=>'index'));
		}
		$this->Flash->alert(__('Shift was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function edit($id = null) {
		$this->Shift->id = $id;
		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid shift'));
		}
		if ($this->request->isPost() || $this->request->isPut()) {
			if ($this->Shift->save($this->request->data)) {
				$this->Flash->success(__('The shift has been saved'));
			} else {
				$this->Flash->alert(__('The shift could not be saved. Please, try again.'));
			}
		}
		$this->set('physicians', $this->Shift->User->getList(NULL, NULL, true));
		$this->set('shiftsTypes', $this->Shift->ShiftsType->find('list'));
		$this->set('Shift', $this->Shift->read());
		$this->request->data = $this->Shift->read(null, $id);
		$this->render();
	}

	// Marketplace change status
	public function marketplace($id = null, $status = null) {
		$this->Shift->id = $id;
		//TODO: User access restrictions

		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid shift'));
		}
		if ($id && isset($status)) {
			$this->Shift->set('marketplace', $status);
			if ($this->Shift->save()) {
//				$this->Flash->success(__('The shift has been saved'));
			} else {
				$this->Flash->alert(__('The shift could not be saved. Please, try again.'));
			}
		}
		return $this->redirect( $this->referer() );
	}

	function wizard() {
		$params = array();
		$this->loadModel('Calendar');
		$this->set('physicians', $this->User->getList(null, true, true));
		$this->set('calendars', $this->Calendar->find('list', array(
				'conditions' => array(
						'published' => 1,
						'end_date >=' => date('Y-m-d', strtotime("-2 months"))))));

		if (isset($this->request->data['Shift']['list'])) {
			if ($this->request->data['Shift']['list'] == 'all') {
				//No action needed
			}
			if ($this->request->data['Shift']['list'] == 'mine') {
				$this->request->params['named']['id'] = $this->_usersId();
			}

			$this->request->params['named']['calendar'] = $this->request->data['Shift']['calendar'];

			//TODO: Needs fixing so that the 'some users' category can be selected
			if ($this->request->data['Shift']['list'] == 'some') {
				$i = 0;
				foreach ($this->request->data['Shift'] as $users) {
					if (is_array($users)) {
						$this->request->params['named']['id['.$i.']'] = $users['id'];
						$i++;
					}
				}
			}


			if (isset($this->request->data['Shift']['output'])) {
				if ($this->request->data['Shift']['output'] == 'webcal') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'calendarView') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->data['Shift']['output'] == 'list') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'index') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->data['Shift']['output'] == 'print') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'calendarView', 'ext' => 'pdf') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->data['Shift']['output'] == 'ics') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'icsView') + $this->request->params['named'] + $params);
				}
				elseif ($this->request->data['Shift']['output'] == 'csv') {
					return $this->redirect(array('controller' => 'shifts', 'action' => 'calendarView', 'ext' => 'csv') + $this->request->params['named'] + $params);
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
		// Add date limit from configure
		$shiftOptions = array_merge($shiftOptions, array('Shift.date <' => Configure::read('trade_date_limit')));
		$this->set('shiftList', $this->Shift->getShiftList(array($shiftOptions)));
		$this->set('_serialize', array('shiftList'));
	}

	/*
	 * List calendars
	 */
	public function listCalendars() {
		$this->loadModel('Calendar');
		$conditions = array ();
		if (isset($this->request->query['end_date']) && $this->request->query['end_date'] == "current") {
			$conditions = array (
				'end_date >=' => date('Y-m-d', strtotime("-2 months")));
		}

		$this->set('calendars', $this->Calendar->find('all', array(
				'fields' => array(
						'id',
						'name',),
				'conditions' => $conditions)));
		$this->set('_serialize', array('calendars'));
	}

	/*
	 * Import shifts from CSV
	 */

	public function import() {
		$status = array();
		if ($this->request->isPost()) {
			$failure = false;

			// If asked to delete previous data from date, go ahead and delete
			if ($this->data['Shift']['delete'] == 1) {
				// Retrieve calendar dates
				$this->loadModel('Calendar');
				$calendar = $this->Calendar->getStartEndDates($this->data['Shift']['calendar']);

				// Delete shifts
				$this->Shift->deleteAll(array(
						'date >=' => $calendar['start_date'],
						'date <=' => $calendar['end_date']
						));
			}
			// Process data
			foreach ($this->data['Shift']['upload'] as $upload) {
				$data = $this->Shift->import($upload['tmp_name'], $this->data['Shift']['calendar']);
				if ($this->Shift->saveAll($data)) {
					$status[] = $upload['name'] ." saved successfully";
				}
				else {
					debug($this->Shift->validationErrors);
					$status[] = $upload['name'] ." failed to save";
					$failure = true;
				}
			}
			if ($failure == true) {
				$this->set(compact('status'));
				$this->Flash->alert('I\'m sorry. One or more files did not successfully import.');
			}
			else {
				$this->set(compact('status'));
				$this->Flash->success('Import successful.');
			}
		}

		$this->loadModel('Calendar');
		$this->set('calendars', $this->Calendar->find('list', array(
				'conditions' => array(
						'published' => 0,
						'end_date >=' => date('Y-m-d', strtotime("-2 months"))))));
		$this->set(compact('status'));
		$this->render();
	}
}
?>
