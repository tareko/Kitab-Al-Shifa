<?php
class Usergroup extends AppModel
{
	public $actsAs = array('Containable');
	public $useDbConfig = 'joomla';
	public $useTable = 'usergroups';
	public $displayField = 'title';
	public $hasOne = array(
			'Group' => array(
				'className' => 'Group',
				'foreignKey' => 'usergroups_id',
			)
	);
	public $hasAndBelongsToMany = array(
		'User' =>
			array(
				'className'				=> 'User',
				'joinTable'				=> 'user_usergroup_map',
				'foreignKey'			=> 'group_id',
				'associationForeignKey'	=> 'user_id',
				'unique'				=> true,
				'conditions'			=> '',
				'fields'				=> '',
				'order'					=> '',
				'limit'					=> '',
				'offset'				=> '',
				'finderQuery'			=> '',
				'deleteQuery'			=> '',
				'insertQuery'			=> ''
			)
	);

	public $validate = array(
		'usergroups_id' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must enter a usergroup'
			)
		),
		'acl' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter permissions for this group'
			)
		),
	);
}
?>