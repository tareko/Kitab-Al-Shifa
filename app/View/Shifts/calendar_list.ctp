<ul>
<?php 
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>";
			echo $this->Html->link($name, array('controller' => 'shifts', 'action' => $calendarAction, "calendar:" .$id));
			echo "</li>";
		}
	}
?>
</ul>