<!-- <ul> -->
 <?php 

echo $this->Form->create();

$physicians = Sanitize::clean($physicians);

echo $this->Html->script('jquery'); // Include jQuery library
$this->Js->get('#add-option-button')->event('click', 
	'var Optioncount = $(\'#poll-options > div\').size() + 1;
		var inputHtml = \'<div class="input text">'
		.str_replace("\n", "", $this->Form->input('Shift.id.\' + Optioncount + \'', array (
				'label' => 'Physician',
				'type' => 'select',
				'options' => $physicians,
				'empty' => true)))
		.'</div>\';
    	event.preventDefault();
    	$(\'#poll-options\').append(inputHtml);
    ');
?>
    
<div id="poll-options">
	<?php echo $this->Form->input('Shift.id.0', array (
			'options' => $physicians,
			'empty' => true)) ?>
</div>

<a href=# id="add-option-button">Add more physicians</a>

<?php 
echo $this->Form->submit();

echo $this->Js->writeBuffer(); // Write cached scripts ?>
<!-- </ul> -->