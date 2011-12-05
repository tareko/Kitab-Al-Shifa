<?php
	$this->iCal->create('EMLondon', 'Emergency Medicine London Schedule', 'US/Eastern');


	foreach($masterSet as $shift)
	{
		if ($shift['shift_start'] >= $shift['shift_end']) {
			$date = new DateTime($shift['date']);
			$date->add(new DateInterval('P1D'));
			$shift['end_date'] = date_format($date, 'Y-m-d');
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
				'location'=>$shift['location']
			)
		);
	}
	$this->iCal->render();
?>