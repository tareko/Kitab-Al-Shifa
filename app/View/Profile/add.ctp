<div class="profile form">
<?php echo $this->Form->create('Profile');?>
	<fieldset>
		<legend><?php echo __('Add Profile'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('firstname');
		echo $this->Form->input('middlename');
		echo $this->Form->input('lastname');
		echo $this->Form->input('hits');
		echo $this->Form->input('message_last_sent');
		echo $this->Form->input('message_number_sent');
		echo $this->Form->input('avatar');
		echo $this->Form->input('avatarapproved');
		echo $this->Form->input('approved');
		echo $this->Form->input('confirmed');
		echo $this->Form->input('lastupdatedate');
		echo $this->Form->input('registeripaddr');
		echo $this->Form->input('cbactivation');
		echo $this->Form->input('banned');
		echo $this->Form->input('banneddate');
		echo $this->Form->input('unbanneddate');
		echo $this->Form->input('bannedby');
		echo $this->Form->input('unbannedby');
		echo $this->Form->input('bannedreason');
		echo $this->Form->input('acceptedterms');
		echo $this->Form->input('fbviewtype');
		echo $this->Form->input('fbordering');
		echo $this->Form->input('fbsignature');
		echo $this->Form->input('cb_positiond');
		echo $this->Form->input('cb_sites');
		echo $this->Form->input('cb_undergrad');
		echo $this->Form->input('cb_residency');
		echo $this->Form->input('connections');
		echo $this->Form->input('cb_univappt');
		echo $this->Form->input('cb_mdcert');
		echo $this->Form->input('cb_profint');
		echo $this->Form->input('cb_outint');
		echo $this->Form->input('cb_memmnt');
		echo $this->Form->input('cb_phoneh');
		echo $this->Form->input('cb_phonem');
		echo $this->Form->input('cb_phoneo');
		echo $this->Form->input('cb_pager');
		echo $this->Form->input('cb_addrcity');
		echo $this->Form->input('cb_addrpstcd');
		echo $this->Form->input('cb_addrs1');
		echo $this->Form->input('cb_addrs2');
		echo $this->Form->input('cb_addrprov');
		echo $this->Form->input('formatname');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profile'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
