<ul>
	<li><?php echo $this->Html->link('Locations', array('controller' => 'locations')); ?></li>
	<li><?php echo $this->Html->link('Physicians', array('controller' => 'physicians')); ?></li>
	<li><?php echo $this->Html->link('Scheduled shifts (list)', array('controller' => 'shifts')); ?> - for looking at and editing single entries</li>
	<li><?php echo $this->Html->link('Scheduled shifts (calendar)', array('controller' => 'shifts', 'action' => 'viewCalendar')); ?> - for looking at and editing many entries</li>
	<li><?php echo $this->Html->link('Scheduled shifts (iCal)', array('controller' => 'shifts', 'action' => 'viewIcs')); ?> - for downloading a calendar to your calendar software</li>
	<li><?php echo $this->Html->link('Scheduled shifts (pdf)', array('controller' => 'shifts', 'action' => 'viewPdf')); ?> - exported PDF; defaults to current month</li>
	<li><?php echo $this->Html->link('Shifts types', array('controller' => 'shifts_types')); ?> - Management of shift types</li>
	<li><?php echo $this->Html->link('Calendars', array('controller' => 'calendars')); ?> - for creating and editing calendar blocks</li>
	<li><?php echo $this->Html->link('Groups', array('controller' => 'groups')); ?> - for managing groups of physicians / staff</li>
</ul>