<ul>
<?php 
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>" . $this->Html->link($name, $this->Html->url("/app/webroot/pdf/EMA_Schedule-".$id."-".$start_date.".pdf", true)) . " (" . $this->Html->link("update now", array('controller' => 'shifts', 'action' => 'createPdf', "calendar[calendar]:" .$id)) . ")</li>";
		}
	}
?>
</ul>