<div class="shiftsTypes form">
<?php echo $this->Form->create('ShiftsType');?>
	<fieldset>
		<legend><?php echo __('Add Shifts Type'); ?></legend>
	<?php
		echo $this->Form->input('location_id');
		echo $this->Form->input('shift_start');
		echo $this->Form->input('shift_end');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Shifts Types'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
