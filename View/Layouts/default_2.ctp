<?php
/**
 * Pages template.
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>
<!DOCTYPE html>
<html lang="<?php echo Configure::read('Config.language') ?>" ng-app="NetCommonsApp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo (isset($pageTitle) ? h($pageTitle) : ''); ?></title>

		<?php
			echo $this->html->meta('icon', '/net_commons/favicon.ico');
			echo $this->fetch('meta');

//			echo $this->element('NetCommons.common_css');
			echo $this->NetCommonsHtml->css(
				array(
					'/components/bootstrap/dist/css/bootstrap.min.css',
					'/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
					'/net_commons/css/style.css',
				),
				array('plugin' => false, 'inline' => true, 'once' => false)
			);

			echo $this->fetch('css');
//			echo $this->element('NetCommons.common_theme_css');
			echo $this->NetCommonsHtml->css(
				array(
					'bootstrap.min.css',
					'style',
				),
				array('plugin' => false, 'inline' => true, 'once' => false)
			);
//			echo $this->NetCommonsHtml->css(
//				array(
//					'/frames/css/style.css',
//					'/pages/css/style.css',
//					'/users/css/style.css',
//					'/user_attributes/css/style.css',
//					'/wysiwyg/css/style.css',
//				)
//			);

//			echo $this->element('NetCommons.common_js');
			echo $this->NetCommonsHtml->script(
				array(
					'/components/jquery/dist/jquery.min.js',
					'/components/bootstrap/dist/js/bootstrap.min.js',
					'/components/angular/angular.min.js',
					'/components/angular-animate/angular-animate.js',
					'/components/angular-bootstrap/ui-bootstrap-tpls.min.js',
					'/net_commons/js/base.js',
				),
				array('plugin' => false, 'inline' => true, 'once' => false)
			);
		?>

		<script>
		<?php
		$nc3Url = substr(Router::url('/'), 0, -1);
		?>
		NetCommonsApp.constant('NC3_URL', '<?php echo h($nc3Url); ?>');
		NetCommonsApp.constant('LOGIN_USER', <?php echo json_encode(['id' => Current::read('User.id')], JSON_FORCE_OBJECT); ?>);
		<?php
		$titleIconUrl = Configure::read('App.titleIconUrl');
		if (! $titleIconUrl) :
			$titleIconUrl = $nc3Url;
		endif;
		?>
		NetCommonsApp.constant('TITLE_ICON_URL', '<?php echo h($titleIconUrl); ?>');
		</script>

		<?php
			echo $this->fetch('script');
		?>
	</head>

	<body ng-controller="NetCommons.base">
		<?php echo $this->Flash->render(); ?>

		<?php // echo $this->element('NetCommons.common_header'); ?>

		<main class="container" ng-init="hashChange()">
			<?php echo $this->fetch('content'); ?>
		</main>

		<?php echo $this->element('NetCommons.common_footer'); ?>
	</body>
</html>
