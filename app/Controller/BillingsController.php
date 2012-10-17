<?php 
App::uses('Sanitize', 'Utility');

class BillingsController extends AppController {
	var $name = 'Billings';
	var $components = array('RequestHandler', 'Search.Prg');
	var $helpers = array('Js', 'Cache', 'Html');


	function index() {
		$data = $this->Billing->import('HLAA3D.041');
		debug($data);
        $this->render();
	}
}
?>
