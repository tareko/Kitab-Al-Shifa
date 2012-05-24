<?= $this->Form->create('Trade');?>

<fieldset>
	<legend><?php echo __('Make a Trade'); ?></legend>
	<div class="block">
		<?php
		echo $this->Form->input('from_user_id', array(
				'type' => 'text', 
				'default' => $usersId,
				'label' => __('Person making the trade'),
				'div' => 'TradeFromUserIdDiv'));
		echo $this->Form->input('Trade.user_id', array(
				'type' => 'text', 
				'default' => $usersId, 
				'div' => 'input text TradeFromUserIdHiddenDiv',
				'hidden' => true,
				'label' => false,
				'id' => 'TradeFromUserIdHidden'));
		?>
	</div>
	<div class="block">
		<label for="datepicker1"><?= __('Please select the date of the shift you would like to trade')?></label>
		<?php
		echo $this->DatePicker->makeDatePicker('#TradeFromUserIdHidden', 1);
		echo $this->Form->input('shift_id', array('label' => __('Which shift would you like to trade?')));
		?>
	</div>
	<div class="block">
		<label><?=__('Who are you offering the trade to?')?></label>
		<?php 
		echo $this->Html->div('TradesDetail.user_id',
			$this->PhysicianPicker->makePhysicianPicker(null, 'data[TradesDetail]', 'user_id'),
				array('div' => 'pick-doctor'));
		?>
	</div>
	<div class="block">
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
	</fieldset>

	<script>
	$(document).ready(function(){
		$('#TradeFromUserId').autocomplete({
			minLength: 3, 
			source: '<?= $this->Html->url(array(
					'controller' => 'users', 
					'action' => 'listUsers.json', 
					'?' => array(
							'full' => '1'
							)
					)); ?>',
			select: docChange,
			focus: function(event, ui){
                var selectedObj = ui.item;
                $('input#TradeFromUserId').val(selectedObj.label);
                $('input#TradeFromUserIdHidden').val(selectedObj.value);
                return false;
            }
		});
	});

	/* 
	 * This function will activate when #TradeStartDate is selected or changes.
	 * It then empties the previous shift area, and fills in the shift information
	 * for all shifts found that day.
	 *
	 */

	function calendarSelect(data) {
		$.getJSON('<?= $this->Html->url(array('controller' => 'shifts', 'action' => 'listShifts.json')); ?>', {date: $(this).val(), id: $('input[name="data[Trade][user_id]"]').val()}, function(data){
			$("select#TradeShiftId").empty();
			var html = '';
			var len = data.shiftList.length;
			for (var i = 0; i< len; i++) {
		    	html += '<option value="' + data.shiftList[i].Shift.id + '">' + data.shiftList[i].ShiftsType.Location.location + ' ' + data.shiftList[i].ShiftsType.shift_start + '</option>';
			}
			$('select#TradeShiftId').append(html);
			});
	}

	/* 
	 * This function will activate when a physician is selected (TradeFromUserId), and update #TradeStartDate's active
	 * values (shiftDays).
	 *
	 */
		 
	function docChange(event, data) {
        $('input#TradeFromUserId').val(data.item.label);
        $('input#TradeFromUserIdHiddenDiv').val(data.item.value);
		$.getJSON('<?= $this->Html->url(array('controller' => 'shifts', 'action' => 'listShifts.json')); ?>', {id: $('#TradeFromUserIdHidden').val()}, function(json) {
			shiftDays = json;
			$("#datepicker1").datepicker('refresh');
		});
        return false;
	}
	
	</script>
	<?echo $this->Js->writeBuffer();?>