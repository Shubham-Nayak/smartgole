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
					'http_redirect' => base_url("dashboard"),
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
        redirect(base_url("dashboard"), 'refresh');
	}
	public function changedate(){
	
		$parameters = array(
			'created_on' => date("Y-m-d"),
			'isactive'=>1

		);
		$autoid = $this->uri->segment(4);
	
		$g=$this->dashboard->updategole($parameters, $autoid);
	
        $this->session->set_flashdata('commonerrorrmsg', flashmessage('Added To Todays Gole','success'));
        redirect(base_url("dashboard"), 'refresh');
    }
	public function deletegole( ){
		$parameters = array(
			'isdelete'=>1
		);
		$autoid = $this->uri->segment(5);

        $this->dashboard->updategole($parameters,$autoid);
        $this->session->set_flashdata('commonerrorrmsg', flashmessage('Data has been Deleted Successfully','success'));
		redirect(base_url("dashboard"), 'refresh');
    }

	 

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
	

	
}
