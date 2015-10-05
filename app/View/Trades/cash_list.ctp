	<h2><?php echo __('Cash Trades');?></h2>

	<p>
	<?php if(isset($this->request->query['archives']) && $this->request->query['archives'] == 1) {?>
			<a href="?archives=0">Show trades in past 3 months only</a>
	<?php } else {?>
			<a href="?archives=1">Show all archived trades</a>
	<?php }?>
	</p>
	<p><?= $this->Html->link('spreadsheet', array('ext' => 'csv', '?' => $this->request->query))
	?></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Trade.User.name', 'Offered by');?></th>
			<th><?php echo $this->Paginator->sort('Trade.TradesDetail.User.name', 'Taken by');?></th>
			<th><?php echo $this->Paginator->sort('Shift.date', 'Date');?></th>
			<th><?php echo $this->Paginator->sort('times', 'Time');?></th>
	</tr>
	<?php
	foreach ($trades as $trade):
	// If trade has already been displayed, continue
	// Otherwise, add id to array

	?>
	<tr>
		<td><?php
			//Highlight name if it's the user's
			echo ($trade['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
			echo h($trade['User']['name']);
			if ($admin) {
				echo " [". $this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'trades', 'edit', $trade['Trade']['id'])) . "]";
			}?>
			&nbsp;</span></td>
		<td><?php
			if (count($trade['TradesDetail']) > 1) {
				foreach ($trade['TradesDetail'] as $tradesDetail) {
					if ($tradesDetail['status'] == 2) {
						echo ($tradesDetail['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
						echo h($tradesDetail['User']['name']) . "<br/>";
						echo "</span>";
						if ($admin) {
							echo " [" .$this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'tradesDetails', 'edit', $trade['TradesDetail'][0]['id'])) . "]<br/>";
						}
					}
				}
			}
			else {
				echo ($trade['TradesDetail'][0]['User']['id'] == $usersId ? '<span class="highlight">': '<span>');
				echo h($trade['TradesDetail'][0]['User']['name']);
				echo "</span>";
				if ($admin) {
					echo " [" .$this->Html->link(__('Edit'), array('controller' => 'admin', 'action' => 'tradesDetails', 'edit', $trade['TradesDetail'][0]['id'])) . "]";
				}
			}

			?>
			&nbsp;</td>
		<td><?php echo h($trade['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo h($trade['Shift']['ShiftsType']['times']); ?>&nbsp;</td>
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