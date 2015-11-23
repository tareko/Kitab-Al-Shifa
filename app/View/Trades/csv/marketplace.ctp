<?php
// Loop through the data array
echo "Date,Location,Shifts Type,User\n";

	foreach ($shifts as $shift) {
		$output = array();
		$output[] = $shift['Shift']['date'];
		$output[] = $locations[$shift['ShiftsType']['location_id']];
		$output[] = $shift['ShiftsType']['times'];
		$output[] = $shift['User']['name'];
		echo implode(",",$output)."\n";
	}