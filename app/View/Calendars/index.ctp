<div class="calendars index">
	<h2><?php echo __('Calendars');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('usergroups_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('start_date');?></th>
			<th><?php echo $this->Paginator->sort('end_date');?></th>
			<th><?php echo $this->Paginator->sort('published');?></th>
			<th><?php echo $this->Paginator->sort('comments');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($calendars as $calendar): ?>
	<tr>
		<td><?php echo h($calendar['Calendar']['id']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['usergroups_id']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['name']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['published']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['comments']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $calendar['Calendar']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calendar['Calendar']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calendar['Calendar']['id']), null, __('Are you sure you want to delete # %s?', $calendar['Calendar']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Calendar'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Usergroups'), array('controller' => 'usergroups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroup'), array('controller' => 'usergroups', 'action' => 'add')); ?> </li>
	</ul>
</div>
