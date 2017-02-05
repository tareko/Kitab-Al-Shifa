<?php
// Loop through the data array
echo "Name,";
$i = 1;
while ($i <= count($locations)) {
	echo $locations[$i] .",";
	$i = $i + 1;
}
echo "\n";

foreach ($users as $user) {
?>
<?=$user['User']['name']?>,<?php

	$i = 1;
	while ($i <= count($locations)) {
		if (isset($hours[$user['Shift']['user_id']][$i])) {
			echo $hours[$user['Shift']['user_id']][$i];
		}
		echo",";
		$i = $i+1;
	}
	echo"\n";
}
?>
