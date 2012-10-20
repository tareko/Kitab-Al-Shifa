<h1>MOHLTC Billing submission uploader</h1>
<p>Please note that this uploader will take any MOHLTC standard billing submission file and import it to your database</p>
<?php
echo $this->Form->create('Billing', array('type' => 'file')); 
echo $this->Form->input('upload', array(
		'type' => 'file'
));
echo $this->Form->end('Submit');
?>