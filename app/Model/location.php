<?php
class Location extends AppModel
{
	var $hasMany = 'ShiftsTypes';
	var $displayField = 'location';
}
?>