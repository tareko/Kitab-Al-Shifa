<?php
	if ($admin) { ?>
		<br/><br/>
		<h2>Administrative functions:</h2>
		<ul>
			<li><?php echo $this->Html->link('list', array('controller' => 'shifts')); ?> - for looking at and editing single entries</li>
			<li><?php echo $this->Html->link('Web calendar (edit mode)', array('controller' => 'shifts', 'action' => 'calendarEdit')); ?> - for looking at and editing many entries</li>
			<li><?php echo $this->Html->link('Shift importer', array('controller' => 'shifts', 'action' => 'import')); ?> - for importing entries from csv</li>
			<li><?php echo $this->Html->link('Cash trades', array('controller' => 'trades', 'action' => 'cashList')); ?> - List of cash trades (<?php echo $this->Html->link('spreadsheet', array('controller' => 'trades', 'action' => 'cashList', 'ext' => 'csv')); ?>)</li>
		</ul>
		<br/><br/>
		<h2>!!PROCEED WITH CAUTION: DRAGONS AHEAD!!</h2>
		<ul>
			<li><?php echo $this->Html->link('Locations', array('controller' => 'locations')); ?></li>
			<li><?php echo $this->Html->link('Physicians', array('controller' => 'users')); ?></li>
			<li><?php echo $this->Html->link('Shifts types', array('controller' => 'shifts_types')); ?> - Management of shift types</li>
			<li><?php echo $this->Html->link('Calendars', array('controller' => 'calendars')); ?> - for creating and editing calendar blocks</li>
			<li><?php echo $this->Html->link('Groups', array('controller' => 'groups')); ?> - for managing groups of physicians / staff</li>
		</ul>
<?php
 	}
