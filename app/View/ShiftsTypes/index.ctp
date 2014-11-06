<div class="shiftsTypes index">
	<h2><?php echo __('Shifts Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_start'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_end'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('display_order'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($shiftsTypes as $shiftsType): ?>
	<tr>
		<td><?php echo h($shiftsType['ShiftsType']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($shiftsType['Location']['location'], array('controller' => 'locations', 'action' => 'view', $shiftsType['Location']['id'])); ?>
		</td>
		<td><?php echo h($shiftsType['ShiftsType']['shift_start']); ?>&nbsp;</td>
		<td><?php echo h($shiftsType['ShiftsType']['shift_end']); ?>&nbsp;</td>
		<td><?php echo h($shiftsType['ShiftsType']['comment']); ?>&nbsp;</td>
		<td><?php echo h($shiftsType['ShiftsType']['display_order']); ?>&nbsp;</td>
		<td><?php echo h($shiftsType['ShiftsType']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($shiftsType['ShiftsType']['expiry_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shiftsType['ShiftsType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shiftsType['ShiftsType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shiftsType['ShiftsType']['id']), array(), __('Are you sure you want to delete # %s?', $shiftsType['ShiftsType']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<?php echo $this->Paginator->pagination(array(
		'ul' => 'pagination'
	)); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Hide expired shift types'), array('hideExpired' => '1')); ?> </li>
	</ul>
</div>
