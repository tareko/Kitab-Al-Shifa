<h2>My schedule:</h2>
<ul>
	<li><?php echo $this->Html->link('List', array('controller' => 'shifts')); ?> - A list of all my shifts</li>
	<li><?php echo $this->Html->link('Web Calendar', array('controller' => 'shifts', 'action' => 'viewCalendar')); ?> - A web-based calendar view of my shifts</li>
	<li><?php echo $this->Html->link('iCalendar', array('controller' => 'shifts', 'action' => 'viewIcs')); ?> - for linking or downloading a calendar to my calendar software</li>
	<li><?php echo $this->Html->link('PDF', array('controller' => 'shifts', 'action' => 'viewPdf')); ?> - a printable PDF of only my schedule</li>
</ul>
<br/>
<br/>
<h2>Everybody's schedule:</h2>
<ul>
	<li><?php echo $this->Html->link('Web Calendar', array('controller' => 'shifts', 'action' => 'viewCalendar')); ?> - A web-based calendar view of everybody's shifts</li>
	<li><?php echo $this->Html->link('PDF', array('controller' => 'shifts', 'action' => 'viewPdf')); ?> - a printable PDF of the entire schedule</li>
</ul>
	

<?php
	if ($admin) { ?>
		<p>Administrative functions:</p>
		<ul>
			<li><?php echo $this->Html->link('Locations', array('controller' => 'locations')); ?></li>
			<li><?php echo $this->Html->link('Physicians', array('controller' => 'users')); ?></li>
			<li><?php echo $this->Html->link('Scheduled shifts (list)', array('controller' => 'shifts')); ?> - for looking at and editing single entries</li>
			<li><?php echo $this->Html->link('Scheduled shifts (calendar edit)', array('controller' => 'shifts', 'action' => 'viewCalendar')); ?> - for looking at and editing many entries</li>
			<li><?php echo $this->Html->link('Scheduled shifts (pdf)', array('controller' => 'shifts', 'action' => 'viewPdf')); ?> - exported PDF; defaults to current month</li>
			<li><?php echo $this->Html->link('Shifts types', array('controller' => 'shifts_types')); ?> - Management of shift types</li>
			<li><?php echo $this->Html->link('Calendars', array('controller' => 'calendars')); ?> - for creating and editing calendar blocks</li>
			<li><?php echo $this->Html->link('Groups', array('controller' => 'groups')); ?> - for managing groups of physicians / staff</li>
		</ul>
<?php 	}

?>