<?php echo $this->Form->create('Preference');?>
	<fieldset>
		<legend><?php echo __('Minimum number of shifts for '. $user['User']['name']);?></legend>
	<?php
		//Foreach calendar from one month ago
		foreach($calendars as $calendarId => $calendarName) {
			// Create input for trading limit
			echo $this->Form->input($calendarId, array(
			'default' => (isset($preference[$calendarId]) ? $preference[$calendarId]: false),
			'label' => $calendarName
			));
			echo "<br/>";
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
