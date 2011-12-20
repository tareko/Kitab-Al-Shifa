<div class="calendars view">
<h2><?php  echo __('Calendar');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usergroups Id'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['usergroups_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calendar'), array('action' => 'edit', $calendar['Calendar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calendar'), array('action' => 'delete', $calendar['Calendar']['id']), null, __('Are you sure you want to delete # %s?', $calendar['Calendar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergroups'), array('controller' => 'usergroups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroup'), array('controller' => 'usergroups', 'action' => 'add')); ?> </li>
	</ul>
</div>
