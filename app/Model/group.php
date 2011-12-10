<?php
class Group extends AppModel {
	public $actsAs = array('Containable');
	public $hasOne = array('Usergroup');
}
?>