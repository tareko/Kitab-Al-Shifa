<ul>
<?php 
	foreach ($physicians as $id => $physician) {
		echo "<li>" . $this->Html->link($physician, array('controller' => 'shifts', 'action' => 'icsView', "id[id]:" .$id)) . "</li>";
	}
?>
</ul>