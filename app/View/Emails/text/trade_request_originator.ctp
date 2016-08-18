<?php $consideration = array(
		'0' => 'Cash',
		'1' => 'Trade',
		'2' => 'Future consideration',
		'3' => 'Marketplace')?>

Dear <?=$user['name']?>,

<?=$submittedUser['name'] ?> has submitted a request to trade your shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>


Please review this trade carefully. Once you accept, the people you would like to trade with will be contacted.

If you did not send this request, please hit 'Reject' or ignore this message and accept my sincere apologies.

To *ACCEPT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'accept',
		), true
	) . '?id=' .$trade['id'] .'&token=' .$token
?>

To *REJECT*, click here:
<?=$this->Html->url(array(
		'controller' => 'trades',
		'action' => 'reject',
		), true
	) . '?id=' .$trade['id'] .'&token=' .$token
?>


This shift is being offered for: <?=$consideration[$trade['consideration']]?>


Once you accept this trade, it will be sent to the following people:

<?php foreach ($tradesDetail as $detail) {
	echo "* " . $detail['User']['name']."\n";
}


//TODO: Two-way trades
//$fromUser['name'] takes 
//YOUR SHIFT'
?>


They will receive the following message:
****Start Message****
<?=$trade['message'] ?>

****End Message****

Thank you for your consideration,

Kitab Al Shifa Mail Bot : )