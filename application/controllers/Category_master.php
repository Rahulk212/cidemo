<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category_master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $login_session=$this->session->userdata('logged_admin');
		if($login_session){
            $data['name'] = $login_session['name'];	
        }else{
            redirect('login');
        }
        
        $this->load->model('category_model');
    }
    function check_name($name) {
        $result = $this->category_model->check_name($name, 'category_master');
        if ($result == '0') {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_name', 'Category name already exist.');
            return false;
        }
    }
    public function index(){
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        
        $this->load->library('pagination');
        $search = $this->input->get('search');
        $data['search'] = $search;
        if ($search != "") {
            $total_row = $this->category_model->search_num($search);
            $config = array();
            $config["base_url"] = base_url()."category_master/index/?search=$search";
            $config["total_rows"] = $total_row;
            $config["per_page"] = 50;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<span>';
            $config['cur_tag_close'] = '</span>';
            $config['next_link'] = 'Next &rsaquo;';
            $config['prev_link'] = '&lsaquo; Previous';
            $config['page_query_string'] = TRUE;
            $this->pagination->initialize($config);
            $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
            $data['query'] = $this->category_model->list_search($search, $config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data["counts"] = $page;
        } else {
			
			
            $search = "";
            $totalRows = $this->category_model->search_num($search);
			
            $config = array();
            $config["base_url"] = base_url() . "category_master/index/";
            $config["total_rows"] = $totalRows;
            $config["per_page"] = 50;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<span>';
            $config['cur_tag_close'] = '</span>';
            $config['next_link'] = 'Next &rsaquo;';
            $config['prev_link'] = '&lsaquo; Previous';
            $this->pagination->initialize($config);
            $sort = $this->input->get("sort");
            $by = $this->input->get("by");
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["query"] = $this->category_model->list_search($search, $config["per_page"], $page);
			
            $data["links"] = $this->pagination->create_links();
            $data["counts"] = $page;
        }
	
        $this->load->view('header', $data);
        $this->load->view('nav', $data);
        $this->load->view('category_list', $data);
        $this->load->view('footer', $data);
    }
    function add() {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category name', 'trim|required|callback_check_name');
		if (empty($_FILES['userfile']['name']))
{
		$this->form_validation->set_rules('userfile','Category images', 'required');
}
if (empty($_FILES['categoryicon']['name']))
{	
		$this->form_validation->set_rules('categoryicon', 'Category icon', 'required');
}		
		
        if ($this->form_validation->run() != FALSE) {
            $name = $this->input->post('name');
			$description = $this->input->post('description');
			
			$slug = $this->category_model->create_unique_slug($name,"category_master","slug","","");
			$data1=array("name" => $name,"description"=>$description,"slug" => $slug,"created_by" =>$id,"created_date" => date("Y-m-d G:i:s"));
			if($_FILES["userfile"]["name"]) {
				  $config['upload_path'] = './media/';
                $config['allowed_types'] = '*';
                $config['file_name'] = time() . $_FILES["userfile"]["name"];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("userfile")) {
					$this->session->set_flashdata('unsuccess', $this->upload->display_errors());
					redirect('category_master/add');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_name = $data["upload_data"]["file_name"];
                    $data1["images"]= base_url()."media/".$file_name;
                 }
            }
			if($_FILES["categoryicon"]["name"]) {
				$config['upload_path'] = './media/';
                $config['allowed_types'] = '*';
                $config['file_name'] = time() . $_FILES["categoryicon"]["name"];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("categoryicon")) {
					$this->session->set_flashdata('unsuccess', $this->upload->display_errors());
					redirect('category_master/add');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_name = $data["upload_data"]["file_name"];
                    $data1["cat_icon"]= base_url()."media/".$file_name;
                 }
            }
			$testfk = $this->category_model->insert("category_master",$data1);
            $this->session->set_flashdata("success", "Category successfully added.");
            redirect("category_master", "refresh");
        } else {
            $this->load->view('header',$data);
            $this->load->view('nav', $data);
            $this->load->view('category_add', $data);
            $this->load->view('footer',$data);
        }
    }
    function delete($cid) {
        $data['query'] = $this->category_model->update("category_master", array("id"=> $cid), array("status" => '0'));

        $this->session->set_flashdata("success", "Category successfully deleted.");
        redirect("category_master", "refresh");
    }
    function edit($cid) {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        
        $this->load->library('form_validation');
        $data['cid'] = $cid;
        $name = $this->input->post('name');
        $data['query'] = $this->category_model->get_one("category_master", array("id" => $cid));
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
		
        if($name != $data['query']->name){
            
            $this->form_validation->set_rules('name', 'Category name', 'trim|required|callback_check_name');
        }
        if ($this->form_validation->run() != FALSE) {
            $name = $this->input->post('name');
			$description = $this->input->post('description');
			$date = date('Y-m-d H:i:s', time());
			
			$slug = $this->category_model->create_unique_slug($name,"category_master","slug","","");
			$data1=array("name" => $name,"description"=>$description,"slug" => $slug,"updated_by" =>$id,"updated_date" =>$date);
			if($_FILES["userfile"]["name"]) {
				  $config['upload_path'] = './media/';
                $config['allowed_types'] = '*';
                $config['file_name'] = time() . $_FILES["userfile"]["name"];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("userfile")) {
					$this->session->set_flashdata('unsuccess', $this->upload->display_errors());
					redirect('category_master/add');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_name = $data["upload_data"]["file_name"];
                    $data1["images"]= base_url()."media/".$file_name;
                 }
            }
			if($_FILES["categoryicon"]["name"]) {
				$config['upload_path'] = './media/';
                $config['allowed_types'] = '*';
                $config['file_name'] = time() . $_FILES["categoryicon"]["name"];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("categoryicon")) {
					$this->session->set_flashdata('unsuccess', $this->upload->display_errors());
					redirect('category_master/add');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_name = $data["upload_data"]["file_name"];
                    $data1["cat_icon"]= base_url()."media/".$file_name;
                 }
            }
			
            $data['query'] = $this->category_model->update("category_master", array("id"=> $cid),$data1);
            
			
			$this->session->set_flashdata("success", "Category successfully updated.");
            redirect("category_master", "refresh");
        } else {
            $this->load->view('header',$data);
            $this->load->view('nav', $data);
            $this->load->view('category_edit', $data);
            $this->load->view('footer',$data);
        }
    }
function set_categoriesget() {
	
foreach ($_GET['list'] as $position => $item)
{
	$data=array("position" =>$position); 
   
  $this->category_model->updateRowWhere('category_master',array("id" =>$item), $data); 
}
 
}

}

?>
