<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/FrontController.php';

class Custom404 extends FrontController {

	/*=======================================
	=            Custom 404 Page            =
	=======================================*/
	
	public function __construct()
	{
        parent::__construct();
        $this->class  = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
	}

	/*======================================
	=            Index Function            =
	======================================*/
	
	public function index()
	{
		$this->global['title']           = '404 - Page not found! | '.$this->title;

		$data = array();

		$this->output->set_status_header('404');

		$this->loadViews("custom404_html", $this->global, $data, NULL);
	}

	/*=====  End of Index Function  ======*/

}

	/*=====  End of Custom 404 Page  ======*/