<?php
/**
 * Nc3SpeedUp Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * Nc3SpeedUp Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Nc3SpeedUp\Controller
 * @see https://github.com/s-nakajima/Nc3SpeedUp/blob/master/README.md#パタン-1
 */
class RequestActionCase2Controller extends AppController {

/**
 * use layout
 *
 * @var string
 */
	public $layout = 'Nc3SpeedUp.NetCommons/default';

/**
 * use theme
 *
 * @var string
 */
	public $theme = 'default';

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'Security'
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'NetCommonsHtml' => array(
			'className' => 'Nc3SpeedUp.Nc3SpeedUpHtml'
		),
		'Nc3SpeedUp.FrameRequestAction'
	);

/**
 * The name of the View class this controller sends output to.
 *
 * @var string
 */
	public $viewClass = 'Nc3SpeedUp.Nc3SpeedUp';

/**
 * index
 *
 * @return void
 */
	public function index() {
	}

}
