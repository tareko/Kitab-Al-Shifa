<div class="groups view">
<h2><?php  echo __('Group');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usergroups Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['usergroups_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Acl'); ?></dt>
		<dd>
			<?php echo h($group['Group']['acl']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergroups'), array('controller' => 'usergroups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergroup'), array('controller' => 'usergroups', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Usergroups');?></h3>
	<?php if (!empty($group['Usergroup'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $group['Usergroup']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Parent Id');?></dt>
		<dd>
	<?php echo $group['Usergroup']['parent_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Lft');?></dt>
		<dd>
	<?php echo $group['Usergroup']['lft'];?>
&nbsp;</dd>
		<dt><?php echo __('Rgt');?></dt>
		<dd>
	<?php echo $group['Usergroup']['rgt'];?>
&nbsp;</dd>
		<dt><?php echo __('Title');?></dt>
		<dd>
	<?php echo $group['Usergroup']['title'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Usergroup'), array('controller' => 'usergroups', 'action' => 'edit', $group['Usergroup']['id'])); ?></li>
			</ul>
		</div>
	</div>
	