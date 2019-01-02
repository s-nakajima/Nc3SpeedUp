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

パタン 8
<br>

<?php
for ($i = 0; $i < 200; $i++) {
	echo $this->element('Nc3SpeedUp.ViewClass/element_test'); echo $i + 1; echo '<br>';
}

