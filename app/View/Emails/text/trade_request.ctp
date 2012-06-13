Dear <?=$toUser['name']?>,

You have received a trade request from <?=$fromUser['name']?>.

The proposed trade is as follows:

You take: <?php
		$fromShift = $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times'];
		echo $fromShift?>

<?php //TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT\n\n'?>

Please review this trade carefully.

To *ACCEPT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'accept',
		), true
	) . '?id=' .$tradesDetailId .'&token=' .$token
?>

To *REJECT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades_details',
		'action' => 'reject',
		), true
	) . '?id=' .$tradesDetailId .'&token=' .$token
?>


Thank you for your consideration,

Kitab Al Shifa Mail Bot : )