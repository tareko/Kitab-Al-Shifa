<?= $this->Form->create('Trade');?>

<fieldset>
		<legend><?php echo __('Make a Trade'); ?></legend>
		<h2>Which shift would you like to trade?</h2>
		<?= $this->DatePicker->makeDatePicker($shifts); ?>
		<?= $this->Form->input('from_user_id', array('type' => 'text', 'default' => $usersId)); ?>
		<?= $this->Form->input('from_user_id_hidden', array(
				'type' => 'text', 
				'default' => $usersId, 
				'div' => 'input text TradeFromUserIdHiddenDiv')); ?>
		<?= $this->Form->input('shift_id', array('label' => 'Which shift would you like to trade?')); ?>
		<div id="pick-doctor">
			<h2>Who are you offering the trade to?</h2>
			My groups
			Exclude those who are already working
			<?= $this->PhysicianPicker->makePhysicianPicker($physicians); ?>
		</div>
		Which shift would you like back?
	</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>

	<script>
	$(document).ready(function(){

		/* 
		 * This function will activate when #TradeStartDate is selected or changes.
		 * It then empties the previous shift area, and fills in the shift information
		 * for all shifts found that day.
		 *
		 */
	
		$('#TradeStartDate').change(function() {
			$.getJSON('/kitab/trades/add.json', {date: $(this).val(), id: $('input[name="data[Trade][from_user_id_hidden]"]').val()}, function(data){
				$("select#TradeShiftId").empty();
				var html = '';
				var len = data.shiftList.length;
				for (var i = 0; i< len; i++) {
			    	html += '<option value="' + data.shiftList[i].Shift.id + '">' + data.shiftList[i].ShiftsType.Location.location + ' ' + data.shiftList[i].ShiftsType.shift_start + '</option>';
			    	console.log(data.shiftList[1]);	
				}
				$('select#TradeShiftId').append(html);
				});
		});

		/* 
		 * This function will activate when a physician is selected (TradeFromUserId), and update #TradeStartDate's active
		 * values (shiftDays).
		 *
		 */

		$('#TradeFromUserId').change(function() {
			$('#TradeFromUserIdHidden').remove();
			$('.TradeFromUserIdHiddenDiv').append('<input type="text" id="TradeFromUserIdHidden" value="' + $(this).val() + '" name="data[Trade][from_user_id_hidden]">');
			$("select#TradeShiftId").empty();
			$(".datepicker").datepicker('refresh');
			$.getJSON('/kitab/trades/add.json', {id: $('#TradeFromUserIdHidden').val()}, function(json) {
				shiftDays = json;
			});
		});
	});
	</script>
	