<?php
echo $this->Html->script('jquery');
echo $this->Html->css('awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
echo $this->Html->css('awesome-bootstrap-checkbox/bower_components/Font-Awesome/css/font-awesome.css');

$this->Paginator->options(array(
    'update' => '#content',
    'evalScripts' => true
));
?>
	<h2><?php echo __('Shifts');?></h2>
<div class="shifts <?= ($admin ? "index" : "")?>">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('shifts_type_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th><span data-toggle="tooltip" data-placement="bottom" title="Check here to submit your shift to the shift marketplace. Uncheck to remove"><?php echo __('Marketplace');?></span></th>
	</tr>
	<?php
	$i = 0;
	foreach ($shifts as $shift): ?>
	<tr>
		<td><?= h($shift['Shift']['date']); ?>&nbsp;</td>
		<td><?= $shift['ShiftsType']['Location']['location'] ?>&nbsp;</td>
		<td><?= $shift['ShiftsType']['times'] ?>&nbsp;</td>
		<td><?= $shift['User']['name'] ?>&nbsp;</td>
		<td><?php echo h($shift['Shift']['updated']); ?>&nbsp;</td>
		<td style="text-align: center">
			<div class="checkbox checkbox-primary">
				<a href="<?=$this->Html->url(array(
				    "controller" => "shifts",
				    "action" => "marketplace",
				    $shift['Shift']['id'],
					$shift['Shift']['marketplace'] == 0 ? "1" : "0"))?>
				">
					<?= $this->Html->image($shift['Shift']['marketplace'] == 0 ? "checkbox-unchecked.png" : "checkbox-checked.png", array('alt' => $shift['Shift']['marketplace'] == 0 ? "[ ]" : "[X]", 'width' => '20'))?>
				</a>
			</div>
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
