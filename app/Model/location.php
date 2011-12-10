<?php
class Location extends AppModel
{
	var $hasMany = 'ShiftsTypes';
	var $displayField = 'location';

	/**
	* Function to get a list of locations
	*
	* @return mixed An array of location id's and abbreviated names.
	*/
	function getLocations() {
		$locations_raw = $this->find('all', array(
							'fields' => array('Location.id', 'Location.location', 'Location.abbreviated_name'),
							'recursive' => '0'
		));
	
		foreach ($locations_raw as $location) {
			$locationSet[$location['Location']['id']]['location'] = $location['Location']['location'];
			$locationSet[$location['Location']['id']]['abbreviated_name'] = $location['Location']['abbreviated_name'];
		}
		return $locationSet;
	}
}
?>