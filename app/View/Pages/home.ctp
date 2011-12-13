<h2>My schedule:</h2>
<ul>
	<li><?php echo $this->Html->link('List', array('controller' => 'shifts', 'id[id]:' . $users_id)); ?> - A list of all my shifts</li>
	<li><?php echo $this->Html->link('Web Calendar', array('controller' => 'shifts', 'action' => 'calendarView', 'id[id]:' . $users_id)); ?> - A web-based calendar view of my shifts</li>
	<li><?php echo $this->Html->link('iCalendar', array('controller' => 'shifts', 'action' => 'icsView', 'id[id]:' . $users_id)); ?> - for linking or downloading a calendar to my calendar software</li>
	<li><s><?php echo $this->Html->link('PDF', array('controller' => 'shifts', 'action' => 'pdfView', 'id[id]:' . $users_id)); ?> - a printable PDF of only my schedule</s></li>
</ul>
<br/>
<br/>
<h2>Everybody's schedule:</h2>
<ul>
	<li><?php echo $this->Html->link('Web Calendar', array('controller' => 'shifts', 'action' => 'calendarView')); ?> - A web-based calendar view of everybody's shifts</li>
	<li><?php echo $this->Html->link('PDF', array('controller' => 'shifts', 'action' => 'pdfView')); ?> - a printable PDF of the entire schedule</li>
	<li><?php echo $this->Html->link('iCalendar', array('controller' => 'shifts', 'action' => 'icsView')); ?> - for linking or downloading a calendar to my calendar software</li>
</ul>
	

<?php
	if ($admin) { ?>
		<br/><br/>
		<h2>Administrative functions:</h2>
		<ul>
			<li><?php echo $this->Html->link('list', array('controller' => 'shifts')); ?> - for looking at and editing single entries</li>
			<li><?php echo $this->Html->link('Web calendar (edit mode)', array('controller' => 'shifts', 'action' => 'calendarEdit')); ?> - for looking at and editing many entries</li>
			<li><?php echo $this->Html->link('PDF', array('controller' => 'shifts', 'action' => 'pdfView')); ?> - exported PDFs with options to create/update and view</li>
		</ul>
		<br/><br/>
		<h2>!!PROCEED WITH CAUTION: DRAGONS AHEAD!!</h2>
		<ul>
			<li><?php echo $this->Html->link('Locations', array('controller' => 'locations')); ?></li>
			<li><?php echo $this->Html->link('Physicians', array('controller' => 'users')); ?></li>
			<li><?php echo $this->Html->link('Shifts types', array('controller' => 'shifts_types')); ?> - Management of shift types</li>
			<li><?php echo $this->Html->link('Calendars', array('controller' => 'calendars')); ?> - for creating and editing calendar blocks</li>
			<li><?php echo $this->Html->link('Groups', array('controller' => 'groups')); ?> - for managing groups of physicians / staff</li>
		</ul>
<?php
 	}

?>