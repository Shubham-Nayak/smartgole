<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends MY_Model {
	public function __construct() {
		parent::__construct();
	}
	public function checkuserauth( $username, $password ) {  		
		$result = array();
		$this->db->select("*");
		$this->db->from("{$this->tbladminusers}");
		$this->db->where('username', $username );
		$this->db->where('password', $password );
		$this->db->where('isactive', 1 );
		$aQuery = $this->db->get();
		$this->db->last_query();
		if($aQuery -> num_rows() >0 ){
			$result = $aQuery->row();
		}
		return $result;
	}
	public function addNewAdminUser($param = array()) {
	
		$return = $this->db->insert("{$this->tbladminusers}",$param);
		$return = true;
	}
	public function getallgoles($userid=NULL){
		$results = array();
		$this->db->select("*");
		$this->db->from("{$this->tblcommonmaster}");
		$this->db->where("isdelete", 0);
		$this->db->where("created_on", date("Y-m-d"));
		$this->db->where("userid", $userid);


		$this->db->order_by("autoid","DESC");
		$query = $this->db->get();
		$this->db->last_query();

		if($query -> num_rows() >0 ){
			$results = $query->result();
		}
		return $results;		
	}
	public function getallgoleshistory($userid){
		$results = array();
		$this->db->select("*");
		$this->db->from("{$this->tblcommonmaster}");
		$this->db->where("isdelete", 0);
		$this->db->where("isactive", 2);
		$this->db->where("userid", $userid);

		$this->db->order_by("autoid","DESC");
		$query = $this->db->get();
		$this->db->last_query();
		if($query -> num_rows() >0 ){
			$results = $query->result();
		}
		return $results;		
	}
	public function getallpendinggole($userid){
		$results = array();
		$this->db->select("*");
		$this->db->from("{$this->tblcommonmaster}");
		$this->db->where("isdelete", 0);
		$this->db->where("(isactive=0 OR isactive=1 )");
		$this->db->where("userid", $userid);
		$this->db->where_not_in('created_on', date("Y-m-d"));
		$this->db->order_by("autoid","DESC");
		$query = $this->db->get();
		$this->db->last_query();
		if($query -> num_rows() >0 ){
			$results = $query->result();
		}
		return $results;		
	}
	
	
	public function getsinglegoles( $autoid ){
		$results = array();
		$this->db->select('*');
		$this->db->from("{$this->tblcommonmaster}");
		$this->db->where("autoid", $autoid);
		$query = $this->db->get();
		$this->db->last_query();
		if($query -> num_rows() >0 ){
			$results = $query->row_array();
		}
		return $results;		
    }
	public function savegole($param = array()) {

		$return = $this->db->insert("{$this->tblcommonmaster}",$param);
		return $this->db->insert_id();
	}
	public function updategole($param = array() , $autoid) {

		$return = false;
		if( !empty($autoid) && $autoid != '' ) {
			$this->db->where('autoid', $autoid);
			$this->db->update("{$this->tblcommonmaster}", $param); 
			$return = true;
		}
		return $return;
	}
	public function deletegole($autoid) {
		$return = false;
		if( !empty($autoid) && $autoid != '' ) {
			$this->db->delete("{$this->tblcommonmaster}", array('autoid' => $autoid));
			$return = true;
		}
		return $return;
	}




	

}

?>