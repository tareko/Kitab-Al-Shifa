<?php echo $this->Form->create('Preference');?>
	<fieldset>
		<legend><?php echo __('Minimum number of shifts for '. $user['User']['name']);?></legend>
	<?php
		//Foreach calendar from one month ago
		foreach($calendars as $calendarId => $calendarName) {
			// Create input for trading limit
			echo $this->Form->input('limit' . $calendarId, array(
			'default' => (isset($preference['limit' . $calendarId]) ? $preference['limit' . $calendarId]: false),
			'label' => $calendarName
			));
			echo "<br/>";
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
