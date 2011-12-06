<div class="profile view">
<h2><?php  echo __('Profile');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($profile['User']['name'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middlename'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['middlename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hits'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['hits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message Last Sent'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['message_last_sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message Number Sent'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['message_number_sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avatar'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['avatar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avatarapproved'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['avatarapproved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approved'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['approved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmed'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['confirmed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastupdatedate'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['lastupdatedate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registeripaddr'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['registeripaddr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cbactivation'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cbactivation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Banned'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['banned']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Banneddate'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['banneddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unbanneddate'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['unbanneddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bannedby'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['bannedby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unbannedby'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['unbannedby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bannedreason'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['bannedreason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Acceptedterms'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['acceptedterms']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbviewtype'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['fbviewtype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbordering'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['fbordering']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fbsignature'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['fbsignature']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Positiond'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_positiond']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Sites'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_sites']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Undergrad'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_undergrad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Residency'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_residency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Connections'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['connections']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Univappt'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_univappt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Mdcert'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_mdcert']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Profint'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_profint']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Outint'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_outint']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Memmnt'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_memmnt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Phoneh'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_phoneh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Phonem'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_phonem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Phoneo'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_phoneo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Pager'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_pager']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Addrcity'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_addrcity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Addrpstcd'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_addrpstcd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Addrs1'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_addrs1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Addrs2'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_addrs2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cb Addrprov'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['cb_addrprov']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Formatname'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['formatname']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Profile'), array('action' => 'delete', $profile['Profile']['id']), null, __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Profile'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
