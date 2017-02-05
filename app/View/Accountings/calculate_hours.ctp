<?php
foreach ($users as $user) {
?>
<p><?=$user['User']['name']?> worked:</p>
<ul>

<?php
	foreach ($hours[$user['Shift']['user_id']] as $location => $hour) {
		echo "<li>".$locations[$location] . ": " . $hour." hours</li>";
	}
?>
</ul>
</p>
<?php
}
?>