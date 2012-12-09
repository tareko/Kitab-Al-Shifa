<?php
// Loop through the data array

$data = $this->Calendar->makeCalendarCsv($masterSet);

 foreach ($data as $row)
{
	// Echo all values in a row comma separated
	echo implode(",",$row)."\n";
}