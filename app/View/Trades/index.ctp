<h2><?php echo __('Make a Trade'); ?></h2>

<?= $this->Form->create('Trade', array('class' => 'form-horizontal'));?>

<?php 
$recipientError = '';
$recipientErrorMessage = '';
$originatorError = '';
$originatorErrorMessage = '';

	if ($recipientNotPresent) {
		$recipientError = 'error';
		$recipientErrorMessage = '<div class="error-message">Please enter at least one recipient</div>'; 
	}

	if ($originatorNotPresent) {
		$originatorError = 'error';
		$originatorErrorMessage = '<div class="error-message">Who is offering this trade?</div>';
	}
	
	if ($checkDuplicate) {
		echo '<div class="error">This shift is already in the process of being traded! Please cancel the pre-existing trade before trying to trade this shift again</div>';
	}
?>

<div class="col-med-10">
	<div class="form-inline">
		<div class="form-group">
			<?php
			echo $this->Form->input('from_user_id', array(
					'type' => 'text', 
					'placeholder' => "me",
					'label' => __('From'),
					'class' => 'form-control',
					'div' => 'TradeFromUserIdDiv required' . $originatorError));
	
			echo $this->Form->input('Trade.user_id', array(
					'type' => 'text', 
					'default' => $usersId, 
					'div' => 'input text TradeFromUserIdHiddenDiv',
					'type' => 'hidden',
					'label' => false,
					'id' => 'TradeFromUserIdHidden'));
			?>
		</div>
		<div class="form-group required">
			<label for="datepicker1"><?= __('Date of shift')?></label>
			<?php
			echo $this->DatePicker->makeDatePicker('#TradeFromUserIdHidden', 1);?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('shift_id', array(
					'label' => __('Time of shift'),
					'class' => 'form-control'));
			?>
		</div>
	</div>
</div>
<br />
<div class="col-med-10">
	<div class="form-inline">
		<div class="form-group <?= $recipientError?>">
			<div class="required">
				<label><?=__('Offered to')?></label>
			</div>
				<div id="usergroupSelected" class="checkbox">
					<?php 
				
					// Allow user to send request to entire group of users
					echo $this->Form->select('usergroup', $groupList, array(
						'multiple' => 'checkbox',
						'class' => 'checkbox'
					));?>
				</div>
				<?php
				echo $this->Html->div('TradesDetail.user_id',
					$this->PhysicianPicker->makePhysicianPicker(null, 'data[TradesDetail]', 'user_id'),
						array('id' => 'pick-doctor'));
				?>
				<?=$recipientErrorMessage?>
		</div></div>
		<div class="form-group">
			<div class="checkbox">
				<?php echo $this->Form->checkbox('excludeWorking', array('checked' => true));?>
				Exclude doctors working for 8 hours before or after this shift.
			</div>
		</div>
	</div>
</div>
<br/>
	<div class="form-group">
		<?php echo $this->Form->textarea('messageBody', array(
			'class' => 'form-control',
			'rows' => '3',
			'placeholder' => 'Enter a message explaining why you\'d like to trade this shift'));?>
	</div>	
	<div class="block">
		<?php echo $this->Form->end(__('Submit'));?>
	</div>

<?= $this->Js->get("#usergroupSelected input")->event('change', 'addGroupUsers(event)', array ('stop' => false)); ?>
	
	

	<script type="text/javascript">
	$(document).ready(function(){
		//Prevent enter from submitting form
		 $(window).keydown(function(event){
			    if(event.keyCode == 13) {
			      event.preventDefault();
			      return false;
			    }
			  });

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

	/*
	 * This function populates the physicians when a group is selected
	 *
	 *
	 */
		function addGroupUsers(event) {
			var add = 0;
	        if($("#usergroupSelected input:checkbox:checked").length > 0) {
				$("input#TradeExcludeWorking").attr("disabled", true);
	        }
	        else {
	        	$("input#TradeExcludeWorking").attr("disabled", false);
	        }
		    
	        if($("input#" + event.target.id).is(":checked")) {
		        var add = 1;
	        }
	        
	        // Add shift for exclusion if the option to exclude shifts is selected.
	        if ($("input#TradeExcludeWorking").is(':checked')) {
		        var exclude = $("select#TradeShiftId option").val()
	        }
	        else { var exclude = undefined; }

	        $.getJSON('<?= Router::url(array(
					'controller' => 'users', 
					'action' => 'listUsers.json'));
			?>', {
					full: "1",
					group: event.target.id.slice(14),
					excludeShift: exclude
			}, 
				function(data){
					var len = data.length;
					for (var i = 0; i< len; i++) {
						if (add == 1) {
				        	$("#tags").tagit("createTag", data[i].value, data[i].label);
						} else {		        
				        	$("#tags").tagit("removeTagByLabel", data[i].value);
				        }
					}
				});
				
		    }
		</script>
	<?echo $this->Js->writeBuffer();?>