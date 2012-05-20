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

		foreach ($userList as $id => $fullname) {
			foreach ($fullname as $firstname => $lastname) {
				$userList[$id]['id'] = $id;
				if ($full) {
					$userList[$id]['Profile']['firstname'] = $firstname;
					$userList[$id]['Profile']['lastname'] = $lastname;
				}
				else {
					$userList[$id]['Profile']['cb_displayname'] = $fullname;
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
 		$conditions = array_merge(array('Usergroup.id' => $group), $conditions);

 		$this->Usergroup->bindModel(array(
 				'hasAndBelongsToMany' => array(
 						'User' => array(
 								'joinTable'				=> 'user_usergroup_map',
								'className'				=> 'User',
								'foreignKey'			=> 'group_id',
								'associationForeignKey'	=> 'user_id',
 								)
 				)));
 			
 		$users = $this->Usergroup->find('all', array(
 				'conditions' => $conditions, 
 				'recursive' => '0',
 				'fields' => array('Usergroup.id', 'Usergroup.title'),
 				'recursive' => '2',
 				'contain' => array(
 						'User' => array(
 								'fields' => array('User.id', 'User.block'),
 								'Profile' => array(
 										'fields' => $userFields
 								)
 						)
 				)
 		));

 		$userListNoSort = array_shift(array_slice(array_shift($users), 1));
		$values = array();
		foreach ($userListNoSort as $id => $value) {
			if ($full) {
				$values[$id] = isset($value['Profile']['lastname']) ? $value['Profile']['lastname'] : '';
			}
			else {
				$values[$id] = isset($value['Profile']['cb_displayname']) ? $value['Profile']['cb_displayname'] : '';
			}
		}
		asort($values);
		foreach ($values as $key => $value) {
			$userList[$key] = $userListNoSort[$key];
		}
 		return $userList;
 	}
}
?>