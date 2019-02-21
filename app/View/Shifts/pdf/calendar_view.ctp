<?php
echo $this->Html->css($this->Html->url("/css/calendarPdf.css", true));
echo $this->Calendar->makeCalendarPdf($masterSet);
?>
<br/><br/><br/><div class="notes"><p>Notes:<br/><?= $masterSet['calendar']['Calendar']['comments'];?>
<p>PDF created: <?=date('Y-m-d')?></p>
<p>Schedule last updated: <?=$masterSet['calendar']['lastupdated']?></p></div>
