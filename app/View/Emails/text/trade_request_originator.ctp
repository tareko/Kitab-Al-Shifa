Dear <?=$user['name']?>,

There has been a request to trade your shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>

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

<?php //TODO: PEOPLE TO TRADE WITH
//This shift is in consideration for: CASH/TRADE/ETC

//Once you accept this trade, it will be sent to the following people:
//<ul><li></li></ul>


//TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT'

//This request has been initiated by:

?>


Thank you for your consideration,

Kitab Al Shifa Mail Bot : )