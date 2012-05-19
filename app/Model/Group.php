<?php
class Group extends AppModel {
	public $actsAs = array('Containable');
	public $belongsTo = array(
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