<div class="shifts form">
<?php echo $this->Form->create('Shift');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Shift'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('physician_id');
		echo $this->Form->input('date');
		echo $this->Form->input('shifts_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Shift.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Shift.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Physicians'), array('controller' => 'physicians', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Physician'), array('controller' => 'physicians', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('controller' => 'shifts_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('controller' => 'shifts_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
