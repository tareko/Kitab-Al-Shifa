Dear <?=$user['name']?>,

You have <?=$statusWord?> your trade offer for the following shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>\n\n

<?php 
if ($statusWord == 'ACCEPTED') { ?>
This trade will now be sent to the people you have asked to consider this shift.
<?php }
if ($statusWord == 'REJECTED') { ?>
This trade will now be removed, and you need not think about it any more.
<?php }?>

If you did not send this request, or if something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.

Thank you,

Kitab Al Shifa Mail Bot : )