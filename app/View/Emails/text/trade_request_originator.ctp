Dear <?=$user['name']?>,

In theory, you have initiated a trade request for your shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>

\n\nwith:

<?php //TODO: PEOPLE TO TRADE WITH?>
.\n\n

<?php //TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT\n\n'?>

Please review this trade carefully. Once you accept, the people you would like to trade with will be contacted.\n\n

If you did not send this request, please hit 'Reject' or ignore this message and accept my sincere apologies.\n\n

To *ACCEPT*, click here:\n
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'accept',
		'?' => array(
				'trade_id' => $tradeId,
				'token' => $token
				)
		), true
	)?>\n\n

To *REJECT*, click here:\n
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'reject',
		'?' => array(
				'trade_id' => $tradeId,
				'token' => $token
				)
		), true
	)?>\n\n

Thank you for your consideration,\n\n

Kitab Al Shifa Mail Bot : )