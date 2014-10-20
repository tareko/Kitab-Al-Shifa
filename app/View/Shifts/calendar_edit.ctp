<?php 
echo $this->Html->script('jquery');
echo $this->Html->script('jquery.fixedheadertable');

echo $this->Form->create('Shift', array(
    'url' => array('action' => 'calendarEdit') + $this->request->params['named']
));
echo $this->Form->input('calendar', $calendars);
echo $this->Form->submit(__('Search', true), array('div' => false));
echo $this->Form->end();
?>

<?= $this->Calendar->makeCalendarEdit($masterSet); ?>

    <script type='text/javascript'>//<![CDATA[ 
$(function(){
	$('#Calendar').fixedHeaderTable({
		footer: false,
		fixedColumns: 1,
		width: '100%',
		height: '100%',
	})
});

//]]>  

</script>