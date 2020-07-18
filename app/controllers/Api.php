<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/libraries/REST_Controller.php';
class Api extends REST_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array(
			'form',
			'utility',
			'url',
			'security'
		));
		$this->load->library(array(
			'email',
			'form_validation',
			'recaptcha'
		));
        $this->load->model('Api_model');
		$this->defaultdata   = array();
        $this->defaultobject = new stdClass();
	}

	public function todaysgole_get($id){ 

		try{
			$userid =$id;

			$datalist = $this->Api_model->get_todaysgole($userid);

			if($datalist) {
				$this->response(
					array(
						'status' => true,
						'data' => $datalist,
						'message' => 'data found'
					), REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					array(
					'status' => false,
					'data' => $this->defaultobject,
					'message' => 'data not found'
					), REST_Controller::HTTP_OK
				);
			}
		} catch(Exception $e) {
			$this->response(
				array(
					'status' => false,
					'data' => $this->defaultobject,
					'message' => 'Something went Wrong!!'
				), REST_Controller::HTTP_NOT_FOUND
			);
		}
	}


	public function previousgole_get($id){ 

		try{
			$userid =$id;

			$datalist = $this->Api_model->get_previousgole($userid);

			if($datalist) {
				$this->response(
					array(
						'status' => true,
						'data' => $datalist,
						'message' => 'data found'
					), REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					array(
					'status' => false,
					'data' => $this->defaultobject,
					'message' => 'data not found'
					), REST_Controller::HTTP_OK
				);
			}
		} catch(Exception $e) {
			$this->response(
				array(
					'status' => false,
					'data' => $this->defaultobject,
					'message' => 'Something went Wrong!!'
				), REST_Controller::HTTP_NOT_FOUND
			);
		}
	}

}