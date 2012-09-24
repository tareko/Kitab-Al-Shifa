<?php
if (isset($updated)) {
	foreach ($updated as $update) {
		echo $update . " was updated.<br/>";
	}
}
?><br/><br/>
<?php 
if (isset($notUpdated)) {
	foreach ($notUpdated as $notUpdate) {
		echo $notUpdate . " was NOT updated.<br/>";
	}
}
