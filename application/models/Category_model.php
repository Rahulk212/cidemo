<?php Class Category_model extends MY_Model {
    function search_num($search) {
        $temp = "";
        if ($search != "") {
            $temp = " AND name LIKE '%" . $search . "%' ";
        }
        $query = $this->db->query("SELECT id,name FROM `category_master` where status ='1' $temp ");
        return $query->num_rows();
    }
    function list_search($search, $one, $two) {
        $temp = "";
        if ($search != "") {
            $temp = " AND c.name LIKE '%" . $search . "%' ";
        }
        $query = $this->db->query("SELECT c.id,c.name,c.created_date,c.updated_date FROM `category_master` c  where c.status ='1' $temp ORDER BY c.position ASC LIMIT $two,$one");
        return $query->result();
    }
    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function check_name($email,$table){
		$this->db->select('*');
        $this->db->from($table);
        $this->db->where('name', $email);
        $this->db->where('status', '1');
        $this->db->limit(1);
        $query = $this->db->get();
		return $query->num_rows();
	}
    public function get_one($dtatabase, $condition) {
        $query = $this->db->get_where($dtatabase, $condition);
        $result = $query->row();
        return $result;
    }
    public function update($tablename, $cid, $data) {
        $this->db->where($cid);
        $this->db->update($tablename, $data);
        return 1;
    }
}
?>