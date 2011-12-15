<?php
class Group extends AppModel {
	public $actsAs = array('Containable');
	public $hasOne = array(
		'Usergroup' => array(
			'className'    => 'Usergroup',
			'foreignKey'   => 'id',
	));
//	var $displayField = 'title';
/* 	var $virtualFields = array(
			'title' => 'Usergroup.title'
	);
 */
}
?>