<?php
/**
 * Preference Fixture
 */
class PreferenceFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Preference');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'user_id' => '1',
			'field' => 'Profile.limit',
			'value' => '10'
		),
		array(
			'id' => '2',
			'user_id' => '2',
			'field' => 'Profile.limit',
			'value' => ''
		),
		array(
			'id' => '3',
			'user_id' => '3',
			'field' => 'Profile.limit',
			'value' => '8'
		),
		array(
			'id' => '4',
			'user_id' => '4',
			'field' => 'Profile.limit',
			'value' => ''
		),
		array(
			'id' => '5',
			'user_id' => '5',
			'field' => 'Profile.limit',
			'value' => 'Evening'
		),
	);

}
