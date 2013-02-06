<?php 
echo $this->Form->create('Billing', array('type' => 'get'));

echo $this->Form->select('id', $userList);
echo $this->Form->input('start_date', array(
		'type' => 'date',
		'dateFormat' => 'D-M-Y'));
echo $this->Form->input('end_date', array(
		'type' => 'date',
		'dateFormat' => 'D-M-Y'));

echo $this->Form->end('Submit');

?>
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
