<?php
	$this->iCal->create('EMLondon', 'Emergency Medicine London Schedule', 'US/Eastern');


	foreach($masterSet as $shift)
	{
		if ($shift['shift_start'] >= $shift['shift_end']) {
/*
 * Not 5.2 compatible
 *
 *  			$date = new DateTime($shift['date']);
			$date->add(new DateInterval('P1D'));
 */
			$date = strtotime($shift['date'] . " +1 day");
			$shift['end_date'] = date('Y-m-d', $date);
		}
		else {
			$shift['end_date'] = $shift['date'];
		}

		$this->iCal->addEvent(
			$shift['date'].'T'.$shift['shift_start'],
			$shift['end_date'].'T'.$shift['shift_end'],
			$shift['location'],
			$shift['comment'],
			array(
				'UID'=>$shift['id'],
				'location'=>$shift['location'],
				'categories'=> $shift['location'],
			)
		);
	}
	$this->iCal->render();
?>