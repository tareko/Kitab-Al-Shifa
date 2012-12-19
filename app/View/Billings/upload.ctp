<h1>MOHLTC Billing submission uploader</h1>
<p>Please note that this uploader will take any MOHLTC standard billing submission file and import it to your database</p>
<?php
if (!empty($status)) {
	foreach ($status as $status) {
		echo $status . "<br/>";
	}
}


echo $this->Form->create('Billing', array('type' => 'file')); 
echo $this->Form->input('upload.', array(
		'type' => 'file',
		'multiple'
));
echo "<p>You can upload up to " . ini_get('max_file_uploads') . " files totalling " . ini_get('upload_max_filesize') .".</p>";
echo $this->Form->end('Submit');
?>