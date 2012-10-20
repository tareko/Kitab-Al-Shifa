<?php
// Loop through the data array
foreach ($data as $row)
{
	// Loop through every value in a row
	foreach ($row as $value)
	{
		// Apply opening and closing text delimiters to every value
		$value = "\"".$value."\"";
	}
	// Echo all values in a row comma separated
	echo implode(",",$row)."\n";
}