<?php
if (isset($failure)) {
	return;
}?>
<ul>
<?php
	$extras = FALSE;
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>";
			if (isset($passed_id)) {
				echo $this->Html->link($name, array('controller' => 'shifts', 'action' => $calendarAction, 'calendar' => $id, 'id' => $passed_id));
			}
			else {
				echo $this->Html->link($name, array('controller' => 'shifts', 'action' => $calendarAction, 'calendar' => $id));
			}
			echo "</li>";
		}
	}
?>
</ul>