<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
class AdminBaseController extends CI_Controller {
	protected $role = ''; 
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $global = array ();
	protected $lastLogin = '';
	public function __construct() {
		parent::__construct();
		$this->title = 'Smart Gole Manager';
		$this->folder = 'administrator';
		$this->class = $this->router->fetch_class();
		$this->load->helper('myadmin');
		$this->load->library(array('email', 'form_validation','pagination'));
		$this->load->model('administrator/Dashboard_model','dashboard');
		$this->limit = 40;
		$this->targets = array(
			'0' => 'Self',
			'1' => 'New Window',
		);
		$this->status = array(
			1 => 'Active',
			0 => 'inActive',
		);
		$this->imageposition = array(
			'left' => 'Left Side',
			'right' => 'Right Side',
		);
		// tiny_mce is now intigrated
		$this->tiny_mce_init = "<script>
			tinymce.init({
			  selector: '.mycustomtextarea',
			  height: 300,
			  width: 'auto',
			  branding: false,
			extended_valid_elements: 'iframe[class|src|frameborder=0|alt|title|width|height|align|name]',
			  theme: 'modern',
			  plugins: 'importcss responsivefilemanager code paste print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr emoticons pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
			  toolbar1: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor | link unlink anchor | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
			  toolbar2: 'responsivefilemanager | image media | print preview code',
			  image_advtab: true ,
			  content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tinymce.com/css/codepen.min.css'
			  ],
			   external_filemanager_path:'" . base_url() . "assets/filemanager/',
			   filemanager_title:'File Manager',
			   external_plugins: { 'filemanager' : '" . base_url() . "assets/filemanager/plugin.min.js'},
			   relative_urls : false,
			   document_base_url : '" . base_url() . "',
			 });
		</script>";
	}
	
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}
	function isLoggedIn() {
		
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		 if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect(base_url('administrator'),'refresh');
		 } else {
			$this->userid = $this->session->userdata ( 'userid' );
			$this->displayname = $this->session->userdata ( 'displayname' );
			$this->role = $this->session->userdata ( 'role' );
			$this->profile_pic = $this->session->userdata ( 'profile_pic' );
			$this->username = $this->session->userdata ( 'username' );
			$this->global ['userid'] = $this->userid;
			$this->global ['profile_pic'] = $this->profile_pic;
			$this->global ['displayname'] = $this->displayname;
			$this->global ['role'] = $this->role;
			$this->global ['username'] = $this->username;
		}
	}
	function loadThis() {
		$this->global ['title'] = 'Access Denied';
		$this->load->view('administrator/headerhtml',$this->global);
		$this->load->view('administrator/accessdeniedhtml');
		$this->load->view('administrator/footerhtml',$data);
	}
	function logout() {
		$this->session->sess_destroy();
		$this->session->set_flashdata('loginmessageerror', '<div class="alert alert-danger fade in"><strong>You are Successfully logout </strong></div> ');
		redirect(base_url('administrator'),'refresh');
	}
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
		$this->load->view('administrator/headerhtml',$headerInfo);
		$this->load->view('administrator/'.$viewName.'',$pageInfo);
		$this->load->view('administrator/footerhtml',$footerInfo);
    }
	function loadAjaxViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
		$this->load->view('administrator/'.$viewName.'',$pageInfo);
    }
	function paginationCompress($link, $count, $limit = 40, $segment = 4) {
		$config ['base_url'] = $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = $segment;
		$config ['per_page'] = $this->limit;
		$config ['num_links'] = 2;
		$config['suffix']     = '?' . http_build_query($_GET, '', "&");  
		$config['first_url']  = $config['base_url'] . '?' . http_build_query($_GET);				
		$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( $segment );
		return array (
			"page" => $page,
			"segment" => $segment
		);
	}
	// public function getHashedPassword( $plainPassword) {
    //     return password_hash($plainPassword, PASSWORD_DEFAULT);
    // }
	// public function verifyHashedPassword($plainPassword, $hashedPassword) {
    //     return password_verify($plainPassword, $hashedPassword) ? true : false;
    // }
    public  function uploadImage( $directoryName, $filename ,$width = 0, $height = 0) {
    	if (!is_dir("assets/uploads/$directoryName/")) {
		    mkdir("./assets/uploads/$directoryName/", 0777, TRUE);
		}
		$keyname = $directoryName;
    	$config['upload_path']   = "assets/uploads/".$directoryName;
		$config['allowed_types'] = "gif|jpg|jpeg|png|gif";
		$config['max_size']      = "1024";
		$config['min_width']     = $width;
		$config['min_height']    = $height;
		$config['remove_spaces'] = true;
		$config['encrypt_name']  = true;
		$new_name = time().'_'.$filename;
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($keyname)) {
			$finfo = $this->upload->data();
			$return = array(
				'filename' => $finfo['file_name'],
				'status' =>true
			);
		} else {
			$return = array(
				'filename' => $this->upload->display_errors(),
				'status' =>false
			);
		}
		return $return;
    }
	public  function uploadMultipleImage( $directoryName, $files ,$isResize = false ) {
    	if (!is_dir("assets/uploads/$directoryName/")) {
		    mkdir("./assets/uploads/$directoryName/", 0777, TRUE);
		}
		$config['upload_path']   = "assets/uploads/".$directoryName;
		$config['allowed_types'] = "gif|jpg|jpeg|png|gif";
		$config['max_size']      = "1024";
		$config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $data = array();
        $Mainimages = array();
        $name_array = array();
		foreach ($files['name'] as $key => $images) {
            $_FILES[$directoryName.'[]']['name']= $files['name'][$key];
			$_FILES[$directoryName.'[]']['type']= $files['type'][$key];
            $_FILES[$directoryName.'[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES[$directoryName.'[]']['error']= $files['error'][$key];
            $_FILES[$directoryName.'[]']['size']= $files['size'][$key];
            $fileName = $images;
            $Mainimages[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);
            if ($this->upload->do_upload($directoryName.'[]')) {
                $name_array[] = $this->upload->data();
				
            } else {
                return false;
            }
        }
		if($isResize) {
			foreach ($name_array as $key => $value):
				$this->resizeImage($directoryName, $value['file_name']);
				$data[] = array(
					'origimage'=>$value['file_name'],
					'thumbnail'=>$value['raw_name'].'_thumb'.$value['file_ext']
				);
			endforeach;
		} else {
			foreach ($name_array as $key => $value):
				$data[] = array(
					'origimage'=>$value['file_name'],
				);
			endforeach;
		}
		return $data;
    }
	public function resizeImage( $uploadpath, $filename, $width = 300, $height = 300 ) {
		if (!is_dir("assets/uploads/$uploadpath/thumbnail")) {
		    mkdir("./assets/uploads/$uploadpath/thumbnail/", 0777, TRUE);
		}
		$this->load->library('image_lib');
		$config['image_library']  = "gd2";
		$config['source_image']   = "assets/uploads/$uploadpath/".$filename;
		$config['create_thumb']   = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = $width;
		$config['height']         = $height;
		$thumbs_path              = "./assets/uploads/$uploadpath/thumbnail/";
		$config['new_image']      = $thumbs_path;
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
		$this->image_lib->clear();
	}
	public  function uploadvideos( $manualurl ) {
    	$config['upload_path']   = "assets/uploads/videos";
		$config['max_size']      = "2621440";
		$config['allowed_types'] = 'mp4';
		$config['overwrite'] = FALSE;
		$config['remove_spaces'] = true;
		$config['encrypt_name']  = true;
		$new_name = time().'_'.$manualurl;
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('manualurl')) {
			$finfo = $this->upload->data();
			$return = array(
				'filename' => $finfo['file_name'],
				'status' =>true
			);
		} else {
			$return = array(
				'filename' => $this->upload->display_errors(),
				'status' =>false
			);
		}
		return $return;
    }
}
?>