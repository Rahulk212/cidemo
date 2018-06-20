<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            
        } else {
            redirect('login');
        }
        
        $this->load->model('invoice_model');
    }

    

    function index() {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        
        $this->load->library('pagination');
        //print_r($data['success']);
        $name = $this->input->get('name');
        $email = $this->input->get('email');
        $mobile = $this->input->get('mobile');
        $county = $this->input->get('county');
		$date = $this->input->get('date');
        $data['name1'] = $name;
        $data['email'] = $email;
        $data['mobile'] = $mobile;
        $data['date'] = $date;
        $date = $this->input->get('date');
        
            $total_row = $this->invoice_model->num_row_srch();
            $config["base_url"] = base_url() . "invoice/index";
            $config["total_rows"] = $total_row;
            $config["per_page"] = 50;
            $config['page_query_string'] = TRUE;
            $config['cur_tag_open'] = '<span>';
            $config['cur_tag_close'] = '</span>';
            $config['next_link'] = 'Next &rsaquo;';
            $config['prev_link'] = '&lsaquo; Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
            $data['query'] = $this->invoice_model->row_srch($config["per_page"], $page);
            $data["page"] = $page;
            $data["links"] = $this->pagination->create_links();
        

		
        $this->load->view('header', $data);
        $this->load->view('nav', $data);
        $this->load->view('invoice_view', $data);
        $this->load->view('footer', $data);
    }

    function add() {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        $data['comman'] = $this->comman;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Display Name', 'trim|required');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_email');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_emailcheck|callback_check_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
            $name = $this->input->post('name');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $gender = $this->input->post('gender');
            $address = $this->input->post('address');
            $this->load->helper('string');
            $pass = random_string('alnum', 5);
			$slug = $this->users_model->create_unique_slug($name,"customer_master","slug","","");
            $data = array(
                "name" => $name,
                "fname" => $fname,
                "lname" => $lname,
                "email" => $email,
                "mobile" => $mobile,
                "gender" => $gender,
                "address" => $address,
                "password" => $pass,
                "status" => '1',
                'active' => '1',
                'type' => '1',
				'slug' => $slug,
				"created_by" =>$id,
				"created_date" => date("Y-m-d G:i:s") 
            );
            $data['query'] = $this->users_model->insert("customer_master", $data);
            $this->load->helper(array('swift'));
            $result = $this->users_model->get_one('email_template',array('id' => '1'));
            $body = $result->text; 
            $subject = $result->subject;
            $link=base_url();
            $body=str_replace('{{name}}', ucwords($name), $body);
            $body=str_replace('{{username}}', $email, $body);
            $body=str_replace('{{password}}', $pass, $body);
            $body=str_replace('{{link}}', $link, $body);
            $body=str_replace('&lt;', '<', $body);
            $body=str_replace('&gt;', '>', $body);
            $body=str_replace('&quot;', '"', $body);
            send_mail($email,$subject,$body);
            //echo $body; die();
            $this->session->set_flashdata("success", "Customer successfully added.");
            redirect("administrator/users", "refresh");
        } else {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/nav', $data);
            $this->load->view('admin/users_add', $data);
            $this->load->view('admin/footer', $data);
        }
    }

    function delete($uid) {
        $data['query'] = $this->users_model->update("customer_master", array("id" => $uid), array("status" => "0"));
        $this->session->set_flashdata("success", "Customer successfully deleted.");
        redirect("administrator/users", "refresh");
    }

    function deactive($uid) {
        $data['query'] = $this->users_model->update("customer_master", array("id" => $uid), array("status"=>'0',"active" => "2"));
        $this->session->set_flashdata("success", "Customer successfully deactivated.");
        redirect("administrator/users", "refresh");
    }
    function active($uid) {
        $data['query'] = $this->users_model->update("customer_master", array("id" => $uid), array("status"=>"1","active" => "1"));
        $this->session->set_flashdata("success", "Customer successfully activated.");
        redirect("administrator/users", "refresh");
    }
	function suspende() {
		
		 $this->load->library('form_validation');
        $this->form_validation->set_rules('userid', 'userid', 'trim|required');
		if ($this->form_validation->run() != FALSE) {
		$userid = $this->input->post('userid');
          $userremark=$this->input->post('userremark');	
		
        $data['query'] = $this->users_model->update("customer_master", array("id" =>$userid), array("remrk"=>$userremark,"status" =>"0","active"=>"0"));
        $this->session->set_flashdata("success", "Customer successfully suspended.");
        redirect("administrator/users", "refresh");
		}else{ redirect("administrator/users", "refresh"); }
    }

    function edit($uid) {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            $data['name'] = $login_session['name'];
            $id = $login_session['id'];
        }
        $data['comman'] = $this->comman;

        $data["uid"] = $uid;
        $data['query'] = $this->users_model->userinfobilling($uid);
        //print_r($data['query']); die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Display Name', 'trim|required');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_emailcheck');
        $email = $this->input->post('email');
        if($email != $data['query']->email){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_emailcheck|callback_check_email');
        }
            if($this->input->post('chng_pwd')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			}
			
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
		 $this->form_validation->set_rules('billname','Billing Full Name','trim');
		 $this->form_validation->set_rules('accountno','Account number','trim|numeric');
		 $this->form_validation->set_rules('ifsccode','Ifsc code','trim');
        
        if ($this->form_validation->run() != FALSE) {
            $name = $this->input->post('name');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $gender = $this->input->post('gender');
            $address = $this->input->post('address');
			$password= $this->input->post("password");
			$chng_pwd=$this->input->post('chng_pwd');
			$slug = $this->users_model->create_unique_slug($name,"customer_master","slug","","");
            $data = array(
                "name" => $name,
                "fname" => $fname,
                "lname" => $lname,
                "email" => $email,
                "mobile" => $mobile,
                "gender" => $gender,
                "address" => $address,
                "status" => '1',
                "active" => '1',
                "type" => '1',
				"slug" => $slug,
				"updated_by" =>$id,
				"updated_date" => date("Y-m-d G:i:s") 
            );
			if(isset($chng_pwd)){ if($password != ""){ $data['password']=$password; } }
			
			if($_FILES['profilepic']["name"]){ 
	
$newFileName = $_FILES['profilepic']['name'];
$fileExt = explode('.', $newFileName);
$filename = md5(time()).".".end($fileExt);

set_time_limit(0);
$config['upload_path'] ="./media/profilepic/";
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['file_name'] = $filename;

$this->load->library('upload', $config);
$this->upload->initialize($config);
if(!$this->upload->do_upload('profilepic')) {
$error = array($this->upload->display_errors());
$this->session->set_flashdata('unsuccess', $this->upload->display_errors());
					redirect("administrator/users/edit/$uid");
} else {
	
	$profile=base_url()."media/profilepic/".$config['file_name'];
	
$data['profilepic']=$profile;

}

}
            $this->users_model->update("customer_master", array("id" => $uid), $data);
			
		$billname= $this->input->post('billname');
		$accountno= $this->input->post('accountno');
		$ifsccode= $this->input->post('ifsccode');
		
		$exmonth= $this->input->post('exmonth');
		$exyear= $this->input->post('exyear');
		
		$data1=array("user_fk"=>$uid,"user_name" =>$billname,"accountno"=>$accountno,"ex_month"=>$exmonth,"ex_year"=>$exyear,"ifsccode"=>$ifsccode);
		$billrow=$this->users_model->num_row('user_billing_info',array("user_fk"=>$uid,"status" =>'1'));
if($billrow == '0'){$this->users_model->master_fun_insert('user_billing_info',$data1); }else{ $this->users_model->updateRowWhere('user_billing_info',array("user_fk" =>$uid),$data1);   }
		
            $this->session->set_flashdata("success", "Customer successfully updated.");
            redirect("administrator/users", "refresh");
        } else {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/nav', $data);
            $this->load->view('admin/users_edit', $data);
            $this->load->view('admin/footer', $data);
        }
    }

}

?>
