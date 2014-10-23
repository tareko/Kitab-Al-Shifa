<?php if (isset($messages)) {?>
<h2>Pending messages:</h2>
<?php echo $messages;}?>

<h2>My upcoming shifts:</h2>
<?php if (isset($shifts)) {?>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th>Location</th>
			<th>Time</th>
	</tr>
	<?php
	$i = 0;
	foreach ($shifts as $shift): ?>
	<tr>
		<td><?php echo h($shift['Shift']['date']); ?></td>
		<td><?=$shift['ShiftsType']['Location']['location']?></td>
		<td><?= $shift['ShiftsType']['times'] ?></td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<?php
		echo $this->Paginator->pagination(array(
			'ul' => 'pagination pagination-lg'));
}
else { ?>
<p>You have no upcoming shifts in the next 30 days</p>
<?php }?>
