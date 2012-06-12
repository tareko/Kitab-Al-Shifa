Dear <?=$toUser['name']?>,

You have received a trade request from <?=$fromUser['name']?>.\n\n

The proposed trade is as follows:\n\n
You take:\n <?php
		$fromShift = $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times'];
		echo $fromShift?>\n\n

<?php //TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT\n\n'?>

Please review this trade carefully.\n\n

To *ACCEPT*, click here:\n
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'accept',
		'?' => array(
				'id' => $tradesDetailId,
				'token' => $token
				)
		), true
	)?>\n\n

To *REJECT*, click here:\n
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'reject',
		'?' => array(
				'id' => $tradesDetailId,
				'token' => $token
				)
		), true
	)?>\n\n

Thank you for your consideration,\n\n

Kitab Al Shifa Mail Bot : )