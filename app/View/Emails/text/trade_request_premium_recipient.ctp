Dear <?=$tradesDetail['User']['name']?>,

The Emergency On-Call system has been initiated. <?=$user['name']?> needs your help!

***Start message***
<?=$trade['message']?>


***End message***

A PREMIUM WILL BE PAID FOR THIS SHIFT OF $700.

Please take the following shift if you are able:

You take: <?=$shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times'];?>

Please review this trade carefully. If you are completely unable to take this shift, please select 'REJECT' below so that you will receive no further messages.


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

To check whether this shift has been traded or is still available, click here:
*Not yet available*


Thank you for your consideration,

Kitab Al Shifa Mail Bot : )
