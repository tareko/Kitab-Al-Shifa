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

	function calculateX() {
		$this->loadModel('Shift');
		$shifts = $this->Shift->shiftsWorkedbyOhipNumber('10800');
		$seconds = $this->Shift->secondsWorkedbyOhipNumber('10800');
		$hours = $this->Shift->secondsToHours($seconds);
		$X = $this->Accounting->calculateX($shifts);
		$this->set(compact('seconds', 'hours', 'X'));
		$this->render();
	}

}
