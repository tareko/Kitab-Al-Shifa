<div class="profile index">
	<h2><?php echo __('Profile');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('firstname');?></th>
			<th><?php echo $this->Paginator->sort('middlename');?></th>
			<th><?php echo $this->Paginator->sort('lastname');?></th>
			<th><?php echo $this->Paginator->sort('hits');?></th>
			<th><?php echo $this->Paginator->sort('message_last_sent');?></th>
			<th><?php echo $this->Paginator->sort('message_number_sent');?></th>
			<th><?php echo $this->Paginator->sort('avatar');?></th>
			<th><?php echo $this->Paginator->sort('avatarapproved');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('confirmed');?></th>
			<th><?php echo $this->Paginator->sort('lastupdatedate');?></th>
			<th><?php echo $this->Paginator->sort('registeripaddr');?></th>
			<th><?php echo $this->Paginator->sort('cbactivation');?></th>
			<th><?php echo $this->Paginator->sort('banned');?></th>
			<th><?php echo $this->Paginator->sort('banneddate');?></th>
			<th><?php echo $this->Paginator->sort('unbanneddate');?></th>
			<th><?php echo $this->Paginator->sort('bannedby');?></th>
			<th><?php echo $this->Paginator->sort('unbannedby');?></th>
			<th><?php echo $this->Paginator->sort('bannedreason');?></th>
			<th><?php echo $this->Paginator->sort('acceptedterms');?></th>
			<th><?php echo $this->Paginator->sort('fbviewtype');?></th>
			<th><?php echo $this->Paginator->sort('fbordering');?></th>
			<th><?php echo $this->Paginator->sort('fbsignature');?></th>
			<th><?php echo $this->Paginator->sort('cb_positiond');?></th>
			<th><?php echo $this->Paginator->sort('cb_sites');?></th>
			<th><?php echo $this->Paginator->sort('cb_undergrad');?></th>
			<th><?php echo $this->Paginator->sort('cb_residency');?></th>
			<th><?php echo $this->Paginator->sort('connections');?></th>
			<th><?php echo $this->Paginator->sort('cb_univappt');?></th>
			<th><?php echo $this->Paginator->sort('cb_mdcert');?></th>
			<th><?php echo $this->Paginator->sort('cb_profint');?></th>
			<th><?php echo $this->Paginator->sort('cb_outint');?></th>
			<th><?php echo $this->Paginator->sort('cb_memmnt');?></th>
			<th><?php echo $this->Paginator->sort('cb_phoneh');?></th>
			<th><?php echo $this->Paginator->sort('cb_phonem');?></th>
			<th><?php echo $this->Paginator->sort('cb_phoneo');?></th>
			<th><?php echo $this->Paginator->sort('cb_pager');?></th>
			<th><?php echo $this->Paginator->sort('cb_addrcity');?></th>
			<th><?php echo $this->Paginator->sort('cb_addrpstcd');?></th>
			<th><?php echo $this->Paginator->sort('cb_addrs1');?></th>
			<th><?php echo $this->Paginator->sort('cb_addrs2');?></th>
			<th><?php echo $this->Paginator->sort('cb_addrprov');?></th>
			<th><?php echo $this->Paginator->sort('formatname');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($profiles as $profile): ?>
	<tr>
		<td><?php echo h($profile['Profile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($profile['User']['name'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
		</td>
		<td><?php echo h($profile['Profile']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['middlename']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['lastname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['hits']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['message_last_sent']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['message_number_sent']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['avatar']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['avatarapproved']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['approved']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['confirmed']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['lastupdatedate']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['registeripaddr']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cbactivation']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['banned']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['banneddate']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['unbanneddate']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['bannedby']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['unbannedby']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['bannedreason']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['acceptedterms']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['fbviewtype']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['fbordering']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['fbsignature']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_positiond']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_sites']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_undergrad']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_residency']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['connections']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_univappt']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_mdcert']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_profint']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_outint']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_memmnt']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_phoneh']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_phonem']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_phoneo']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_pager']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_addrcity']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_addrpstcd']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_addrs1']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_addrs2']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['cb_addrprov']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['formatname']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $profile['Profile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $profile['Profile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $profile['Profile']['id']), null, __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?>
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
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
