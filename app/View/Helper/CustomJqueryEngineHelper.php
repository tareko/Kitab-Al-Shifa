<?php
App::import('Helper','JqueryEngine');

class CustomJqueryEngineHelper extends JqueryEngineHelper {
	public function autocomplete($options = '') {
		$template = '%s.autocomplete({%s});';
		// don't escape the 'select' or 'search' functions
		return $this->_methodTemplate('autocomplete', $template, array());
		
	}
}
?>