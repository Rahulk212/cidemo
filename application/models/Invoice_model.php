<?php 

Class Invoice_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    } 
  
	public function num_row_srch() {

        $query = "SELECT *  FROM `invoice_master` where  status='1'";

        $query .= " ORDER BY id DESC";
        $result = $this->db->query($query)->num_rows();
        return $result;
    }
	public function row_srch($limit, $start) {

        $query = "SELECT *  FROM `invoice_master` where status='1'";
        $query .= " ORDER BY id DESC LIMIT $start , $limit";
        $result = $this->db->query($query)->result();
        return $result;
    }
	
	public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
	
	
}
?>
