<?php 
echo $this->Html->script('jquery'); // Include jQuery library
echo $this->Html->script('jquery-ui'); // Include jQuery UI library
echo $this->Html->css('ui-lightness/jquery-ui');
?>

<h2>Which calendar do you want to see?</h2>
<div class="form-group col-sm-6 col-xs-12 col-md-6 col-lg-6">
<?= $this->Form->create();?>

<div class="btn-group" data-toggle="buttons">
<?php
	$this->Js->get('[for=\'ShiftShiftsToShowAll\']')->event('click', '$(\'#pick-doctor\').hide()', array ('stop' => false));
	$this->Js->get('[for=\'ShiftShiftsToShowMine\']')->event('click', '$(\'#pick-doctor\').hide()', array ('stop' => false));
	$this->Js->get('[for=\'ShiftShiftsToShowSome\']')->event('click', '$(\'#pick-doctor\').show()', array ('stop' => false));
	
	echo $this->Form->radio('Shifts to show', array ('mine' => 'My shifts only', 'all' => 'Everybody\'s shifts', 'some' => 'Let me pick'),
			array (
					'name' => 'data[Shift][list]',
					'class' => 'btn btn-primary',
					'legend' => false,
					'hiddenField' => false
			));
	?>
</div>

<div id="pick-doctor" style="display:none">
	<?= $this->PhysicianPicker->makePhysicianPicker($physicians, 'data[Shift]'); ?>
</div>

<div>&nbsp;</div>
<div>
	<?php 
		echo $this->Form->input('calendar', array(
				'required' => true,
				'label' => false,
				'options' => $calendars,
				'class' => 'form-control'));
	?>

	<?= $this->Form->input('archive', array(
				'type' => 'checkbox',
				'label' => 'Include archived calendars',
			
	));?>
	<?= $this->Js->get('#ShiftArchive')->event('click', 'shiftArchive()', array ('stop' => false));?>
</div>
	<div class="btn-group" data-toggle="buttons">
	
<?php echo $this->Form->radio('Output Format', array ('webcal' => 'Web calendar', 'list' => 'List of shifts', 'print' => 'Print copy', 'ics' => 'ICS'),
		array (
				'name' => 'data[Shift][output]',
				'class' => 'btn btn-primary',
				'legend' => false,
				'hiddenField' => false
));
?>
</div>
<?= $this->Form->submit();?>
</div>

<script>
	function shiftArchive(data) {
		if ($('input[name="data[Shift][archive]"]').is(':checked') == true) { 
			var endDate = 'archive';
		} else {
			var endDate = 'current';
		}
		$.getJSON('<?= $this->Html->url(array('controller' => 'shifts', 'action' => 'listCalendars.json')); ?>', {end_date: endDate}, function(data){
				$("select#ShiftCalendar").empty();
				var html = '';
				var len = data.calendars.length;
				for (var i = 0; i< len; i++) {
					html += '<option value="' + data.calendars[i].Calendar.id + '">' + data.calendars[i].Calendar.name + '</option>';
				}
				$('select#ShiftCalendar').append(html);
			});
	}
</script>	

	
<?= $this->Js->writeBuffer(); // Write cached scripts ?>