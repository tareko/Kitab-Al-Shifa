<?php 
/** This helper is designed to allow for the selection of a physician, with output for a form
 */

class PhysicianPickerHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js');
	function makePhysicianPicker($groups = NULL, $name = NULL, $fieldName = NULL) {
		echo $this->Html->script('jquery'); // Include jQuery library
		echo $this->Html->script('jquery-ui'); // Include jQuery UI library
		echo $this->Html->css('ui-lightness/jquery-ui');
		echo $this->Html->script('jquery.tagit'); // Include jQuery library
		echo $this->Html->css('jquery.tagit');
?>

<script type="text/javascript">
$(function(){
    $("#tags").tagit({
	    tagSource: '<?= $this->Html->url(array('controller' => 'users', 'action' => 'listUsers.json', '?' => array('full' => '1'))); ?>',
        allowSpaces: true,
        itemName: '<?php if ($name) {
        	echo $name;
		}
		else {
			echo 'data[Shift]';	
		}
		?>',
		fieldName: '<?php if ($fieldName) {
	    	echo $fieldName;
		}
		else {
			echo 'id';	
		}
		?>',
        placeholderText: 'Please type a name',
        minLength: '3'
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