<?php 
/** This helper is designed to allow for the selection of a date, with output for a form.
 * It requires some dates to enable, and by default allows no dates.
 * @author Tarek
 *
 */

class DatePickerHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js');
	function makeDatePicker($shifts) {
		echo $this->Html->script('jquery'); // Include jQuery library
		echo $this->Html->script('jquery-ui'); // Include jQuery UI library
		echo $this->Html->css('ui-lightness/jquery-ui');
?>

<script>
$(document).ready(function() {
	$.getJSON('/kitab/trades/add.json', {id: $('#TradeFromUserIdHidden').val()}, function(json) {
		shiftDays = json;
	});

	$(".datepicker").datepicker({ beforeShowDay: shiftsWorking, dateFormat: 'yy-mm-dd'});

    function shiftsWorking(date) {
        for (i = 0; i < shiftDays.shiftList.length; i++) {
          dateDB = new Date(shiftDays.shiftList[i].Shift.date);
          if (date.getYear() == dateDB.getYear()
              && date.getMonth() == dateDB.getMonth()
              && date.getDate() == dateDB.getDate() + 1) {
            return [true, shiftDays.shiftList[i].Shift.date + '_day'];
          }
        }
      return [false, ''];
    }
});
</script>

<?php 	echo $this->Form->input('start_date',
        array(
        		'class'=>'datepicker',
        		'type'=>'text',
        		'label' => '(Format: YYYY-MM-DD)'
        )
);
echo $this->Js->writeBuffer(); // Write cached scripts
	}
}
?>