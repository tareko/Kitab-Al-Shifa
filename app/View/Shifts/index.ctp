<?php
echo $this->Html->script('jquery');

$this->Paginator->options(array(
    'update' => '#content',
    'evalScripts' => true
));


echo $this->Form->create('Shift', array(
    'url' => array('action' => 'index') + $this->request->params['named']
));
echo $this->Form->month('month', array('default' => date('m'), 'empty' => false));
echo $this->Form->year('year', '2011', date('Y') + 1, array('default' => date('Y'), 'empty' => false));
echo $this->Form->input('location', array(
	'div' => false,
	'multiple' => 'checkbox',
	'label' => false, 
	'options' => $locations));
echo $this->Form->submit(__('Search', true), array('div' => false));
echo $this->Form->end();

?>
<div style="clear:both"></div>
<div class="shifts index">
	<h2><?php echo __('Shifts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('shifts_type_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($shifts as $shift): ?>
	<tr>
		<td><?php echo h($shift['Shift']['date']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($shift['ShiftsType']['Location']['location'], array('controller' => 'locations', 'action' => 'view', $shift['ShiftsType']['location_id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($shift['ShiftsType']['times'], array('controller' => 'shifts_types', 'action' => 'view', $shift['ShiftsType']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($shift['User']['name'], array('controller' => 'users', 'action' => 'view', $shift['User']['id'])); ?>&nbsp;</td>
		<td><?php echo h($shift['Shift']['updated']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shift['Shift']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
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
		<li><?php echo $this->Html->link(__('New Shift'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts Types'), array('controller' => 'shifts_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shifts Type'), array('controller' => 'shifts_types', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php echo $this->Js->writeBuffer();?>