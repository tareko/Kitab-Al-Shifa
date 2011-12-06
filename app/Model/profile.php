<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 * @property User $User
 */
class Profile extends AppModel {
	public $actsAs = array('Containable');
	
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'joomla';
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'comprofiler';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasOne = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
