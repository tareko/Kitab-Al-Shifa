<p>Please confirm that you wish to take this shift:</p>
<ul>
	<li>
		<?=$shift['Shift']['date'] .' '. $shift['ShiftsType']['shift_start'] .' to '. $shift['ShiftsType']['shift_end'] .' from '. $shift['User']['name'] .' at '. $shift['ShiftsType']['Location']['location']?>
	
</li></ul></p>


<a href="<?= $this->Html->url(array(
			'controller' => 'trades',
			'action' => 'market_take',
			'?' => array(
				'id' => $shift['Shift']['id'],
				'confirm' => 1)
		));?>"><button class="btn btn-default" type="submit">I confirm!</button></a>
