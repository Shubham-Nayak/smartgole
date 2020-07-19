<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/AdminBaseController.php'; 

class Welcome extends AdminBaseController {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('email', 'form_validation','encrypt','recaptcha'));
		$this->load->helper(array(
			'form',
			'security',
			'captcha'
		));
	}	
	public function index() {
		$data['title'] = ' Admin login | '.$this->title;
		$random_number   = substr(number_format(time() * rand(), 0, '', ''), 0, 5);
		$vals            = array(
			'word' => $random_number,
			'img_path' => './assets/captcha/',
			'img_url' => base_url() . '/assets/captcha/',
			'img_width' => 100,
			'img_height' => 49,
			'expiration' => 7200
		);
		$data['captcha'] = create_captcha($vals);
		$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		$this->load->view('loginhtml',$data);
	}
	public function authenticate() {
		$this->form_validation->set_rules('username', 'Username', 'xss_clean|required|trim');			
		$this->form_validation->set_rules('password', 'Password', 'xss_clean|required|trim');
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response  = $this->recaptcha->verifyResponse($recaptcha);
		if (isset($response['success']) AND $response['success'] === False) {
		$this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha', 'required|xss_clean');
		}
		if ($this->form_validation->run() == false){	
			$this->session->set_flashdata('erroruserlog', '<div class="common_error_div">'.validation_errors().' </div> ');
	
			redirect(base_url(),'refresh');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result =  $this->dashboard->checkuserauth( $username,$password);
			if( !empty($result) ) {
				$catparams = array(
					'userid'=> $result->userid,
					'username'=> $result->username,
					'displayname'=> $result->displayname,
					'profile_pic'=> $result->profile_pic,
					'isLoggedIn'=> true,
				);
				$this->session->set_userdata($catparams);
				redirect(base_url('/dashboard'),'refresh');
			} else {
				$this->session->set_flashdata('erroruserlog', '<div class="common_error_div">You are not authorized to login</div> ');
				redirect(base_url(),'refresh');
			}
		}
	}
	public function check_captcha($str){
		$word = $this->session->userdata('captchaWord');
		if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
			return true;
		} else {
			$this->form_validation->set_message('check_captcha', 'Captcha verification failed');
			return false;
		}
	}
	public function createuser() {
		$data['title'] = ' Create Users | '.$this->title;

		$this->load->view('createuserhtml',$data);

	}

	public function saveupdateeuser() {

		$data['title']=' Change Password | '.$this->title;
		$this->form_validation->set_rules('displayname','Full Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('username','Email Address','trim|required|valid_email|xss_clean|max_length[128]|is_unique[tbladminusers.username]');
		$this->form_validation->set_message('is_unique', 'The %s is already used. Please try other');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]|min_length[8]|alpha_numeric');
		
		if ($this->form_validation->run() == false){	
			$this->session->set_flashdata('erroruserlog', '<div class="common_error_div">'.validation_errors().' </div> ');
			redirect(base_url('createuser'),'refresh');


		}
		else {
			$password = $this->input->post('cpassword');
			$userInfo = array(
				'displayname' =>$this->security->xss_clean ( $this->input->post('displayname')),
				'username' =>$this->security->xss_clean ( $this->input->post('username')),
				'password' =>$this->security->xss_clean ( $password ),
				'profile_pic' =>$this->security->xss_clean ( $this->input->post('profile_pic')),
				'isactive' =>$this->security->xss_clean (1),
				'isDeleted' =>$this->security->xss_clean (0),
				'createdDtm'=>$this->security->xss_clean (date('Y-m-d H:i:s'))
			);

			$result = $this->dashboard->addNewAdminUser($userInfo); 
			$this->session->set_flashdata('erroruserlog', '<div class="common_error_div">Your Account Has Been Created</div> ');
			redirect(base_url(),'refresh');
		}
    }
	public function logout() {
		$newuserdata = array(
			'userid'=> '',
			'username'=> '',
			'displayname'=> '',
			'profile_pic'=>'',
			'isLoggedIn'=> false
		);
		$this->session->unset_userdata($newuserdata);
		$this->session->sess_destroy();
		$this->session->set_flashdata('loginmessageerror', '<div class="alert alert-danger fade in"><strong>You are Successfully logout </strong></div> ');
		redirect(base_url(),'refresh');
	}
}
