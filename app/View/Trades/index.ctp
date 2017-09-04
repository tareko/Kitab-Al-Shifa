<h2><?php echo __('Make a Trade'); ?></h2>

<?= $this->Form->create('Trade', array('class' => 'form-horizontal'));?>

<?php 
$errors = '';
foreach($this->validationErrors as $assoc) {
    foreach ($assoc as $k => $v) {
        $errors .= $this->Html->tag('li', $v[0]);
    }
}
?>
<?php if (!empty($errors)) {?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?= $this->Html->tag('ul', $errors);?>
    </div>
<?php }?>

<div class="col-med-10">
	<div class="form-inline">
		<div class="form-group">
			<?php
			echo $this->Form->input('from_user_id', array(
					'type' => 'text', 
					'placeholder' => "me",
					'label' => __('From'),
					'class' => 'form-control',
					'div' => 'TradeFromUserIdDiv required'));
	
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
					'class' => 'form-control',
					'error' => false));
			?>
		</div>
	</div>
</div>
<br />
<div class="col-med-10">
	<div class="form-inline">
		<div class="form-group">
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
		</div>
	</div>
<div class="col-med-10">
	<div class="form-horizontal">
		<div class="checkbox">
			<label>
				<?php echo $this->Form->checkbox('excludeWorking', array('checked' => true));?>
				Exclude doctors working for 8 hours before or after this shift.
			</label>
		</div>
		<div class="form-group">
				<?php
				echo $this->Html->div('TradesDetail.user_id',
					$this->PhysicianPicker->makePhysicianPicker(null, 'data[TradesDetail]', 'user_id'),
						array('id' => 'pick-doctor'));
				?>
		</div></div>
	</div>
</div>
<br/>
<div class="col-med-6">
	<div class="form-group">
		<?php echo $this->Form->textarea('message', array(
			'class' => 'form-control',
			'rows' => '5',
			'placeholder' => 'Enter a message explaining why you\'d like to trade this shift'));?>
	</div>	
	<div class="form-group">
		<div class="checkbox">
			<label>
				<?php echo $this->Form->checkbox('confirmed', array('checked' => false));?>
				Don't send confirmation messages - all parties have already agreed to this trade.
			</label>
		</div>
	</div>

	<div class="form-group">
		Trade this shift for: <div class="btn-group" data-toggle="buttons">
			<?php
				echo $this->Form->radio('TradeConsideration', array (
						'0' => 'Cash',
						'1' => 'Trade',
						'2' => 'Future consideration'),
						array (
								'name' => 'data[Trade][consideration]',
								'class' => 'btn btn-primary',
								'value' => 1, 
								'legend' => false,
								'hiddenField' => false
						));
				?>
		</div>
	</div>
</div>
	<div class="block">
		<?php echo $this->Form->end();?>
	</div>
    <button type="submit" class="btn btn-primary">Submit</button>

<?= $this->Js->get("#usergroupSelected input")->event('change', 'addGroupUsers(event)', array ('stop' => false)); ?>
	
	

	<script type="text/javascript">
	$(document).ready(function(){


		//Add active class to default trade consideration
		$( "label[for=TradeTradeConsideration1]" ).addClass( "active" );
		
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
	<?= $this->Js->writeBuffer();?>
