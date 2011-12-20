<div class="calendars form">
<?php echo $this->Form->create('Calendar');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Calendar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('usergroups_id');
		echo $this->Form->input('name');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('published');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Calendar.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Calendar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Calendars'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Usergroups'), array('controller' => 'usergroups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroup'), array('controller' => 'usergroups', 'action' => 'add')); ?> </li>
	</ul>
</div>
