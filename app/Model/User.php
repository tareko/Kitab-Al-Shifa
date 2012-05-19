<?php
class User extends AppModel
{
	public $actsAs = array('Containable');
	public $useDbConfig = 'joomla';
	public $useTable = 'users';
 	public $hasOne = array(
			'Profile' => array(
				'className' => 'Profile',
				'foreignKey' => 'id',
				'conditions' => '',
				'fields' => array('cb_displayname', 'firstname', 'lastname'),
				'order' => '')
	);
	public $hasMany = array('Shifts');
	public $hasAndBelongsToMany = array(
		'Usergroup' =>
			array(
				'className'				=> 'Usergroup',
				'joinTable'				=> 'user_usergroup_map',
				'foreignKey'			=> 'user_id',
				'associationForeignKey'	=> 'group_id',
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
	var $displayField = 'name';
	public $order = array('block' => 'ASC');

	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
	);

	
	public function getList($conditions = array(), $full = NULL) {
		if ($full) {
			$userFields = array('Profile.firstname', 'Profile.lastname', 'User.id');
			$userOrder = array('Profile.lastname ASC, Profile.firstname ASC');
		}
		else {
			$userFields = array('User.id', 'Profile.cb_displayname');
			$userOrder = array('Profile.cb_displayname ASC');
		}
		$userList = $this->find('list', array(
			'contain' => array('Profile'),
			'fields' => $userFields,
			'order'=> $userOrder,
			'recursive' => 0,
			'conditions' => $conditions
		));

		if ($full) {
			foreach ($userList as $id => $fullname) {
				foreach ($fullname as $firstname => $lastname) {
					$userList[$id] = $firstname . ' ' . $lastname;
				}
			}
		}
		return $userList;
	}

 	public function getActiveUsersForGroup($group, $full = null, $conditions = array()) {
 		if ($full) {
 			$userFields = array('Profile.firstname', 'Profile.lastname');
 		}
 		else {
 			$userFields = array('Profile.cb_displayname');
 		}
 		$conditions = array('Usergroup.id' => $group, 'User.block' => '0');
 		 	
		$userList = $this->find('list', array(
				'conditions' => $conditions,
				'contain' => array(
						'Profile' => array('fields' => $userFields),
						'Usergroup'),
				'recursive' => '2'));
		return $userList;
 	}
}
?>