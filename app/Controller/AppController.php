<?php

class AppController extends Controller {
	var $components = array('Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authError' => 'Please login to view this page',
			'loginError' => 'Incorrect username and/or password',
			'logoutRedirect' => array('controller' => '/'),
		)
	);
	
	function beforeFilter() {
//		$this->Auth->allow('display', 'home', 'index', 'view', 'login');
		$this->Auth->allow('createPdf', 'viewIcs');
		
		$this->set('admin', $this->_isAdmin());
		$this->set('logged_in', $this->_loggedIn());
		$this->set('users_username', $this->_usersUsername());
	}
	
	function _isAdmin() {
		$admin = FALSE;
		if ($this->Auth->user('roles') == 'admin') {
			$admin = TRUE;
		}
		return $admin;
	}
	
	function _loggedIn() {
		$logged_in = FALSE;
		if ($this->Auth->user()) {
			$logged_in = TRUE;
		}
		return $logged_in;
	}
	
	function _usersUsername() {
		$users_username = NULL;
		if ($this->Auth->user()) {
			$usersUsername = $this->Auth->user('username');
		}
	}
	
	function password($data) {
		if (isset($data['User']['password'])) {
			//Get the user to get the salt
			$user = $this->User->findByUsername($data['User']['username']);
				
			//Get the salt from the database. Assumed to be in the format of <pass>:<salt>
			$parts = explode(':', $user['User']['password']);
			$salt = $parts[1];
			$data['User']['password'] = md5($data['User']['password'] . $salt) . ':' . $salt;
			print_r($data);
			return $data;
		}
		return $data;
	}
	protected function findUser($username, $password) {
		$userModel = $this->settings['userModel'];
	
		list($plugin, $model) = pluginSplit($userModel);
		$fields = $this->settings['fields'];
	
		$user = ClassRegistry::init($userModel)->findByUsername($username);
		$parts = explode(':', $user['User']['password']);
		$salt = $parts[1];
	
		$conditions = array(
		$model . '.' . $fields['username'] => $username,
		$model . '.' . $fields['password'] => md5($password . $salt) . ':' . $salt,
		);
		if (!empty($this->settings['scope'])) {
			$conditions = array_merge($conditions, $this->settings['scope']);
		}
		$result = ClassRegistry::init($userModel)->find('first', array(
			'conditions' => $conditions,
			'recursive' => 0
		));
		if (empty($result) || empty($result[$model])) {
			return false;
		}
		unset($result[$model][$fields['password']]);
		return $result[$model];
	}
	
}
?>