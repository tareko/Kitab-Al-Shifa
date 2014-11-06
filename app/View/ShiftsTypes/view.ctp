<div class="shiftsTypes view">
<h2><?php echo __('Shifts Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftsType['Location']['location'], array('controller' => 'locations', 'action' => 'view', $shiftsType['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Start'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['shift_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift End'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['shift_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Display Order'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['display_order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
			<?php echo h($shiftsType['ShiftsType']['expiry_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shifts Type'), array('action' => 'edit', $shiftsType['ShiftsType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shifts Type'), array('action' => 'delete', $shiftsType['ShiftsType']['id']), array(), __('Are you sure you want to delete # %s?', $shiftsType['ShiftsType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Shifts'); ?></h3>
	<?php if (!empty($shiftsType['Shift'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Shifts Type Id'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shiftsType['Shift'] as $shift): ?>
		<tr>
			<td><?php echo $shift['id']; ?></td>
			<td><?php echo $shift['user_id']; ?></td>
			<td><?php echo $shift['date']; ?></td>
			<td><?php echo $shift['shifts_type_id']; ?></td>
			<td><?php echo $shift['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shifts', 'action' => 'view', $shift['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shifts', 'action' => 'edit', $shift['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shifts', 'action' => 'delete', $shift['id']), array(), __('Are you sure you want to delete # %s?', $shift['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
