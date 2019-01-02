<?php
/**
 * index view
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

パタン 5
<br>

<?php
$startTime = microtime(true);

for ($i = 0; $i < 1; $i++) {
	echo $this->NetCommonsHtml->link('link_test' . ($i + 1), '/nc3_speed_up/html_old/link_test');
	echo ' | ';
	echo $this->NetCommonsHtml->link(
		'link_test' . ($i + 1),
		['plugin' => 'nc3_speed_up', 'controller' => 'html_old', '?' => ['key' => 'aaaaa']]
	);
	echo '<br>';
}

$endTime = microtime(true);
error_log(date('Y-m-d H:i:s ') . __METHOD__ . '(' . __LINE__ . ') ' . var_export(sprintf('%.10f', ($endTime - $startTime)), true) . "\n", 3, LOGS . '/debug.log');
