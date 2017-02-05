<?php
App::uses('AppController', 'Controller');
/**
 * Accountings Controller
 *
 */
class AccountingsController extends AppController {
	var $components = array('RequestHandler');
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	function calculateHours() {
		$this->loadModel('Shift');
		$this->loadModel('Location');

		$startDate = '2016-12-31';
		$endDate = '2016-12-31';

		$users = $this->Shift->usersWhoWorkedShifts($startDate, $endDate);

		$seconds = $this->Shift->secondsWorkedbyUser($users, $startDate, $endDate);
		$hours = array();
		foreach($seconds as $i => $second) {
			$hours[$i] = $this->Shift->secondsToHours($second);
		}

		$locations =$this->Location->find('all', array(
				'recursive' => -1
		));
		$locationsArray = array();

		foreach ($locations as $location) {
			$locationsArray[$location['Location']['id']] = $location['Location']['location'];
		}
		$locations = $locationsArray;

		$this->set(compact('seconds', 'hours', 'users', 'locations'));
		$this->render();
	}

}
