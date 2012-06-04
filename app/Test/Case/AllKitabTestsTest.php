<?php

class AllKitabTestsTest extends PHPUnit_Framework_TestSuite {
	/**
	* Suite define the tests for this suite
	*
	* @return void
	*/
	public static function suite() {
		$suite = new CakeTestSuite('All Kitab tests');
		$suite->addTestDirectoryRecursive(TESTS . 'Case' . DS);
		return $suite;
	}
}