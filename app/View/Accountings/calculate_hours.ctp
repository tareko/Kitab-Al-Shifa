<?php
foreach ($users as $user) {
?>
<p>User #<?=$user['Shift']['user_id']?> worked:</p>
<p>Seconds:
<ul>
<?php

	foreach ($seconds[$user['Shift']['user_id']] as $location => $second) {
		echo "<li>" . $location . ": " . $second . "</li>";
	}
?>
</ul>
</p>

<p>Hours:
<ul>

<?php
	foreach ($hours[$user['Shift']['user_id']] as $location => $hour) {
		echo "<li>".$location . ": " . $hour."</li>";
	}
?>
</ul>
</p>
<?php
}
?>