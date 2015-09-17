Dear <?=$tradesDetail['User']['name']?>,

You have received a trade request from <?=$user['name']?>.

***Start message***
<?=$trade['message']?>


***End message***

The proposed trade is as follows:

You take: <?=$shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times'];?>

<?php //TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT\n\n'?>

Please review this trade carefully.

To *ACCEPT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'accept',
		), true
	) . '?id=' .$tradesDetail['id'] .'&token=' .$token
?>

To *REJECT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'reject',
		), true
	) . '?id=' .$tradesDetail['id'] .'&token=' .$token
?>


Thank you for your consideration,

Kitab Al Shifa Mail Bot : )