<div class="trades view">
<h2><?php  echo __('Trade');?></h2>
	<dl>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($trade['User']['name'], array('controller' => 'users', 'action' => 'view', $trade['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Id'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['shift_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trading With'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['trading_with']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sent To'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['sent_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trade'), array('action' => 'edit', $trade['Trade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Trade'), array('action' => 'delete', $trade['Trade']['id']), null, __('Are you sure you want to delete # %s?', $trade['Trade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Shifts');?></h3>
	<?php if (!empty($trade['Shift'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $trade['Shift']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('User Id');?></dt>
		<dd>
	<?php echo $trade['Shift']['user_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Date');?></dt>
		<dd>
	<?php echo $trade['Shift']['date'];?>
&nbsp;</dd>
		<dt><?php echo __('Shifts Type Id');?></dt>
		<dd>
	<?php echo $trade['Shift']['shifts_type_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Updated');?></dt>
		<dd>
	<?php echo $trade['Shift']['updated'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Shift'), array('controller' => 'shifts', 'action' => 'edit', $trade['Shift']['id'])); ?></li>
			</ul>
		</div>
	</div>
	