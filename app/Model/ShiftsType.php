<?php
class ShiftsType extends AppModel
{
	public $actsAs = array('Containable');
	var $displayField = 'description';
	public $hasMany = 'Shift';
	public $belongsTo = array(
			'Location' => array(
					'classname' => 'Location',
					'foreignKey' => 'location_id'));
	var $virtualFields = array(
		'times' => 'CONCAT(DATE_FORMAT(ShiftsType.shift_start,"%H"), "-", DATE_FORMAT(ShiftsType.shift_end, "%H"), " ", ShiftsType.comment)',
		'description' => 'CONCAT(ShiftsType.location_id, " - ", DATE_FORMAT(ShiftsType.shift_start,"%H%i"), " - ", DATE_FORMAT(ShiftsType.shift_end, "%H%i"), ShiftsType.comment)'
		);
	var $order = array("ShiftsType.location_id" => "ASC", "ShiftsType.shift_start" => "ASC", "ShiftsType.shift_end" => "ASC");
}
?>