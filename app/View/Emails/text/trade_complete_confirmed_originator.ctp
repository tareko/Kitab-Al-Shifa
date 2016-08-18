<?php $consideration = array(
		'0' => 'Cash',
		'1' => 'Trade',
		'2' => 'Future consideration',
		'3' => 'Marketplace')?>

Dear <?=$user['name']?>,

A trade has been completed for the following shift between you and <?=$tradesDetail[0]['User']['name']?>:

You GIVE for <?=$consideration[$trade['consideration']]?>:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>

<?php 
if ($submittedUser['id'] == $user['id']) { ?>

This shift trade was requested and confirmed by you. Of course I trust you, but if <?=$tradesDetail[0]['User']['name']?> reports an issue with this trade, I will be very cross and you might be punished for your deviousness.

If something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.
<?php }
else { ?>

This shift trade was requested and confirmed by <?=$submittedUser['name']?>. 

If you did not agree to this trade or if something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.
<?php }?>

Thank you,

Kitab Al Shifa Mail Bot : )