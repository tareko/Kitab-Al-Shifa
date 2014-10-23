<?php 
echo $this->Html->script('jquery'); // Include jQuery library
echo $this->Html->script('jquery-ui'); // Include jQuery UI library
echo $this->Html->css('ui-lightness/jquery-ui');


echo $this->Form->create();
?>


    <div class="btn-group" data-toggle="buttons">

        <label class="btn btn-primary">

            <input type="radio" name="options" value="1"> Option 1

        </label>

        <label class="btn btn-primary">

            <input type="radio" name="options" value="2"> Option 2

        </label>

        <label class="btn btn-primary">

            <input type="radio" name="options" value="3"> Option 3

        </label>

    </div>


<div class="btn-group" data-toggle="buttons">
	<?php
	$this->Js->get('[for=\'ShiftShiftsToShowAll\']')->event('click', '$(\'#pick-doctor\').hide()', array ('stop' => false));
	$this->Js->get('[for=\'ShiftShiftsToShowMine\']')->event('click', '$(\'#pick-doctor\').hide()', array ('stop' => false));
	$this->Js->get('[for=\'ShiftShiftsToShowSome\']')->event('click', '$(\'#pick-doctor\').show()', array ('stop' => false));
	
	echo $this->Form->radio('Shifts to show', array ('mine' => 'My shifts only', 'all' => 'Everybody\'s shifts', 'some' => 'Let me pick'),
			array (
					'name' => 'data[Shift][list]',
					'label' => array(
							'class' => 'radio-inline btn btn-primary'
			)));
	?>
</div>
<div id="pick-doctor" style="display:none">
	<?= $this->PhysicianPicker->makePhysicianPicker($physicians, 'data[Shift]'); ?>
</div>

<fieldset>
	<legend>Calendar to show</legend>
	<?php 
		echo $this->Form->input('calendar', array(
				'required' => true,
				'label' => false,
				'options' => $calendars));
	?>
</fieldset>

	<?= $this->Form->checkbox('archive');?>Include archived calendars
	<?= $this->Js->get('#ShiftArchive')->event('click', 'shiftArchive()', array ('stop' => false));?>

<?php echo $this->Form->radio('Output Format', array ('webcal' => 'Web calendar', 'list' => 'List of shifts', 'print' => 'Print copy', 'ics' => 'ICS'),
		array (
				'name' => 'data[Shift][output]')
		);
?>
<?= $this->Form->submit();?>

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
