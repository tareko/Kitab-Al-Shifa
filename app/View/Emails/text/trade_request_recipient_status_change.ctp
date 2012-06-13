Dear <?=$userRecipient['name']?>,

You have <?=$statusWord?> the trade from <?=$userOriginator['name']?> for the following shift:

<?= $shift['date'] .' '. $shift['ShiftsType']['Location']['location'] .' '. $shift['ShiftsType']['times']; ?>


<?php 
if ($statusWord == 'ACCEPTED') { ?>
This trade will now be automatically entered into the calendar, and should appear in the next 30 minutes.
<?php }

if ($statusWord == 'REJECTED') { ?>
The person who sent you this trade will be notified.
<?php }?>

If you did not send this request, or if something has gone wrong, please do not hesitate to contact the person responsible for trades at your institution.

Thank you,

Kitab Al Shifa Mail Bot : )