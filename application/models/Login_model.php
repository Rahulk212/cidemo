<?php 
Class Login_model extends CI_Model {	
 function checklogin($username, $password) {
        $this->db->select('*');
        $this->db->from('admin_master');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->where('status', '1');
		$this->db->limit(1);
        $query = $this->db->get();
        // print_R($query);
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

	public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}?>