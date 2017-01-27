<?php
include __DIR__ . '/Library/PenConfig.php';
use \PenFramework\Library\PenConfig;

if (! function_exists('pen_asset')) {
	function admin_asset($path){
		$config = new PenConfig();
		$template = $config->get('config_admin_template');

		return app('url')->asset('PenCMS/themes/admin/' . $template . '/' .$path);
	}

	function front_asset($path){
		$config = new PenConfig();
		$template = $config->get('config_front_template');

		return app('url')->asset('PenCMS/themes/front/' . $template . '/' .$path);
	}
}
?>