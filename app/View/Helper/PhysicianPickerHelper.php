<?php 
/** This helper is designed to allow for the selection of a physician, with output for a form
 */

class PhysicianPickerHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js');
	function makePhysicianPicker($physicians) {
		echo $this->Html->script('jquery'); // Include jQuery library
		echo $this->Html->script('jquery-ui'); // Include jQuery UI library
		echo $this->Html->css('ui-lightness/jquery-ui');
		echo $this->Html->script('jquery.tagit'); // Include jQuery library
		echo $this->Html->script('jquery.autocomplete'); // Include jQuery library
		echo $this->Html->css('jquery.tagit');
?>

<script type="text/javascript">
$(function(){
    $("#tags").tagit({
	    tagSource: <?= $physicians ?>,
        allowSpaces: true,
        itemName: 'data[Shift]',
        fieldName: 'id',
        placeholderText: 'Please type a name',
    });
});
</script>


<div class="ui-widget">
	<ul id="tags">
	</ul>
</div>

<?php 
	}
}
?>