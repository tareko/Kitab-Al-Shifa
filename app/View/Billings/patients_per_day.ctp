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
	<tr><th>Physician</th><th>Date</th><th>Patients seen</th></tr>
<?php

foreach ($data as $date) {
	echo "<tr>";
	echo "<td>".$date['healthcare_provider']."</td>";
	echo "<td>".$date['service_date']."</td>";
	echo "<td>".$date['count']."</td>";
	echo "</tr>";
}

?>
</table>
