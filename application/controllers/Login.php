<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
		
    }
    function index() {
        $login_session = $this->session->userdata('logged_admin');
        if ($login_session) {
            redirect('invoice', 'refresh');
        }
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        } else {
            redirect('invoice', 'refresh');
        }
    }
    function check_database($password) {
        $username = $this->input->post('email');
        $result = $this->login_model->checklogin($username, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'name' => $row->name,
                    'usernae' => $row->email,
                );
                $this->session->set_userdata('logged_admin', $sess_array);
            }
            return TRUE;
        } else {

            $this->form_validation->set_message('check_database', 'Invalid Email or password');
            return false;
        }
    }
    
    function logout() {
        $this->session->unset_userdata('logged_admin');
        redirect('login');
    }
}?>