Dear <?=$user['name']?>,

In theory, you have initiated a trade request for your shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>

<?php //TODO: PEOPLE TO TRADE WITH
//with:

//TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT'?>

Please review this trade carefully. Once you accept, the people you would like to trade with will be contacted.

If you did not send this request, please hit 'Reject' or ignore this message and accept my sincere apologies.

To *ACCEPT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'accept',
		), true
	) . '?id=' .$tradeId .'&token=' .$token
?>

To *REJECT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'reject',
		), true
	) . '?id=' .$tradeId .'&token=' .$token
?>

Thank you for your consideration,

Kitab Al Shifa Mail Bot : )