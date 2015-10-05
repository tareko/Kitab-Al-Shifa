<?php
// Loop through the data array
echo "Offered by,Taken by,Date,Time\n";

	foreach ($trades as $trade) {
		$output = array();
		//Highlight name if it's the user's
		$output[] = $trade['User']['name'];
		if (count($trade['TradesDetail']) > 1) {
			foreach ($trade['TradesDetail'] as $tradesDetail) {
				if ($tradesDetail['status'] == 2) {
					$output[] = $tradesDetail['User']['name'];
				}
			}
		}
		else {
			$output[] = $trade['TradesDetail'][0]['User']['name'];
		}

		$output[] = $trade['Shift']['date'];
		$output[] = $trade['Shift']['ShiftsType']['times'];
		echo implode(",",$output)."\n";
	}