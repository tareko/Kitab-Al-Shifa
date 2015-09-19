	<h2><?php echo __('My Trades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Trade.User.name', 'Offered by');?></th>
			<th><?php echo $this->Paginator->sort('Trade.TradesDetail.User.name', 'Offered to');?></th>
			<th><?php echo $this->Paginator->sort('Shift.date', 'Date');?></th>
			<th><?php echo $this->Paginator->sort('times', 'Time');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$alreadyDisplayed = array();
	foreach ($trades as $trade):
	// If trade has already been displayed, continue
	// Otherwise, add id to array
	if (in_array ($trade['Trade']['id'], $alreadyDisplayed)) { continue; }
	else { $alreadyDisplayed[] = $trade['Trade']['id']; }

	?>
	<tr>
		<td><?php
			//Highlight name if it's the user's
			echo ($trade['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
			echo h($trade['User']['name']);
			if ($admin) {
				if ($trade['Trade']['status'] == 0 && $trade['Trade']['user_status'] == 1) {
					echo " [" . $this->Html->link(__('Accept'), array('action' => 'accept', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token'])));
					echo "] [" .$this->Html->link(__('Reject'), array('action' => 'reject', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token']))) . "]";
				}

				echo " [". $this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'trades', 'edit', $trade['Trade']['id'])) . "]";
			}?>
			&nbsp;</span></td>
		<td><?php
			if (count($trade['TradesDetail']) > 1) {
				foreach ($trade['TradesDetail'] as $tradesDetail) {
					echo ($tradesDetail['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
					echo h($tradesDetail['User']['name']) . "<br/>";
					echo "</span>";
					if ($admin) {
						if ($trade['Trade']['status'] == 1 && $tradesDetail['status'] == 1) {
							echo " [" .$this->Html->link(__('Accept'), array('controller' => 'tradesDetails', 'action' => 'accept', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token'])));
							echo "] [".$this->Html->link(__('Reject'), array('controller' => 'tradesDetails', 'action' => 'reject', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token']))) . "]";
						}
						echo " [" .$this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'tradesDetails', 'edit', $trade['TradesDetail'][0]['id'])) . "]<br/>";
					}
				}
			}
			else {
				echo ($trade['TradesDetail'][0]['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
				echo h($trade['TradesDetail'][0]['User']['name']);
				echo "</span>";
				if ($admin) {
					if ($trade['Trade']['status'] == 1 && $trade['Trade']['user_status'] == 2 && $trade['TradesDetail'][0]['status'] == 1) {
						echo " [" .$this->Html->link(__('Accept'), array('controller' => 'tradesDetails', 'action' => 'accept', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token'])));
						echo "] [".$this->Html->link(__('Reject'), array('controller' => 'tradesDetails', 'action' => 'reject', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token']))) . "]";
					}
					echo " [" .$this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'tradesDetails', 'edit', $trade['TradesDetail'][0]['id'])) . "]";
				}
			}

			?>
			&nbsp;</td>
		<td><?php echo h($trade['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo h($trade['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
		<td><?php echo h($this->TradeStatus->TradeStatus($trade, $usersId)); ?>&nbsp;</td>
		<td class="actions">
		<?php if ($trade['Trade']['status'] == 0 && $trade['Trade']['user_status'] == 1 && $usersId == $trade['Trade']['user_id']) {?>
				<?php echo $this->Html->link(__('Accept'), array('action' => 'accept', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token']))); ?>
				<?php echo $this->Html->link(__('Reject'), array('action' => 'reject', '?' => array('id' => $trade['Trade']['id'], 'token' => $trade['Trade']['token']))); ?>
		<?php }

		if ($trade['Trade']['status'] == 1 && $trade['Trade']['user_status'] == 2 && $usersId == $trade['TradesDetail'][0]['user_id'] && $trade['TradesDetail'][0]['status'] == 1) {
			echo $this->Html->link(__('Accept'), array('controller' => 'tradesDetails', 'action' => 'accept', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token'])));
			echo $this->Html->link(__('Reject'), array('controller' => 'tradesDetails', 'action' => 'reject', '?' => array('id' => $trade['TradesDetail'][0]['id'], 'token' => $trade['TradesDetail'][0]['token'])));
		}
		?>
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

	<?php
		echo $this->Paginator->pagination(array(
			'ul' => 'pagination pagination-lg'));