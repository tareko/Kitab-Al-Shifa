<ul>
<?php 
	$extras = FALSE;
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>";
			if (isset($passed_id)) { $extras = 'id[id]:'.$passed_id;}
			echo $this->Html->link($name, array('controller' => 'shifts', 'action' => $calendarAction, "calendar:" .$id, $extras));
			echo "</li>";
		}
	}
?>
</ul>