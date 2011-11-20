<?php
class Physician extends AppModel
{
	var $hasMany = array('Shifts');
	var $displayField = 'physician_name';
	public $order = array("physician_name" => "ASC");
}
?>