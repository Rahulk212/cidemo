<?php

class MY_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function master_fun_insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
public function master_fun_update($tablename, $cid, $data) {
        $this->db->where('id', $cid);
        $this->db->update($tablename, $data);
        return 1;
   }
function updateRowWhere($table, $where, $data) {
    $this->db->where($where);
    $this->db->update($table, $data);
	return 1;
}	
 public function master_fun_update1($tablename, $cid, $data) {
        $this->db->where($cid[0], $cid[1]);
        $this->db->update($tablename, $data);
        return 1;
    }	
public function num_row($table,$condition){
        $query= $this->db->get_where($table,$condition);
        return $query->num_rows(); 
    }
	
public function master_fun_get_tbl_val($dtatabase,$select, $condition, $order) {
        $this->db->order_by($order[0], $order[1]);
        $this->db->select($select);
        $query = $this->db->get_where($dtatabase, $condition);
        $data['user'] = $query->result();
        return $data['user'];
    }
public function master_get_vallimt($dtatabase,$select, $condition,$order,$limit) {
    
		$this->db->order_by($order[0], $order[1]);
        $this->db->select($select);
		$this->db->limit($limit);
        $query = $this->db->get_where($dtatabase, $condition);
        $data['user'] = $query->result();
        return $data['user'];
    }
public function master_get_vallimt1($dtatabase,$select, $condition,$order,$limit,$start) {
    
		$this->db->order_by($order[0], $order[1]);
        $this->db->select($select);
		$this->db->limit($limit,$start);
        $query = $this->db->get_where($dtatabase, $condition);
        $data['user'] = $query->result();
        return $data['user'];
    }	
	
public function fetchdatarow($selact,$table,$array){
		          $this->db->select($selact); 
        $query = $this->db->get_where($table,$array);
        return $query->row();
    }	
public function master_num_rows($table,$condition){
		
	$query1 = $this->db->get_where($table,$condition);
		return $query1->num_rows();
	
	}
function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL){    $t =& get_instance();    $slug = url_title($string);    $slug = strtolower($slug);    $i = 0;    $params = array ();    $params[$field] = $slug;     if($key)$params["$key !="] = $value;     while ($t->db->where($params)->get($table)->num_rows())    {          if (!preg_match ('/-{1}[0-9]+$/', $slug ))            $slug .= '-' . ++$i;        else            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );                 $params [$field] = $slug;    }      return $slug;  }	
		
}
