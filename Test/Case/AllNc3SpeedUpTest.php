<?php
/**
 * Nc3SpeedUp All Test Suite
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsTestSuite', 'NetCommons.TestSuite');

/**
 * Nc3SpeedUp All Test Suite
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Nc3SpeedUp\Test\Case
 * @codeCoverageIgnore
 */
class AllNc3SpeedUpTest extends NetCommonsTestSuite {

/**
 * All test suite
 *
 * @return NetCommonsTestSuite
 */
	public static function suite() {
		$plugin = preg_replace('/^All([\w]+)Test$/', '$1', __CLASS__);
		$suite = new NetCommonsTestSuite(sprintf('All %s Plugin tests', $plugin));
		//$suite->addTestDirectoryRecursive(CakePlugin::path($plugin) . 'Test' . DS . 'Case');
		return $suite;
	}
}