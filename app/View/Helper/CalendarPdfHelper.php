<?php
class CalendarPdfHelper extends AppHelper {
    public $helpers = array('Html');

	function makeCalendar($masterSet) {
		//Create variables
		$k = 1;
		$header = null;
		$output = null;
		$previousLocation = null;
		$colspan = 1;
		$month = $masterSet['month'];
		$year = $masterSet['year'] ;
		
		$output .= $this->Html->css('http://tarek.org/cakephp/css/calendarPdf.css');

		//Create headers
		$output .= "<h1>".date('F Y', mktime(0, 0, 0, $month, 1, $year))."</h1>";
		$output .= "<table>";
		$output .= "<tr><td rowspan=\"2\" colspan=\"2\" class=\"locations\" style=\"width: 40px;\">Date</td>";
		
		foreach ($masterSet['ShiftsType'] as $j => $shiftsType) {
			if ($previousLocation == $shiftsType['ShiftsType']['location_id']) {
				$colspan++;
				if ($j == count($masterSet['ShiftsType']) - 1) {
					$output .= "<td colspan=\"". $colspan ."\" class=\"locations locationColour".$previousLocation."\">". $masterSet['locations'][$previousLocation] ."</td>";
				}
			}
			else {
				if (isset($firstLocation)) {
					$output .= "<td colspan=\"". $colspan ."\" class=\"locations locationColour".$previousLocation."\">". $masterSet['locations'][$previousLocation] ."</td>";
				}
				$colspan = 1;
				$firstLocation = true;
				$previousLocation = $shiftsType['ShiftsType']['location_id'];
			}
		}
		$output .= "</tr>";
		
				
		foreach ($masterSet['ShiftsType'] as $shiftsType) {
			$output1[] = $shiftsType['ShiftsType']['times'];
		}
		$output .= $this->Html->tableCells($output1, array('class' => 'shiftTimes odd'), array('class' => 'shiftTimes even'), true);
		
		//Output Days of the month
		$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		while ($k <= $daysInMonth) {
			$output1 = null;
			$output1[] = date('D', mktime(0, 0, 0, $month, $k, $year));
			$output1[] = $k;
			if (isset($masterSet[$k])) {
				foreach ($masterSet['ShiftsType'] as $shiftsType) {
					if (isset($masterSet[$k][$shiftsType['ShiftsType']['location_id']][$shiftsType['ShiftsType']['id']])) {
						$output1[] = $masterSet[$k][$shiftsType['ShiftsType']['location_id']][$shiftsType['ShiftsType']['id']]['name'];
					}
					else {
						$output1[] = "&nbsp;";
					}
				}
			}
			// Enter physician names into record, spaced with comma.
			// Highlight differently if it's a weekend
			if (date('N', mktime(0, 0, 0, $month, $k, $year)) >= 6 ) {
				$output .= $this->Html->tableCells($output1, array('class' => 'weekend odd'), array('class' => 'weekend even'), true);
			}
			else {
				$output .= $this->Html->tableCells($output1, array('class' => 'weekday odd'), array('class' => 'weekday even'), true);
			}
			$k++;
		}
		
		$output .= "</table>";
		return $output;

	}
}
?>