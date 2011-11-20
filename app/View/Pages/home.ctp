<ul>
	<li><?php echo $this->Html->link('Locations', array('controller' => 'locations')); ?></li>
	<li><?php echo $this->Html->link('Physicians', array('controller' => 'physicians')); ?></li>
	<li><?php echo $this->Html->link('Scheduled shifts (list)', array('controller' => 'shifts')); ?> - for looking at and editing single entries</li>
	<li><?php echo $this->Html->link('Scheduled shifts (calendar)', array('controller' => 'shifts', 'action' => 'viewCalendar')); ?> - for looking at and editing many entries</li>
	<li><?php echo $this->Html->link('Scheduled shifts (pdf)', array('controller' => 'shifts', 'action' => 'viewPdf')); ?> - exported PDF; defaults to current month</li>
	<li><?php echo $this->Html->link('Shifts types', array('controller' => 'shifts_types')); ?></li>
</ul>