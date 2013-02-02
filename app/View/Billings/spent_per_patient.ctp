<?php 
echo $this->Form->create('Billing', array('type' => 'get'));

echo $this->Form->input('ohip');
echo $this->Form->input('start_date', array(
		'type' => 'date',
		'dateFormat' => 'D-M-Y'));
echo $this->Form->input('end_date', array(
		'type' => 'date',
		'dateFormat' => 'D-M-Y'));

echo $this->Form->end('Submit');

?>
The total spent was $<?=$data?>;
