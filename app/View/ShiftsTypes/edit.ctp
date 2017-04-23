<div class="shiftsTypes form">
<?php echo $this->Form->create('ShiftsType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Shifts Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('shift_start');
		echo $this->Form->input('shift_end');
		echo $this->Form->input('comment');
		echo $this->Form->input('display_order', array('type' => 'decimal'));
		echo $this->Form->input('start_date');
		echo $this->Form->input('expiry_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ShiftsType.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ShiftsType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
