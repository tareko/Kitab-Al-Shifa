<?php
/**
 * Calendar Model
 *
 * @property Group $Group
 */
class Calendar extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $order = array('start_date' => 'DESC');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'usergroups_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter a calendar name',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'published' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usergroup' => array(
			'className' => 'Usergroup',
			'foreignKey' => 'usergroups_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * Get list of calendars
	 */
	function getList() {
		return $this->find('list', array(
			'fields' => array('Calendar.start_date', 'Calendar.name', 'Calendar.id'),
			'order'=>array('Calendar.start_date DESC')));
	}
	/**
	 * Last update of a shift in the calendar
	 * @calendar int
	 */
	public function lastUpdated($id) {

		//Set up new Shift model only if not already set (fixes problems with testing)
		if(!$this->Shift) {
			App::uses('Shift', 'Model');
			$this->Shift = ClassRegistry::init('Shift');
		}
		$calendar = $this->findById($id, array(
				'start_date', 'end_date'));
		$lastUpdated = $this->Shift->find('first', array(
				'fields' => array('Shift.updated', 'Shift.date'),
				'conditions' => array(
						'Shift.date >=' => $calendar['Calendar']['start_date'],
						'Shift.date <=' => $calendar['Calendar']['end_date'],
				),
				'order' => array(
						'Shift.updated' => 'DESC',
				)
		));
		return $lastUpdated['Shift']['updated'];
	}

	/*
	 * Get start and end dates for calendar
	 */

	public function getStartEndDates ($id) {
		$data = $this->find('first', array(
				'recursive' => 0,
				'fields' => array('start_date', 'end_date'),
				'conditions' => array('Calendar.id' => $id)
		));
		return (!empty($data['Calendar']) ? $data['Calendar'] : false);
	}
}
?>