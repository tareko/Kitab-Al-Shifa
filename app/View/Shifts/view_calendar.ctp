<?php 
echo $this->Html->script('jquery');
echo $this->Html->script('jquery.stickytableheaders');

echo $this->Form->create('Shift', array(
    'url' => array_merge(array('action' => 'viewCalendar'), $this->params['pass'])
));
echo $this->Form->input('calendar', $calendars);
echo $this->Form->submit(__('Search', true), array('div' => false));
echo $this->Form->end();
?>

<?= $this->Calendar->makeCalendar($masterSet); ?>

    <script type='text/javascript'>//<![CDATA[ 

$(function(){
    $("table").stickyTableHeaders();
});

//]]>  

</script>