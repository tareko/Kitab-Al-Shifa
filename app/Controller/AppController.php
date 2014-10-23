<?php

class AppController extends Controller {
	public $uses = array('User', 'Usergroup', 'Group');

 	var $components = array('Session',
 		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authError' => 'Please login to view this page',
			'loginError' => 'Incorrect username and/or password',
			'logoutRedirect' => array('controller' => '/'),
			'flash' => array(
					'element' => 'alert',
 					'key' => 'auth',
 					'params' => array(
 							'class' => 'alert-danger'
 					)
 			)
 		),
//		'DebugKit.Toolbar'
	);
 	
 	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	function beforeFilter() {
		$this->set('admin', $this->_isAdmin());
		$this->set('logged_in', $this->_loggedIn());
		$this->set('users_username', $this->_usersUsername());
		$this->set('users_id', $this->_usersId());
		$this->_defaultPermissions();

  		if (!$this->_requestAllowed($this->name, $this->action, $this->_getAclRules($this->_usersId()))) {
  			$this->Session->setFlash('Access denied. You do not have permission to access this page');
			header('HTTP/1.1 401 Unauthorized');
			$this->viewPath = 'Errors';
			$this->render('permission_denied');
		}
	}

	/**
	 * requestAllowed
	 * Checks to see if the user is allowed to access this property.
	 * Based on http://debuggable.com/posts/a-lightweight-approach-to-acl-the-33-lines-of-magic
	 *
	 * @param string $object
	 * @param string $property
	 * @param string $rules
	 * @param boolean $default True or false
	 * @return boolean Returns true or false
	 */
	function _requestAllowed($object, $property, $rules, $default = FALSE) {
		// The default value to return if no rule matching $object/$property can be found
		$allowed = $default;

		if (!isset($rules) || $rules == '') {
			$rules = $this->Group->find('first', array(
		         'conditions' => array('Group.usergroups_id' => 0),
		         'fields' => 'acl'
			));
			$rules = $rules['Group']['acl'];
		}

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
			else {
				$negativeCondition = false;
			}

			if (preg_match('/^'.$allowedObject.'$/i', $object) &&
			preg_match('/^'.$allowedProperty.'$/i', $property))
			{
				if ($negativeCondition == true) {
					$allowed = false;
				}
				else {
					$allowed = true;
				}
			}
		}
		return $allowed;
	}

	function _getAclRules($userId) {
		$acl = NULL;

		$rulesRaw = $this->User->find('all',
		array(
	  		'contain' => array(
				'Usergroup' => array('Group.acl')
				),
			'conditions' => array(
				'id' => $userId
				),
			)
		);

		foreach ($rulesRaw as $rule) {
			$Usergroups = Set::sort($rule['Usergroup'], '{n}.lft', 'asc');
			foreach ($Usergroups as $Usergroup) {
				if (isset($Usergroup['Group']['acl']) && $Usergroup['Group']['acl'] != '') {
					$acl .= $Usergroup['Group']['acl'] . ',';
				}
			}
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

	/**
	 * _defaultPermissions method
	 * Set the default permissions for the Auth component based on the usergroup 0
	 *
	 */
	function _defaultPermissions() {
		$rulesRaw = $this->Group->find('first', array(
						   'conditions' => array('Group.usergroups_id' => 0),
						   'fields' => 'acl'
			));
		$rules = $rulesRaw['Group']['acl'];
		preg_match_all('/([^:,]+):([^,:]+)/is', $rules, $matches, PREG_SET_ORDER);
		$permitted = array();
		foreach ($matches as $match)
		{
			list($rawMatch, $allowedObject, $allowedProperty) = $match;
			$permitted[] = $allowedProperty;
		}
		$this->Auth->allow($permitted);
	}
}
?>