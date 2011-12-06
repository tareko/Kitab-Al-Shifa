<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usertype'); ?></dt>
		<dd>
			<?php echo h($user['User']['usertype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo h($user['User']['block']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SendEmail'); ?></dt>
		<dd>
			<?php echo h($user['User']['sendEmail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RegisterDate'); ?></dt>
		<dd>
			<?php echo h($user['User']['registerDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastvisitDate'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastvisitDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activation'); ?></dt>
		<dd>
			<?php echo h($user['User']['activation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Params'); ?></dt>
		<dd>
			<?php echo h($user['User']['params']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Profiles');?></h3>
	<?php if (!empty($user['Profile'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $user['Profile']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('User Id');?></dt>
		<dd>
	<?php echo $user['Profile']['user_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Firstname');?></dt>
		<dd>
	<?php echo $user['Profile']['firstname'];?>
&nbsp;</dd>
		<dt><?php echo __('Middlename');?></dt>
		<dd>
	<?php echo $user['Profile']['middlename'];?>
&nbsp;</dd>
		<dt><?php echo __('Lastname');?></dt>
		<dd>
	<?php echo $user['Profile']['lastname'];?>
&nbsp;</dd>
		<dt><?php echo __('Hits');?></dt>
		<dd>
	<?php echo $user['Profile']['hits'];?>
&nbsp;</dd>
		<dt><?php echo __('Message Last Sent');?></dt>
		<dd>
	<?php echo $user['Profile']['message_last_sent'];?>
&nbsp;</dd>
		<dt><?php echo __('Message Number Sent');?></dt>
		<dd>
	<?php echo $user['Profile']['message_number_sent'];?>
&nbsp;</dd>
		<dt><?php echo __('Avatar');?></dt>
		<dd>
	<?php echo $user['Profile']['avatar'];?>
&nbsp;</dd>
		<dt><?php echo __('Avatarapproved');?></dt>
		<dd>
	<?php echo $user['Profile']['avatarapproved'];?>
&nbsp;</dd>
		<dt><?php echo __('Approved');?></dt>
		<dd>
	<?php echo $user['Profile']['approved'];?>
&nbsp;</dd>
		<dt><?php echo __('Confirmed');?></dt>
		<dd>
	<?php echo $user['Profile']['confirmed'];?>
&nbsp;</dd>
		<dt><?php echo __('Lastupdatedate');?></dt>
		<dd>
	<?php echo $user['Profile']['lastupdatedate'];?>
&nbsp;</dd>
		<dt><?php echo __('Registeripaddr');?></dt>
		<dd>
	<?php echo $user['Profile']['registeripaddr'];?>
&nbsp;</dd>
		<dt><?php echo __('Cbactivation');?></dt>
		<dd>
	<?php echo $user['Profile']['cbactivation'];?>
&nbsp;</dd>
		<dt><?php echo __('Banned');?></dt>
		<dd>
	<?php echo $user['Profile']['banned'];?>
&nbsp;</dd>
		<dt><?php echo __('Banneddate');?></dt>
		<dd>
	<?php echo $user['Profile']['banneddate'];?>
&nbsp;</dd>
		<dt><?php echo __('Unbanneddate');?></dt>
		<dd>
	<?php echo $user['Profile']['unbanneddate'];?>
&nbsp;</dd>
		<dt><?php echo __('Bannedby');?></dt>
		<dd>
	<?php echo $user['Profile']['bannedby'];?>
&nbsp;</dd>
		<dt><?php echo __('Unbannedby');?></dt>
		<dd>
	<?php echo $user['Profile']['unbannedby'];?>
&nbsp;</dd>
		<dt><?php echo __('Bannedreason');?></dt>
		<dd>
	<?php echo $user['Profile']['bannedreason'];?>
&nbsp;</dd>
		<dt><?php echo __('Acceptedterms');?></dt>
		<dd>
	<?php echo $user['Profile']['acceptedterms'];?>
&nbsp;</dd>
		<dt><?php echo __('Fbviewtype');?></dt>
		<dd>
	<?php echo $user['Profile']['fbviewtype'];?>
&nbsp;</dd>
		<dt><?php echo __('Fbordering');?></dt>
		<dd>
	<?php echo $user['Profile']['fbordering'];?>
&nbsp;</dd>
		<dt><?php echo __('Fbsignature');?></dt>
		<dd>
	<?php echo $user['Profile']['fbsignature'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Positiond');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_positiond'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Sites');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_sites'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Undergrad');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_undergrad'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Residency');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_residency'];?>
&nbsp;</dd>
		<dt><?php echo __('Connections');?></dt>
		<dd>
	<?php echo $user['Profile']['connections'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Univappt');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_univappt'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Mdcert');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_mdcert'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Profint');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_profint'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Outint');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_outint'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Memmnt');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_memmnt'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Phoneh');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_phoneh'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Phonem');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_phonem'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Phoneo');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_phoneo'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Pager');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_pager'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Addrcity');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_addrcity'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Addrpstcd');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_addrpstcd'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Addrs1');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_addrs1'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Addrs2');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_addrs2'];?>
&nbsp;</dd>
		<dt><?php echo __('Cb Addrprov');?></dt>
		<dd>
	<?php echo $user['Profile']['cb_addrprov'];?>
&nbsp;</dd>
		<dt><?php echo __('Formatname');?></dt>
		<dd>
	<?php echo $user['Profile']['formatname'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'profiles', 'action' => 'edit', $user['Profile']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Shifts');?></h3>
	<?php if (!empty($user['Shifts'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Physician Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Shifts Type Id'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Shifts'] as $shifts): ?>
		<tr>
			<td><?php echo $shifts['id'];?></td>
			<td><?php echo $shifts['physician_id'];?></td>
			<td><?php echo $shifts['date'];?></td>
			<td><?php echo $shifts['shifts_type_id'];?></td>
			<td><?php echo $shifts['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shifts', 'action' => 'view', $shifts['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shifts', 'action' => 'edit', $shifts['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shifts', 'action' => 'delete', $shifts['id']), null, __('Are you sure you want to delete # %s?', $shifts['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shifts'), array('controller' => 'shifts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
