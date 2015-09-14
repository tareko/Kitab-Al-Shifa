<h1>Shift uploader</h1>
<p>Please note that this uploader will take a CSV file *only* and import it to your shifts database</p>
<?php
if (!empty($status)) {
	foreach ($status as $status) {
		echo $status . "<br/>";
	}
}

echo $this->Form->create('Shift', array('type' => 'file')); 
echo $this->Form->input('upload.', array(
		'type' => 'file',
		'multiple',
		'label' => 'Select file to upload'
));
echo "<p>You can upload up to " . ini_get('max_file_uploads') . " files totalling " . ini_get('upload_max_filesize') .".</p>";

echo $this->Form->input('calendar', array(
		'required' => true,
		'label' => 'Which calendar\'s start and end dates would you like to use?',
		'options' => $calendars,
		'class' => 'form-control'));

echo "<br/> <br/>";

echo $this->Form->input('delete', array(
		'required' => true,
		'label' => 'Would you like to delete all current shifts within those dates?',
		'options' => array(0 => 'Do not delete', 1 => 'Delete all items'),
		));

echo $this->Form->end('Submit');

?>
<h1>Instructions</h1>
<ul>
	<li>Calendar must not yet be published</li>
	<li>Use the template for the calendar by going adding .csv to the end of the calendar</li>
	<li>The first column will be ignored, but is for your edification</li>
	<li>The first 3 rows will also be ignored</li>
	<li>The name must match the *display name* of the person assigned the shift</li>
	<li>If blank, no entry will be created.</li>
</ul>