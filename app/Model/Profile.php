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
	public $tablePrefix = 'jem5_';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);
	public $hasMany = array(
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'user_id',
		),
			//Not working
		'Billing' => array(
			'className' => 'Billing',
			'foreignKey' => 'healthcare_provider',
			'associationForeignKey'  => 'cb_ohip',
		)
	);
	var $virtualFields = array('fullname' => 'CONCAT(Profile.firstname, " ", Profile.lastname)');

}
