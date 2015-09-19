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
	public $hasMany = array(
			'Shift',
			'Trade' => array(
					'className' => 'Trade',
					'foreignKey' => 'user_id'
					),
			'TradeSubmitted' => array(
					'className' => 'Trade',
					'foreignKey' => 'submitted_by',
			),
			'TradesDetail'
			);
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
				'rule' => array('notBlank'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'A password is required'
			)
		),
	);


	public function getList($conditions = array(), $full = NULL, $list = false) {
		$userList = array();
		if ($full) {
			$userFields = array('Profile.firstname', 'Profile.lastname', 'User.id');
			$userOrder = array('Profile.lastname ASC, Profile.firstname ASC');
		}
		else {
			$userFields = array('User.id', 'Profile.cb_displayname');
			$userOrder = array('Profile.cb_displayname ASC');
		}
		$users = $this->find('list', array(
			'contain' => array('Profile'),
			'fields' => $userFields,
			'order'=> $userOrder,
			'recursive' => 0,
			'conditions' => $conditions
		));

		if ($list == false) {
			foreach ($users as $id => $fullname) {
				$userList[$id]['User']['id'] = $id;
				if ($full) {
					foreach ($fullname as $firstname => $lastname) {
						$userList[$id]['Profile']['firstname'] = $firstname;
						$userList[$id]['Profile']['lastname'] = $lastname;
					}
				}
				else {
					$userList[$id]['Profile']['cb_displayname'] = $fullname;
				}
			}
		}
		else {
			if ($full) {
				foreach ($users as $id => $fullname) {
					foreach ($fullname as $firstname => $lastname) {
						$userList[$id] = $firstname . ' ' . $lastname;
					}
				}
			}
			else {
				$userList = $users;
			}
		}

		return $userList;
	}


 	public function getActiveUsersForGroup($group = null, $full = false, $conditions = array(), $list = false, $excludeShift = false) {
 		if (!isset($group)) {
 			throw new BadRequestException();
 		}
 		if ($full) {
 			$userFields = array('Profile.firstname', 'Profile.lastname');
 		}
 		else {
 			$userFields = array('Profile.cb_displayname');
 		}
 		$containArray = array('Profile' => array(
 				'fields' => $userFields
 		));

 		$conditions = array_merge(array('Usergroup.id' => $group, 'User.block' => 0), $conditions);

 		// Get list of active users for the group
 		$userList = $this->find('all', array(
 				'conditions' => $conditions,
 				'recursive' => '0',
 				'fields' => array_merge(array('User.id'), $userFields),
 				'order' => array('Profile.lastname' => 'ASC', 'Profile.firstname' => 'ASC', 'Profile.cb_displayname' => 'ASC'),
 				'joins' => array(
						array(
								'table' => 'jem5_user_usergroup_map',
								'alias' => 'UsersUsergroup',
								'type' => 'inner',
								'foreignKey' => false,
								'conditions'=> array('UsersUsergroup.user_id = User.id')
						),
						array(
								'table' => 'jem5_usergroups',
								'alias' => 'Usergroup',
								'type' => 'inner',
								'foreignKey' => false,
								'conditions'=> array('Usergroup.id = UsersUsergroup.group_id')
 						)
				),
 				'contain' => $containArray
			)
 		);

 		// If shifts are present, then exclude users working shifts during these times
 		if ($excludeShift == true) {
 			$userList = $this->excludeWorkingUsers($userList, $excludeShift);
 		}
 		
 		if ($list == true) {
 			$newUserList = array();
 			foreach ($userList as $user) {
 				if ($full == true) {
 					$newUserList[$user['User']['id']] = $user['Profile']['firstname'] . ' ' . $user['Profile']['lastname'];
 				}
 				else {
 					$newUserList[$user['User']['id']] = $user['Profile']['cb_displayname'];
 				}
 			}
 			$userList = $newUserList ;
 		}

 		return $userList;
 	}

 	/**
 	 * Get all of the groups for a user
 	 * 
 	 * @param unknown_type $user
 	 * @param unknown_type $conditions
 	 * @param unknown_type $list If true, will display as list (good for select). Otherwise, array.
 	 * @param unknown_type $tradeable Should only tradeable groups be displayed?
 	 * @throws BadRequestException
 	 */

	public function getGroupsForUser($user = null, $conditions = array(), $list = false, $tradeable = false) {
		if (!isset($user)) {
			throw new BadRequestException();
		}

		$conditions = array_merge(array('User.id' => $user), $conditions);

		$groupList = $this->find('first', array(
 				'conditions' => $conditions,
 				'recursive' => '-1',
 				'fields' => array('User.id'),
 				'contain' => array(
 						'Usergroup' => array(
								'id',
								'title',
								'Group.tradeable',
 						)
 				)
 		));

		// If $tradeable is true, then will exclude all groups that are not tradeable
		if ($tradeable == true) { $groupList['Usergroup'] = $this->returnTradeable($groupList); }
		
		/*
		 * Will display a list instead of a complete array, with array ([id] => [value])
		 * 
		 */
		if ($list == true) {
 			$newGroupList = array();
 			foreach ($groupList['Usergroup'] as $group) {
				$newGroupList[$group['id']] = $group['title'];
 			}
			$groupList = $newGroupList ;
 		}
 	
 		return $groupList;
 	}

 	/**
 	 * Function will query user's preferred communication method and return it
 	 * @param integer $toUser
 	 */
 	public function getCommunicationMethod($toUser) {
 		//FIX: Stubbed for now
 		return 'email';
 	}

 	public function getOhipNumber ($id = NULL) {
 		$data = $this->find('first', array(
 				'contain' => array(
 						'Profile' => array(
 								'fields' => array('cb_ohip'),
 						),
				),
 				'fields' => array('id', 'name'),
 				'conditions' => array('User.id' => $id)
 		));
 		return $data['Profile']['cb_ohip'];
 	}
 	
 	/**
 	 * Return tradeable group from array
 	 */
 	
 	public function returnTradeable($groupList = array()) {
 		$newGroupList = array();
 		foreach($groupList['Usergroup'] as $group) {
 			if (isset($group['Group']['tradeable']) && $group['Group']['tradeable'] == 1) {
 				$newGroupList[] = $group;
 			}
 		}
 		$conditionsUsergroup = array('tradeable' => 1);
 		return $newGroupList;
 	}
 	
 	/**
 	 * Exclude users working during the specified shifts
 	 */
 	
 	public function excludeWorkingUsers ($userList = array(), $excludeShift = false, $excludeTime = "08:00:00") {
		if ($excludeShift == false) {
			throw new BadRequestException();
		}

 		//Figure out which times need excluding
		$excludeDetail = $this->Shift->find('all', array(
				'conditions' => array('Shift.id' => $excludeShift),
				'recursive' => 0,
				'fields' => array(
						'date',
						'shifts_type_id',
						'user_id'),
				'contain' => array(
						'ShiftsType' => array(
								'fields' => array('ShiftsType.shift_start', 'ShiftsType.shift_end'),
						))));

		//Set times for the shift type start and exclude time
		$excludeTime = new DateTime($excludeTime);
		$excludeTime = "PT" . $excludeTime->format('H') . "H";
		
		$excludeStart = new DateTime($excludeDetail[0]['Shift']['date'] . " " . $excludeDetail[0]['ShiftsType']['shift_start']);
		$excludeStart->sub(new DateInterval($excludeTime)); 

		$excludeEnd = new DateTime($excludeDetail[0]['Shift']['date'] . " " . $excludeDetail[0]['ShiftsType']['shift_end']);
		$excludeEnd->add(new DateInterval($excludeTime));

		if ($excludeDetail[0]['ShiftsType']['shift_end'] < $excludeDetail[0]['ShiftsType']['shift_start']) {
			$excludeEnd->add(new DateInterval('P1D'));
		}


		// Get shifts for $userList
		
		$newUserList = array();
 		foreach ($userList as $user) {
 			$isworking = false;
 			$isworking = $this->Shift->find('all', array(
 					'recursive' => 1,
 					'contain' => array(
 							'ShiftsType' => array(
 									'fields' => array(
 											'id',
 											'shift_start',
 											'shift_end'))),
 					'fields' => array(
 							'id',
 							'shifts_type_id',
 							'date'),
 					'conditions' => array(
 							'Shift.user_id' => $user['User']['id'],
 							"OR" => array(
	 							array(
	 									'Shift.date >=' => $excludeStart->format('Y-m-d'),
	 									'Shift.date <=' => $excludeEnd->format('Y-m-d'),
	 									"OR" => array(
	 											'ShiftsType.shift_start >' => $excludeStart->format('H:i:s'),
	 											'ShiftsType.shift_end >' => $excludeStart->format('H:i:s')
	 									)),
	 							array(
	 									'Shift.date >=' => $excludeStart->format('Y-m-d'),
	 									'Shift.date <=' => $excludeEnd->format('Y-m-d'),
	 									"OR" => array(
	 											'ShiftsType.shift_start <' => $excludeEnd->format('H:i:s'),
	 											'ShiftsType.shift_end <' => $excludeEnd->format('H:i:s')
	 									)),
 							))));

 			
	 			// Check if shift is truly within the limits
	 			if (!empty($isworking)) {
	 				$working = false;
	 				foreach ($isworking as $isworkingShift) {
		 				// Declare proper variable and set as proper date time for start
		 				
		 				$start = new DateTime($isworkingShift['Shift']['date'] . " " . $isworkingShift['ShiftsType']['shift_start']);
		 				
		 				// Calculate proper end date and time
		 				$end = new DateTime($isworkingShift['Shift']['date'] . " " . $isworkingShift['ShiftsType']['shift_end']);
		 				
		 				if ($isworkingShift['ShiftsType']['shift_end'] < $isworkingShift['ShiftsType']['shift_start']) {
		 					$end->add(new DateInterval('P1D'));
		 				}
		 					
		 				// Assess more carefully whether shift falls in exclusion area
		 				if (($excludeEnd >= $start && $start >= $excludeStart) or ($excludeEnd >= $end && $end >= $excludeStart)) {
		 					$working = true;
		 				}
	 				}
	 				if ($working == false) { $newUserList[] = $user; }
	 			} 
 				if (empty($isworking)) {
 					$newUserList[] = $user;
 				}
 		}
 		
 		// Check userList against each shift

 		// Return new userList
 		return $newUserList ;
 	}
}
?>