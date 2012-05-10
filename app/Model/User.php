<?php
class User extends AppModel
{
	public $actsAs = array('Containable');
	public $useDbConfig = 'joomla';
	public $useTable = 'users';
	public $hasOne = array(
			'Profile' => array(
				'className' => 'Profile',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => array('cb_displayname', 'firstname', 'lastname'),
				'order' => '')
	);
	var $hasMany = array('Shifts');
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

	
	public function getList($conditions = '') {
		return $this->find('list', array(
			'contain' => array('Profile'),
			'fields' => array('User.id', 'Profile.cb_displayname'),
			'order'=>array('Profile.cb_displayname ASC'),
			'recursive' => 0,
			'conditions' => $conditions
		));
	}

 	public function getActiveUsersForGroup($group) {
		$rawInfo = $this->Usergroup->find('all', array(
			'conditions' => array (
				'Usergroup.id' => $group
			),
			'contain' => array(
				'User' => array('Profile.cb_displayname')
		)));

		foreach ($rawInfo as $users) {
			foreach ($users['User'] as $user) {
				if ($user['block'] == 0) {
					$userList[$user['id']] = $user['Profile']['cb_displayname'];
				}
			}
		}
		asort($userList);
		return $userList;
 	}

}

?>