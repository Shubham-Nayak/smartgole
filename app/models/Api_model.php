<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Api_model extends MY_Model {
	public function __construct() {
		parent::__construct();
	}


	public function get_todaysgole($userid) {  
		$result = array();
		$returndata = array();
		$this->db->select("a.autoid,a.title,a.description,a.expexted_time,a.start_time,a.end_time,a.created_on,a.isactive,a.isdelete,b.displayname");
		$this->db->from("{$this->tblcommonmaster} a");
		$this->db->join("{$this->tbladminusers} b","a.userid = b.userid");
		$this->db->where("a.isdelete", 0);
		$this->db->where("a.created_on", date("Y-m-d"));
		$this->db->where("a.userid", $userid);
		$this->db->order_by('a.autoid','DESC');
		$aQuery = $this->db->get();
		$this->db->last_query();
		if($aQuery -> num_rows() >0 ){
			$results = $aQuery->result();
			foreach( $results as $list ):
				$returndata[] = array(
					'autoid' => ConvertintoString($list->autoid),
					'username' => ConvertintoString($list->displayname),
					'title' => ConvertintoString($list->title),
					'description' => ConvertintoString($list->description),
					'expexted_time' => ConvertintoString($list->expexted_time),
					'start_time' => ConvertintoString($list->start_time),
					'end_time' => ConvertintoString($list->end_time),
					'created_on' => ConvertintoString($list->created_on),
				);
			endforeach;
		}
		return $returndata;
	}
	
	
	public function get_previousgole($userid) {  
		$result = array();
		$returndata = array();
		$this->db->select("a.autoid,a.title,a.description,a.expexted_time,a.start_time,a.end_time,a.created_on,a.isactive,a.isdelete,b.displayname");
		$this->db->from("{$this->tblcommonmaster} a");
		$this->db->join("{$this->tbladminusers} b","a.userid = b.userid");
		$this->db->where("a.isdelete", 0);
		$this->db->where("a.isactive", 2);
		$this->db->where("a.userid", $userid);
		$this->db->order_by('a.autoid','DESC');
		$aQuery = $this->db->get();
		$this->db->last_query();
		if($aQuery -> num_rows() >0 ){
			$results = $aQuery->result();
			foreach( $results as $list ):
				$returndata[] = array(
					'autoid' => ConvertintoString($list->autoid),
					'username' => ConvertintoString($list->displayname),
					'title' => ConvertintoString($list->title),
					'description' => ConvertintoString($list->description),
					'start_time' => ConvertintoString($list->start_time),
					'end_time' => ConvertintoString($list->end_time),
					'created_on' => ConvertintoString($list->created_on),
					'expexted_time' => ConvertintoString($list->expexted_time)

				);
			endforeach;
		}
		return $returndata;
	}
	

}
?>