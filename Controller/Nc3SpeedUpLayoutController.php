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

//App::uses('Controller', 'Controller');
//App::uses('Nc3SpeedUpAppController', 'Nc3SpeedUp.Controller');
App::uses('Current', 'NetCommons.Utility');
App::uses('NetCommonsUrl', 'NetCommons.Utility');
App::uses('SiteSettingUtil', 'SiteManager.Utility');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Nc3SpeedUp Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Nc3SpeedUp\Controller
 */
class Nc3SpeedUpLayoutController extends Controller {

/**
 * use layout
 *
 * @var string
 */
	public $layout = 'NetCommons.default';

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
		'Html' => array(
			'className' => 'NetCommons.SingletonViewBlockHtml'
		),
		'NetCommons.NetCommonsHtml',
	);

/**
 * index
 *
 * @return void
 */
	public function index() {
	}

}
