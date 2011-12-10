<?php

class AppController extends Controller {
	public $uses = array('User', 'Usergroup');

	var $components = array('Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authError' => 'Please login to view this page',
			'loginError' => 'Incorrect username and/or password',
			'logoutRedirect' => array('controller' => '/'),
		),
//		'DebugKit.Toolbar'
	);
	
	function beforeFilter() {
//		$this->Auth->allow('display', 'home', 'index', 'view', 'login');
		$this->Auth->allow('createPdf', 'viewIcs');
		
		$this->set('admin', $this->_isAdmin());
		$this->set('logged_in', $this->_loggedIn());
		$this->set('users_username', $this->_usersUsername());
		$this->set('users_id', $this->_usersId());
	}
	
	// Based on http://debuggable.com/posts/a-lightweight-approach-to-acl-the-33-lines-of-magic:480f4dd6-639c-44f4-a62a-49a8cbdd56cb
	
	function _requestAllowed($object, $property, $rules, $default = FALSE) {
		// The default value to return if no rule matching $object/$property can be found
		$allowed = $default;

		// This Regex converts a string of rules like "objectA:actionA,objectB:actionB,..." into the array $matches.
		preg_match_all('/([^:,]+):([^,:]+)/is', $rules, $matches, PREG_SET_ORDER);
		foreach ($matches as $match)
		{
			list($rawMatch, $allowedObject, $allowedProperty) = $match;
			 
			$allowedObject = str_replace('*', '.*', $allowedObject);
			$allowedProperty = str_replace('*', '.*', $allowedProperty);
			 
			if ($allowedObject{0}=='!')
			{
				$allowedObject = substr($allowedObject, 1);
				$negativeCondition = true;
			}
			else
			$negativeCondition = false;
			 
			if (preg_match('/^'.$allowedObject.'$/i', $object) &&
			preg_match('/^'.$allowedProperty.'$/i', $property))
			{
				if ($negativeCondition)
				$allowed = false;
				else
				$allowed = true;
			}
		}
		return $allowed;
	}

	function _getAclRules($userId) {
		$rulesRaw = $this->User->find('all',
		array(
				'contain' => array(
					'Usergroup' => array('Group')
				),
				'conditions' => array(
					'id' => $userId
				),
			)
		);

		$acl = NULL;
		foreach ($rulesRaw as $rule) {
			$Usergroups = Set::sort($rule['Usergroup'], '{n}.lft', 'asc');
			foreach ($Usergroups as $Usergroup) {
				if (isset($Usergroup['Group']['acl']) && $Usergroup['Group']['acl'] != '') {
					$acl .= $Usergroup['Group']['acl'] . ',';
				}
			}
				
			//$people = Set::sort($people, '{n}.Person.birth_date', 'desc');
		}
		return $acl;
	}
	
	
	function _isAdmin() {
		$admin = FALSE;
		if ($this->Auth->user()) {
			if ($this->_requestAllowed('admin', NULL , $this->_getAclRules($this->Auth->user('id')), $default = false)) {
				$admin = TRUE;
			}
		}
		return $admin;
	}
	
	// 
	function _loggedIn() {
		$logged_in = FALSE;
		if ($this->Auth->user()) {
			$logged_in = TRUE;
		}
		return $logged_in;
	}
	
	function _usersId() {
		$users_username = NULL;
		if ($this->Auth->user()) {
			return $usersId = $this->Auth->user('id');
		}
	}
	function _usersUsername() {
		$users_username = NULL;
		if ($this->Auth->user()) {
			return $this->Auth->user('username');
		}
	}	
}
?>