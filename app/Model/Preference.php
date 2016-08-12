<?php
class Preference extends AppModel 
{
    public $actsAs = array('Utils.Keyvalue');
    public $useTable = 'preferences';
    public $belongsTo = array(
    		'User' => array(
    				'className' => 'User',
    				'foreignKey' => 'user_id',
    				'conditions' => '',
    		));
    
    public $validate = array(
    		'user_id' => array(
    				'numeric' => array(
    						'rule' => array('numeric'),
    						'message' => 'Please select a proper user',
    						//'allowEmpty' => false,
    						//'required' => false,
    						//'last' => false, // Stop validation after this rule
    						//'on' => 'create', // Limit validation to 'create' or 'update' operations
    				),
    		),
    		'limit' => array(
    				'numeric' => array(
    						'rule' => array('numeric'),
    						'message' => 'Please select a proper user',
    						//'allowEmpty' => false,
    						//'required' => false,
    						//'last' => false, // Stop validation after this rule
    						//'on' => 'create', // Limit validation to 'create' or 'update' operations
    				),
    		));
}
?>