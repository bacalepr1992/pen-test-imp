<?php
/* Define PenCMS */
define('PEN_VERSION', '1.0.0');
define('PEN_WEBSITE', '<a href="http://pencms.com">PenCMS.com</a>');
define('PEN_AUTHOR', 'vdhoangson');
define('DIR_APP',  app_path() . '/pencms/');
define('DIR_LANGUAGE', DIR_APP . 'languages/');
define('DIR_CONTROLLER', DIR_APP . 'controllers/');
define('DIR_MODEL', DIR_APP . 'models/');
define('DIR_TEMPLATE', DIR_APP . 'themes/');
define('DIR_MODULE', DIR_APP . 'modules/');
define('DIR_MEDIA', public_path() . '/pencms/media/');
define('DIR_CORE_CONTROLLER', __DIR__ . '/controller/');
?>