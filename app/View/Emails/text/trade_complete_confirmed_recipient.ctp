<?php $consideration = array(
		'0' => 'Cash',
		'1' => 'Trade',
		'2' => 'Future consideration')?>
Dear <?=$tradesDetail[0]['User']['name']?>,

A trade has been completed for the following shift between you and <?=$user['name']?>:

You TAKE for <?=$consideration[$trade['consideration']]?>:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>

<?php 
if ($submittedUser['id'] == $tradesDetail[0]['User']['id']) { ?>

This shift trade was requested and confirmed by you. Of course I trust you, but if <?=$user['name']?> reports an issue with this trade, I will be very cross and you might be punished for your deviousness.

If something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.
<?php }
else { ?>

This shift trade was requested and confirmed by <?=$submittedUser['name']?>. 

If you did not agree to this trade or if something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.
<?php }?>

Thank you,

Kitab Al Shifa Mail Bot : )