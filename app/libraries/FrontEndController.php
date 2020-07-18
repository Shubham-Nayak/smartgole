<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
// ignore this library this is for frontend and api
class FrontEndController extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->SMTP = '';
		$this->SMTP_HOST = '';
		$this->SMTP_PORT = '';
		$this->SMTP_USER = '';
		$this->SMTP_PASS = '';
		$this->template = 'templates';
		$this->class = $this->router->fetch_class();
		$this->method = $this->router->fetch_method();
		$this->load->helper(array('utility','language','captcha'));
		
		$this->webtitle = '';
		$this->email = '';
		$this->mobile = '';
		$this->alternet_number ='';
		$this->googleverid = '';
		$this->googleanascript = '';
		$this->facebookscript = '';
		$this->address = '';
		$this->metatitle = '';
		$this->metakeywords = '';
		$this->meta_description = '';
		$this->weblogo = '';
		$this->favicon = '';
		$this->facebook_link =  '';
		$this->twitter_link =  '';
		$this->youtube_link =  '';

		$this->instagram_link = '';
		$this->linkedin_link = '';
	}
	public function default_tags() {
		$datalists = CALL_WEBMETHOD_GET('settings');
		if($datalists->status) {
			$option = $datalists->data;
			$this->webtitle = $option->title;
			$this->email = $option->email;
			$this->mobile = $option->mobile;
			$this->alternet_number = $option->alternet_number;

			$this->googleverid = $option->googleverid;
			$this->googleanascript = $option->googleanascript;
			$this->facebookscript = $option->facebookscript;
			$this->address = $option->address;
			$this->metatitle = $option->metatitle;
			$this->metakeywords = $option->metakeywords;
			$this->meta_description = $option->meta_description;
			$this->weblogo = get_image_url($option->weblogo);
			$this->favicon = get_image_url($option->favicon);
			$this->facebook_link =  $option->facebook_link;
			$this->twitter_link =  $option->twitter_link;
			$this->youtube_link =  $option->youtube_link;

			$this->instagram_link =  $option->instagram_link;
			$this->linkedin_link =  $option->linkedin_link;


		}
		return array(
			'webtitle' =>$this->webtitle,
			'email' =>$this->email,
			'mobile' =>$this->mobile,
			'alternet_number' =>$this->alternet_number,

			'googleverid' =>$this->googleverid,
			'googleanascript' =>$this->googleanascript,
			'facebookscript' =>$this->facebookscript,
			'address' =>$this->address,
			'metatitle' =>$this->metatitle,
			'metakeywords' =>$this->metakeywords,
			'meta_description' =>$this->meta_description,
			'weblogo' =>$this->weblogo,
			'favicon' =>$this->favicon,
			'facebook_link' => $this->facebook_link,
			'twitter_link' => $this->twitter_link,
			'youtube_link' => $this->youtube_link,
			'instagram_link' => $this->instagram_link,
			'linkedin_link' => $this->linkedin_link


		);		
    }
	public function get_commonimagedata( $method, $type = 'banners' ) {
		$parameters = array(
			'type'	=> $type
		);
		$datalists = CALL_WEBMETHOD_GET($method, $parameters);
		return $datalists;	
    }
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}

}
?>