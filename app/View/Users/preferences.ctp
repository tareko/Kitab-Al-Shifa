<?php echo $this->Form->create('Preference');?>
	<fieldset>
		<legend><?php echo __('Shift preferences for '. $user['User']['name']);?></legend>
	<?php
		echo $this->Form->input('limit', array('default' => (isset($preference['limit']) ? $preference['limit']: false)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
