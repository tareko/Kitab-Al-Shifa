<ul>
<?php 
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>" . $this->Html->link($name, $this->Html->url("/app/webroot/pdf/EMA_Schedule-".$id."-".$start_date.".pdf", true)); 
			if ($admin) {
				echo " (" . $this->Html->link("update now", array('controller' => 'shifts', 'action' => 'pdfCreate', "calendar[calendar]:" .$id)) . ")";
			}
			echo "</li>";
		}
	}
?>
</ul>