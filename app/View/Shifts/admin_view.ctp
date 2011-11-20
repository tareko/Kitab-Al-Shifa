<div class="shifts view">
<h2><?php  echo __('Shift');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Physician'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shift['Physician']['physician_name'], array('controller' => 'physicians', 'action' => 'view', $shift['Physician']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shifts Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shift['ShiftsType']['description'], array('controller' => 'shifts_types', 'action' => 'view', $shift['ShiftsType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shift'), array('action' => 'edit', $shift['Shift']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shift'), array('action' => 'delete', $shift['Shift']['id']), null, __('Are you sure you want to delete # %s?', $shift['Shift']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Physicians'), array('controller' => 'physicians', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Physician'), array('controller' => 'physicians', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('controller' => 'shifts_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('controller' => 'shifts_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
