<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Common;
use AdminController;

class FooterController extends AdminController
{
	public $scripts_arr = array(
		'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
		'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
		'plugins/knob/jquery.knob.js',
		'plugins/daterangepicker/daterangepicker.js',
		'plugins/datepicker/bootstrap-datepicker.js',
		'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
		'plugins/slimScroll/jquery.slimscroll.min.js',
		'plugins/fastclick/fastclick.js',
		'dist/js/app.min.js',
		'dist/js/pages/dashboard.js',
		'dist/js/demo.js',
	);

  public function index() {
  	$this->helper->addScript($this->scripts_arr);

  	$data['template'] = $this->config->get('config_admin_template');

  	$data['text_version'] = sprintf($this->language->get('text_version'), PEN_VERSION);
  	$data['text_copyright'] = sprintf($this->language->get('text_copyright'), html_entity_decode(PEN_WEBSITE, ENT_QUOTES, 'UTF-8'));

  	$data['scripts'] = $this->helper->getScripts();

    return $this->load->view('common/footer', $data);
  }
}
