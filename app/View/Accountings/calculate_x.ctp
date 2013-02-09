<p><?=$doctor?> worked:</p>
<p>Seconds:
<ul>
<?php

	foreach ($seconds as $location => $second) {
		echo "<li>" . $location . ": " . $second . "</li>";
	}
?>
</ul>
</p>

<p>Hours:
<ul>

<?php
	foreach ($hours as $location => $hour) {
		echo "<li>".$location . ": " . $hour."</li>";
	}
?>
</ul>
</p>

<p>X:
<ul>

<?php
	foreach ($X as $location => $X) {
		echo "<li>" . $location . ": " . $X . "</li>";
	}
?>
</ul>
</p>