<?php 
echo $this->Html->script('jquery');
echo $this->Html->script('jquery.stickytableheaders');

echo $this->Form->create('Shift', array(
    'url' => array('action' => 'calendarView') + $this->request->params['named']
));
echo $this->Form->input('calendar', $calendars);
echo $this->Form->submit(__('Search', true), array('div' => false));
echo $this->Form->end();
?>

<?= $this->Calendar->makeCalendarView($masterSet); ?>

    <script type='text/javascript'>//<![CDATA[ 

$(function(){
    $("table").stickyTableHeaders();
});

//]]>  

</script>