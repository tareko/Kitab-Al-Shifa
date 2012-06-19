	<h2><?php echo __('Pending Trades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Shift.date');?></th>
			<th><?php echo $this->Paginator->sort('shift_id');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('user_status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($pending_trades as $trade): ?>
	<tr>
		<td><?php echo h($trade['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo h($trade['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['status']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['user_status']); ?>&nbsp;</td>
		<td class="actions">
		<?php if ($trade['Trade']['status'] == 0 && $trade['Trade']['user_status'] == 1 && $usersId == $trade['Trade']['user_id']) {?>
				<?php echo $this->Html->link(__('Accept'), array('action' => 'accept', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token']))); ?>
				<?php echo $this->Html->link(__('Reject'), array('action' => 'reject', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token']))); ?>
		<?php }?>
		&nbsp;
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

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<br /><br />

	<h2><?php echo __('Completed Trades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Shift.date');?></th>
			<th><?php echo $this->Paginator->sort('shift_id');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('user_status');?></th>
	</tr>
	<?php
	foreach ($completed_trades as $trade): ?>
	<tr>
		<td><?php echo h($trade['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo h($trade['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['status']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['user_status']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>