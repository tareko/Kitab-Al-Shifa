<?php
echo $this->Html->script('jquery');

//$this->Paginator->options(array(
//    'update' => '#content',
//    'evalScripts' => true
//));
?>
	<h2><?php echo __('Shift Marketplace');?></h2>
<div class="shifts <?= ($admin ? "index" : "")?>">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('shifts_type_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?= __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($shifts as $shift): ?>
	<tr>
		<td><?= h($shift['Shift']['date']); ?>&nbsp;</td>
		<td><?= $locations[$shift['ShiftsType']['location_id']]?>&nbsp;</td>
		<td><?= $shift['ShiftsType']['times']?>&nbsp;</td>
		<td><?= $shift['User']['name']?>&nbsp;</td>
		<td><a href="<?= $this->Html->url(array(
				'controller' => 'trades',
				'action' => 'market_take',
				'?' => array(
					'id' => $shift['Shift']['id'])
			));?>"><button class="btn btn-default btn-xs" type="submit">Take shift</button></a></td>
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
?>
</div>
<?php if ($admin) {?>
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
<?php }?>

<?php echo $this->Js->writeBuffer();?>
<script>
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});
</script>
