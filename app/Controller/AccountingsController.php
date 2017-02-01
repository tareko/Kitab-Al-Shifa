<?php
App::uses('AppController', 'Controller');
/**
 * Accountings Controller
 *
 */
class AccountingsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	function calculateHours() {
		$this->loadModel('Shift');

		$startDate = '2017-01-31';
		$endDate = '2017-01-31';

		$users = $this->Shift->usersWhoWorkedShifts($startDate, $endDate);

		$seconds = $this->Shift->secondsWorkedbyUser($users, $startDate, $endDate);
		$hours = array();
		foreach($seconds as $i => $second) {
			$hours[$i] = $this->Shift->secondsToHours($second);
		}
		$this->set(compact('seconds', 'hours', 'users'));
		$this->render();
	}

}
