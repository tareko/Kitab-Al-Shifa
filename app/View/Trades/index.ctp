<?php 
//Set variables for easier reading
$originator = array(
	0 => 'Pending your approval',
	1 => 'Awaiting response',
	2 => 'Completed',
	3 => 'Refused'
);

$recipient = array(
0 => 'Awaiting response from originator',
1 => 'Pending your approval',
2 => 'Accepted',
3 => 'Refused'
);

?>

	<h2><?php echo __('Trades you initiated');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Shift.date', 'Date');?></th>
			<th><?php echo $this->Paginator->sort('shift_id');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($tradesOriginator as $trade): ?>
	<tr>
		<td><?php echo h($trade['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo h($trade['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
		<td><?php echo $originator[h($trade['Trade']['status'])]; ?>&nbsp;</td>
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
	<h2><?php echo __('Trades offered to you');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('Trade.User.name', 'Offered by');?></th>
				<th><?php echo $this->Paginator->sort('Shift.date', 'Shift date');?></th>
				<th><?php echo $this->Paginator->sort('Trade.shift_id', 'Shift');?></th>
				<th><?php echo $this->Paginator->sort('status');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
	<?php foreach ($tradesRecipient as $trade): ?>
		<tr>
			<td><?php echo h($trade['Trade']['User']['name']); ?>&nbsp;</td>
			<td><?php echo h($trade['Trade']['Shift']['date']); ?>&nbsp;</td>
			<td><?php echo h($trade['Trade']['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
			<td><?php echo $recipient[h($trade['TradesDetail']['status'])]; ?>&nbsp;</td>
			<td class="actions">
			<?php if ($trade['Trade']['status'] == 1 && $trade['TradesDetail']['status'] == 1 && $usersId == $trade['TradesDetail']['user_id']) {?>
					<?php echo $this->Html->link(__('Accept'), array('controller' => 'tradesDetails', 'action' => 'accept', '?' => array('id' => $trade['TradesDetail']['id'], 'token' => $trade['TradesDetail']['token']))); ?>
					<?php echo $this->Html->link(__('Reject'), array('controller' => 'tradesDetails', 'action' => 'reject', '?' => array('id' => $trade['TradesDetail']['id'], 'token' => $trade['TradesDetail']['token']))); ?>
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