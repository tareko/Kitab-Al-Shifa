<?php 
/** This helper is designed to allow for the selection of a date, with output for a form.
 * It requires some dates to enable, and by default allows no dates.
 * @author Tarek
 *
 */

class DatePickerHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js');
	/**
	 * 
	 * @param unknown_type $shifts
	 * @param unknown_type $calendarId
	 */
	function makeDatePicker($userData, $calendarId) {
?>
		<?= $this->Html->css('ui-lightness/jquery-ui'); ?>
		
		<?= $this->Html->script('jquery'); // Include jQuery library ?>
		
		<?= $this->Html->script('jquery-ui'); // Include jQuery UI library ?>
		
	 	<?= $this->Html->div('', '', array('id' => 'datepicker' . $calendarId)); ?>

		<script type="text/javascript">
		$(document).ready(function() {
		
			$.getJSON(
				'<?= $this->Html->url(array('controller' => 'shifts', 'action' => 'listShifts.json')); ?>', 
				{id: $('<?=$userData?>').val()}, 
				function(json) {
					shiftDays = json;
					$("#datepicker<?=$calendarId?>").datepicker({ 
						beforeShowDay: shiftsWorking, 
						dateFormat: 'yy-mm-dd',
						onSelect: calendarSelect
					});
				}
			);
		});
		
		function shiftsWorking(date) {
		    for (i = 0; i < shiftDays.shiftList.length; i++) {
		      dateDB = new Date(Date.UTC.apply(Date, shiftDays.shiftList[i].Shift.date.split('-').map(function (d, i) { return parseInt(d, 10) - (i === 1 ? 1 : 0); })));
		      dateDB.setDate (dateDB.getDate()+1);
		      if (date.getYear() == dateDB.getYear()
		          && date.getMonth() == dateDB.getMonth()
		          && date.getDate() == dateDB.getDate()) {
		        return [true, shiftDays.shiftList[i].Shift.date + '_day'];
		      }
		    }
		  return [false, ''];
		}
		</script>
		<?php 
		echo $this->Js->writeBuffer(); // Write cached scripts
	}
}
?>