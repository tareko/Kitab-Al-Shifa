<?= $this->Form->create('Trade');?>

<fieldset>
	<legend><?php echo __('Compare schedules'); ?></legend>
	<div class="block">
		<label><?=__('Select all physicians whose schedules you\'d like to see')?></label>
		<?php 
		echo $this->Html->div('User.id',
			$this->PhysicianPicker->makePhysicianPicker(null, 'data[User]'),
				array('div' => 'pick-doctor'));
		?>
	</div>

	<label>Calendar to show</label>
	<?php 
		echo $this->Form->input('Calendar.id', array(
				'required' => true,
				'label' => false,
				'options' => $calendars));
	?>

	<div class="block">
		<?php echo $this->Form->end(__('Submit'));?>
	</div>

</fieldset>
<?echo $this->Js->writeBuffer();?>