<?php
/**
 * Frame表示のrequestAction用のHelper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * Frame表示のrequestAction用のHelper
 *
 * @package NetCommons\NetCommons\View\Helper
 */
class FrameRequestActionHelper extends AppHelper {

/**
 * コンストラクタ
 *
 * 当クラスを使用する際、コントローラからHelperに値をセットする必要がある。
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = []) {
		$settings += [
			'routingFormat' => ['/:plugin/:controller/:action'],
		];
		parent::__construct($View, $settings);
	}

/**
 * requestAction()のオーバライド
 *
 * $urlは、/:plugin/:controller/:action?xxxx=yyyy&xxxx2=yyyy2 形式とする。
 *
 * @param string $url $url String or array-based URL. Unlike other URL arrays in CakePHP, this
 *    URL will not automatically handle passed and named arguments in the $url parameter.
 * @param array $extra if array includes the key "return" it sets the AutoRender to true. Can
 *    also be used to submit GET/POST data, and named/passed arguments.
 * @return Boolean true or false on success/failure, or contents
 *    of rendered action if 'return' is set in $extra.
 */
	public function requestAction($url, $extra = array()) {
		if (empty($url)) {
			return false;
		}

		$params = $this->_parseParams($url);
		if (! $params) {
			return parent::requestAction($url, $extra);
		}

		if (($index = array_search('return', $extra)) !== false) {
			$extra['return'] = 0;
			$extra['autoRender'] = 1;
			unset($extra[$index]);
		}

		$extra += array('autoRender' => 0, 'return' => 1, 'bare' => 1, 'requested' => 1);
		$data = isset($extra['data']) ? $extra['data'] : null;
		unset($extra['data']);

		$request = new CakeRequest($url);

		if (isset($data)) {
			$request->data = $data;
		}

		$this->_setParams($request, $params, $extra);
		$result = $this->_dispatch($request, new CakeResponse(), $extra);
		return $result;
	}

/**
 * Dispatches and invokes given Request, handing over control to the involved controller. If the controller is set
 * to autoRender, via Controller::$autoRender, then Dispatcher will render the view.
 *
 * Actions in CakePHP can be any public method on a controller, that is not declared in Controller. If you
 * want controller methods to be public and in-accessible by URL, then prefix them with a `_`.
 * For example `public function _loadPosts() { }` would not be accessible via URL. Private and protected methods
 * are also not accessible via URL.
 *
 * If no controller of given name can be found, invoke() will throw an exception.
 * If the controller is found, and the action is not found an exception will be thrown.
 *
 * @param CakeRequest $request Request object to dispatch.
 * @param CakeResponse $response Response object to put the results of the dispatch into.
 * @return string|null if `$request['return']` is set then it returns response body, null otherwise
 * @throws MissingControllerException When the controller is missing.
 */
	protected function _dispatch(CakeRequest $request, CakeResponse $response) {
		$controller = $this->_getController($request, $response);

		if (!($controller instanceof Controller)) {
			throw new MissingControllerException(array(
				'class' => Inflector::camelize($request->params['controller']) . 'Controller',
				'plugin' => empty($request->params['plugin']) ? null : Inflector::camelize($request->params['plugin'])
			));
		}

		$response = $this->_invoke($controller, $request);
		if (isset($request->params['return'])) {
			return $response->body();
		}
	}

/**
 * Applies Routing and additionalParameters to the request to be dispatched.
 * If Routes have not been loaded they will be loaded, and app/Config/routes.php will be run.
 *
 * @param CakeRequest $request Request object to dispatch.
 * @param array $additionalParams Settings array ("bare", "return") which is melded with the GET and POST params
 * @return void
 */
	protected function _setParams(CakeRequest $request, $params, $additionalParams = []) {
		$request->addParams($params);
		if (!empty($additionalParams)) {
			$request->addParams($additionalParams);
		}
	}

/**
 * Applies Routing and additionalParameters to the request to be dispatched.
 * If Routes have not been loaded they will be loaded, and app/Config/routes.php will be run.
 *
 * @param string $url $url String or array-based URL. Unlike other URL arrays in CakePHP, this
 *    URL will not automatically handle passed and named arguments in the $url parameter.
 * @return array|false
 */
	protected function _parseParams($url) {
		if (strpos($url, '?') !== false) {
			list($url, $queryParameters) = explode('?', $url, 2);
			parse_str($queryParameters, $queryParameters);
		}
		if (substr($url, -1, 1) === '/') {
			$url = substr($url, 0, -1);
		}
		if (substr($url,0, 1) !== '/') {
			$url = '/' . $url;
		}
		$urlArr = explode('/', $url);
		$countUrlArr = count($urlArr);

		$params = false;
		foreach ($this->settings['routingFormat'] as $format) {
			$formatArr = explode('/', $format);
			if ($countUrlArr === count($formatArr)) {
				for ($i = 1; $countUrlArr > $i; $i++) {
					$params[substr($formatArr[$i], 1)] = $urlArr[$i];
				}
				$params += ['named' => [], 'pass' => []];
				break;
			}
		}
		return $params;
	}

/**
 * Get controller to use, either plugin controller or application controller
 *
 * @param CakeRequest $request Request object
 * @param CakeResponse $response Response for the controller.
 * @return mixed name of controller if not loaded, or object if loaded
 */
	protected function _getController($request, $response) {
		$ctrlClass = $this->_loadController($request);
		if (!$ctrlClass) {
			return false;
		}
		$reflection = new ReflectionClass($ctrlClass);
		if ($reflection->isAbstract() || $reflection->isInterface()) {
			return false;
		}
		return $reflection->newInstance($request, $response);
	}

/**
 * Load controller and return controller class name
 *
 * @param CakeRequest $request Request instance.
 * @return string|bool Name of controller class name
 */
	protected function _loadController($request) {
		$pluginName = $pluginPath = $controller = null;
		if (!empty($request->params['plugin'])) {
			$pluginName = $controller = Inflector::camelize($request->params['plugin']);
			$pluginPath = $pluginName . '.';
		}
		if (!empty($request->params['controller'])) {
			$controller = Inflector::camelize($request->params['controller']);
		}
		if ($pluginPath . $controller) {
			$class = $controller . 'Controller';
			App::uses('AppController', 'Controller');
			App::uses($pluginName . 'AppController', $pluginPath . 'Controller');
			App::uses($class, $pluginPath . 'Controller');
			if (class_exists($class)) {
				return $class;
			}
		}
		return false;
	}

/**
 * Initializes the components and models a controller will be using.
 * Triggers the controller action, and invokes the rendering if Controller::$autoRender
 * is true and echo's the output. Otherwise the return value of the controller
 * action are returned.
 *
 * @param Controller $controller Controller to invoke
 * @param CakeRequest $request The request object to invoke the controller for.
 * @return CakeResponse the resulting response object
 */
	protected function _invoke(Controller $controller, CakeRequest $request) {
		$controller->constructClasses();
		$controller->startupProcess();

		$response = $controller->response;
		$render = true;
		$result = $controller->invokeAction($request);
		if ($result instanceof CakeResponse) {
			$render = false;
			$response = $result;
		}

		if ($render && $controller->autoRender) {
			$response = $controller->render();
		} elseif (!($result instanceof CakeResponse) && $response->body() === null) {
			$response->body($result);
		}
		$controller->shutdownProcess();

		return $response;
	}

}
