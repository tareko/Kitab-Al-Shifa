<ul>
<?php 
	foreach ($calendars as $id => $calendar) {
		foreach ($calendar as $start_date => $name) {
			echo "<li>" . $this->Html->link($name, "http://tarek.org/cakephp/app/webroot/pdf/EMA_Schedule-".$id."-".$start_date.".pdf") . "</li>";
		}
	}
?>
</ul>