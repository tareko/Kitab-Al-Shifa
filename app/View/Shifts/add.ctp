<div class="shifts form">
<?php echo $this->Form->create('Shift');?>
	<fieldset>
		<legend><?php echo __('Add Shift'); ?></legend>
	<?php
		echo $this->Form->input('Shift.0.physician_id', array('empty' => true));
		echo $this->Form->input('Shift.0.date', array('empty' => true));
		echo $this->Form->input('Shift.0.shifts_type_id', array('empty' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Shifts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Physicians'), array('controller' => 'physicians', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Physician'), array('controller' => 'physicians', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('controller' => 'shifts_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('controller' => 'shifts_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
