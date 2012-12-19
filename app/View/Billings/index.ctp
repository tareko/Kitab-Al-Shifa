<table>
	<tr><th>Physician</th><th>Date</th><th>Location</th><th>Shift</th><th>Patients seen</th></tr>
<?php 

foreach ($patientsSeen as $shift) {
	echo "<tr>";
	echo "<td>".$shift['User']['name']."</td>";
	echo "<td>".$shift['Shift']['date']."</td>";
	echo "<td>".$shift['ShiftsType']['Location']['location']."</td>";
	echo "<td>".$shift['ShiftsType']['shift_start']." - ".$shift['ShiftsType']['shift_end'] ."</td>";
	echo "<td>".$shift['Billing']['count']."</td>";
	echo "</tr>";
}

?>
</table>
