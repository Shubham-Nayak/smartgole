<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/AdminBaseController.php';
class Dashboard extends AdminBaseController {
	public function __construct() {
		parent::__construct();
		$this->isLoggedIn();
	}	
	/**********New Post Section Start********/
	public function settings() {
        $this->global['title'] = 'Settings | '.$this->title;
		$data['info'] = $this->dashboard->getwebsettings();
		$this->loadViews("websettingshtml", $this->global, $data, NULL);
    }
	public function index() {
		$this->global['title'] = 'Goles | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoles($this->userid);
		$this->loadViews("golehtml", $this->global, $data, NULL);
	}

	public function addgole( $autoid = NULL ) {
		$this->global['title'] = 'Add Agents | '.$this->title;
		
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'isactive' =>'',
				'title' =>'',
				'description' =>'',
				'otherfield' =>'',
			);
		}
		$this->loadViews("addgolehtml", $this->global, $data, NULL);
	}
	
	public function savegole() {
		$this->form_validation->set_rules('title', 'Gole Title', 'trim|required|xss_clean');

        try {
			$id = $this->input->post('autoid');
            if ($this->form_validation->run() == false) {
                echo json_encode(array(
                    'status' => false,
                    'message' => flashmessage(validation_errors())
                ));
            } else {
				$type = $this->input->post('type');
                $parameters = array(
                    'userid' => $this->userid,
                    'isactive' => $this->input->post('isactive'),
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'otherfield' => $this->input->post('otherfield'),
					'created_on' => date("Y-m-d")

					
				);
				if($id) {
					$this->dashboard->updategole($parameters, $id);
					$message = 'Content has been Updated Successfully';
				} else {

					$this->dashboard->savegole($parameters);
					$message = 'Content has been Saved Successfully';
				}
				$this->session->set_flashdata('commonerrorrmsg', flashmessage($message,'success'));
				echo json_encode(array(
					'status' => true,
					'http_redirect' => adminsbase_url("dashboard"),
					'message' => flashmessage($message,'success'),
					'redirect' => false
				));
            }
        }
        catch (Exception $e) {
            echo json_encode(array(
                'status' => false,
                'message' => flashmessage($e->getMessage),
            ));
        }
    }
	public function golestatus(){
		if($this->uri->segment(4)==0)
		{
			$parameters = array(
				'start_time' => date("H:i:s"),
				'isactive'=>0
			);
		}
		else{
			$parameters = array(
				'end_time' => date("H:i:s"),
				'isactive'=>2

			);
		}

		$autoid = $this->uri->segment(5);
	
		$g=$this->dashboard->updategole($parameters, $autoid);
	
        $this->session->set_flashdata('commonerrorrmsg', flashmessage('Status has been Changed Successfully','success'));
        redirect(adminsbase_url("dashboard"), 'refresh');
	}
	public function changedate(){
	
		$parameters = array(
			'created_on' => date("Y-m-d"),
			'isactive'=>1

		);
		$autoid = $this->uri->segment(4);
	
		$g=$this->dashboard->updategole($parameters, $autoid);
	
        $this->session->set_flashdata('commonerrorrmsg', flashmessage('Added To Todays Gole','success'));
        redirect(adminsbase_url("dashboard"), 'refresh');
    }
	public function deletegole( ){
		$parameters = array(
			'isdelete'=>1
		);
		$autoid = $this->uri->segment(5);

        $this->dashboard->updategole($parameters,$autoid);
        $this->session->set_flashdata('commonerrorrmsg', flashmessage('Data has been Deleted Successfully','success'));
		redirect(adminsbase_url("dashboard"), 'refresh');
    }


	public function albums() {
		$this->global['title'] = 'Albums | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoles('album');
		$this->loadViews("albumslisthtml", $this->global, $data, NULL);	
    }
	public function addalbums( $autoid = NULL ) {
        $this->global['title'] = 'Add Albums | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'title' =>'',
				'image_url' =>'',
				'description' =>'',

			);
		}
		$this->loadViews("addalbumshtml", $this->global, $data, NULL);
    }
	public function albumsimages() {
		$this->global['title'] = 'Albums | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoles('albums');
		$this->loadViews("albumsimageshtml", $this->global, $data, NULL);	
    }
	public function addalbumsimages( $autoid ) {
      
		
		$data['albumid'] = $autoid;
        $data['album'] = $this->dashboard->get_album();		

		$this->global['title'] = 'Add Albums Images | '.$this->title;
		
		$dataalbums   = array();
		$data['albumsimages'] = array();
		$data_albums = $this->dashboard->get_activegoles('albums');
        foreach ($data_albums as $list):
            $dataalbums[$list->autoid] = $list->title;
        endforeach;
		
		$data_albumsimages = $this->dashboard->get_allalbumimages($autoid);
		if(!empty($data_albumsimages)){
		$data['albumsimages'] = $data_albumsimages;
        foreach ($data_albumsimages as $list):
            $dataalbumsimages[] = $list->cat_images;
        endforeach;
		if(count($dataalbumsimages) >1 ) {
			$data_albumsimages = '["'.implode('","',$dataalbumsimages).'"]';
		} else {
			$data_albumsimages = implode('',$dataalbumsimages);
		}
		}
		$data['albumsimages_imput'] = $data_albumsimages;
		$data['album_lists'] = $dataalbums;
		$this->loadViews("addalbumsimageshtml", $this->global, $data, NULL);
    }
	public function savealbumimages() {
        $this->form_validation->set_rules('albumid', 'Albumid', 'trim|required|xss_clean');
        $this->form_validation->set_rules('captionsarray', 'Images', 'trim|required|xss_clean');
        try {
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'status' => false,
                    'message' => flashmessage(validation_errors())
                ));
            } else {
				$albumid = $this->input->post('albumid');
				$captionsarray = $this->input->post('captionsarray');
				$type = $this->input->post('type');
				$image_urls = explode(',',$captionsarray);
				
				$image_url_array = array();
				foreach ($image_urls as $image_url ):
					$image_url_params[] = array(
						'albumid' => $albumid,
						'type' => $type,
						'cat_images' => str_replace(array('["','"]','"'),array(''),$image_url)
					);
				endforeach;
				$this->dashboard->savealbumimages($image_url_params);

				$message = 'Images has been Saved Successfully';
				
				$this->session->set_flashdata('commonerrorrmsg', flashmessage($message,'success'));
				echo json_encode(array(
					'status' => true,
					'http_redirect' => adminsbase_url("dashboard/albums"),
					'message' => flashmessage($message,'success'),
					'redirect' => false
				));
            }
        }
        catch (Exception $e) {
            echo json_encode(array(
                'status' => false,
                'message' => flashmessage($e->getMessage),
            ));
        }
    }
	public function delalbumsimages( ){
		$albumid = $this->uri->segment(4);
		$image_id = $this->uri->segment(5);
		$albumid = $this->uri->segment(4);
		$this->dashboard->delalbumsimages($albumid, $image_id);
        $this->session->set_flashdata('delcommonerrorrmsg', flashmessage('Image has been deleted Successfully','success'));
		redirect(adminsbase_url("dashboard/addalbumsimages/$albumid"), 'refresh');
	} 
	public function admission() {
		$this->global['title'] = 'Admission | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoles('admission');
		$this->loadViews("admissionhtml", $this->global, $data, NULL);	
	}
	public function addadmission( $autoid = NULL ) {
        $this->global['title'] = 'Add Admission | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'title' =>'',
				'description' =>'',
				'image_url' =>''

			);
		}
		$this->loadViews("addadmissionhtml", $this->global, $data, NULL);
    }
	
	/*===========================otherpage========================*/
	public function otherpages() {
		$this->global['title'] = 'Other Pages | '.$this->title;
		$search                = $this->input->get('search');
		$offset                = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$count  = $this->dashboard->getcuntallcmspages($search,'otherpages');
		$returns  = $this->paginationCompress(adminsbase_url('dashboard'), $count);
		$data['lists']     = $this->dashboard->getcmspages($returns["page"], $returns["segment"], $search,'otherpages');
		$data['search'] = $search;
		$this->loadViews("otherpageshtml", $this->global, $data, NULL);	
    }
	public function addotherpages($pageid = NULL) {
        $this->global['title'] = 'Other Page | '.$this->title;
		if( !empty($pageid) && is_numeric($pageid)) {
			$data['info'] = $this->dashboard->getsinglecmspages($pageid);
		} else {
			$data['info']     = array(
				'pageid' =>'',
				'pagename' =>'',
				'page_description' =>'',
				'parentid' =>'',
				'isactive' =>'',
				'featureimageposition' =>'',
				'featureimage' =>'',
				'external_link' =>'',
				'meta_title' =>'',
				'meta_keywords' =>'',
				'seo_url' =>'',
				'target' =>'',
				'meta_description' =>''
			);
		}
		$this->loadViews("addotherpageshtml", $this->global, $data, NULL);
	}
	/*=======================end otherpage===============*/ 

	public function addpagesimages( $autoid = NULL) {
        if( empty($autoid) && !is_numeric($autoid)) {
			redirect(adminsbase_url('dashboard/index'));
		}
		$type = 'cmspage';
		$data['albumid'] = $autoid;
		$this->global['title'] = 'Add Pages Images | '.$this->title;
		
		$dataalbums   = array();
		$data['albumsimages'] = array();
		$data_albums = $this->dashboard->getallcmspages();
        foreach ($data_albums as $list):
            $dataalbums[$list->pageid] = $list->pagename;
        endforeach;
		
		$data_albumsimages = $this->dashboard->get_allpagesimages($autoid,$type);
		if(!empty($data_albumsimages)){
		$data['albumsimages'] = $data_albumsimages;
        foreach ($data_albumsimages as $list):
            $dataalbumsimages[] = $list->cat_images;
        endforeach;
		if(count($dataalbumsimages) >1 ) {
			$data_albumsimages = '["'.implode('","',$dataalbumsimages).'"]';
		} else {
			$data_albumsimages = implode('',$dataalbumsimages);
		}
	    }
		$data['albumsimages_imput'] = $data_albumsimages;
		$data['album_lists'] = $dataalbums;
		$this->loadViews("addpagesalbumhtml", $this->global, $data, NULL);
    }
    public function delpagesimages( ){
		$albumid = $this->uri->segment(4);
		$image_id = $this->uri->segment(5);
		$this->dashboard->delalbumsimages($albumid, $image_id);
        $this->session->set_flashdata('delcommonerrorrmsg', flashmessage('Image has been deleted Successfully','success'));
		redirect(adminsbase_url("dashboard/addalbumsimages/$albumid#viewimages"), 'refresh');
    }


		
	
	/*============end  blogs ================*/ 

    public function history( ) {
		$this->global['title'] = 'Goals History | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoleshistory($this->userid);
		$this->loadViews("histroyhtml", $this->global, $data, NULL);	
	}
	public function pendinggole( ) {
		$this->global['title'] = 'Pending Goals| '.$this->title;
        $data['lists']     = $this->dashboard->getallpendinggole($this->userid);
		$this->loadViews("pendinghtml", $this->global, $data, NULL);	
	}
	public function registration( ) {
		$this->global['title'] = 'Registration | '.$this->title;
        $data['lists']     = $this->dashboard->getallregistration();
		$this->loadViews("registrationhtml", $this->global, $data, NULL);	
	}
	public function admission_query( ) {
		$this->global['title'] = 'Admission Query | '.$this->title;
        $data['lists']     = $this->dashboard->getalladmission_query();
		$this->loadViews("admission_queryhtml", $this->global, $data, NULL);	
	}
	public function career( ) {
		$this->global['title'] = 'Career | '.$this->title;
        $data['lists']     = $this->dashboard->getallcareer();
		$this->loadViews("careerhtml", $this->global, $data, NULL);	
	}
	public function alumni( ) {
		$this->global['title'] = 'Alumni | '.$this->title;
        $data['lists']     = $this->dashboard->getallalumni();
		$this->loadViews("alumnihtml", $this->global, $data, NULL);	
    }
    public function announcements($search=NULL) {
		$this->global['title'] = 'Announcements | '.$this->title;
		$data['lists']     = $this->dashboard->getcmspages( $limit=NULL, $offset=NULL, $search = NULL,'announcements');
		// print_r($data['lists']  );die();
		$this->loadViews("newshtml", $this->global, $data, NULL);	
    }
	public function addannouncements($pageid = NULL) {
        $this->global['title'] = 'Announcements | '.$this->title;
		if( !empty($pageid) && is_numeric($pageid)) {
			$data['info'] = $this->dashboard->getsinglecmspages( $pageid );

		} else {
			$data['info']     = array(
				'pageid' =>'',
				'pagename' =>'',
				'isactive' =>'',
				'page_description' =>'',
				'featureimage' =>'',

				
			);
		}
		$this->loadViews("addnewshtml", $this->global, $data, NULL);
	}
	public function newspdf() {
		$this->global['title'] = 'Add Books | '.$this->title;
        $data['lists']     = $this->dashboard->getpdf('newspdf');
		$this->loadViews("newspdf", $this->global, $data, NULL);	
	}
	public function addnewspdf( $autoid = NULL ) {
		$this->global['title'] = 'Add Achievements | '.$this->title;
        $data['news']     = $this->dashboard->getnews();
		// print_r($data['lists']);die();
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'image_url' =>'',
				'title' =>'',
				'otherfield'=>''
			);
		}
		$this->loadViews("addpdfhtml", $this->global, $data, NULL);
    }
    
    
    public function events( ) {
		$this->global['title'] = 'Events | '.$this->title;
        $data['lists']     = $this->dashboard->getallgoles('events');
		$this->loadViews("eventshtml", $this->global, $data, NULL);	
    }
	public function addevents( $autoid = NULL ) {
        $this->global['title'] = 'Add Events | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'image_url' =>'',
				'otherfield' =>''
			);
		}
		$this->loadViews("addeventshtml", $this->global, $data, NULL);
	}
		



	
	// ==========================album====================//
	public function album( ) {
		$this->global['title'] = 'Album | '.$this->title;
        $data['lists']     = $this->dashboard->getgoles('album');
		$this->loadViews("albumlisthtml", $this->global, $data, NULL);	
    }
	public function addalbum( $autoid = NULL ) {
        $this->global['title'] = 'Add Album | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'image_url' =>'',
				'title'=>'',
				'description'=>'',

			);
		}
		$this->loadViews("addalbumhtml", $this->global, $data, NULL);
	}

	// ==========================gallery============================//
	public function widget( ) {
		$this->global['title'] = 'Widget | '.$this->title;
		$data['lists']     = $this->dashboard->getgoles('widget');
		$this->loadViews("widgethtml", $this->global, $data, NULL);	
    }
	public function addwidget( $autoid = NULL ) {
		$this->global['title'] = 'Add Widget | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'image_url' =>'',
				'description' =>'',
				'title' =>'',
				'otherfield'=>''


			);
		}
		$this->loadViews("addwidgethtml", $this->global, $data, NULL);
	}

	public function downloads( ) {
		$this->global['title'] = 'Downloads | '.$this->title;
        $data['lists']     = $this->dashboard->getgoles('downloads');
		$this->loadViews("downloadlisthtml", $this->global, $data, NULL);	
    }
	public function adddownloads( $autoid = NULL ) {
        $this->global['title'] = 'Add Downloads | '.$this->title;
		if( !empty($autoid) && is_numeric($autoid)) {
			$data['info'] = $this->dashboard->getsinglegoles( $autoid );
		} else {
			$data['info']     = array(
				'autoid' =>'',
				'image_url' =>'',
				'title' =>''

			);
		}
		$this->loadViews("adddownloadhtml", $this->global, $data, NULL);
    }

	public function saveoptions() {
		$data['title']='Save CMS Page | '.$this->title;
		$this->form_validation->set_rules('title', 'Title', 'xss_clean|required|trim');			
		$this->form_validation->set_rules('email', 'Email Address', 'xss_clean|required|trim');			
		$this->form_validation->set_rules('mobile','Mobile Number','required|min_length[9]|max_length[16]|xss_clean');	
		$this->form_validation->set_rules('alternet_number','Alternet Number','required|min_length[9]|max_length[16]|xss_clean');	

		$this->form_validation->set_rules('logo', 'Website Logo', 'xss_clean|required|trim');			
		$this->form_validation->set_rules('address', 'Website Address', 'xss_clean|trim');			
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'xss_clean|trim');			
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'xss_clean|trim');			
		if ($this->form_validation->run() == false){	
			echo json_encode(array(
				'status' => false,
				'message' => flashmessage(validation_errors())
			));
		} else {
			$params = array(
				'title' => $this->input->post('title'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'alternet_number' => $this->input->post('alternet_number'),

				'facebook_link' => $this->input->post('facebook_link'),
				'twitter_link' => $this->input->post('twitter_link'),
				'youtube_link' => $this->input->post('youtube_link'),
				'instagram_link' => $this->input->post('instagram_link'),
				'linkedin_link' => $this->input->post('linkedin_link'),

				'google_ver_id' => $this->input->post('google_ver_id'),
				'googleana_script' => $this->input->post('googleana_script'),
				'facebook_script' => $this->input->post('facebook_script'),
				'logo' => $this->input->post('logo'),
				'favicon' => $this->input->post('favicon'),
				'address' => $this->input->post('address'),
				'meta_title' => $this->input->post('meta_title'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'created_on' => date('Y-m-d H:i:s'),
				'meta_description' => $this->input->post('meta_description')
			);
			// print_r($params);die();
			$return =  $this->dashboard->updatesettings( $params,1);
			if($return) {
				echo json_encode(array(
					'status' => true,
					'redirect' => true,
					'http_redirect' => adminsbase_url('dashboard/settings'),
					'message' => flashmessage('Website Settings  has been Save Successfully','success')
				));
				$this->session->set_flashdata('commonerrorrmsg', flashmessage('Content has been Save Successfully','success'));
			}
		}
	}
}
