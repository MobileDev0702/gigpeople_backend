<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Admin_model');

        if(!empty($this->session->userdata('gid'))) {
            redirect('admin');
        }		
	}

	function index()
	{
		$this->load->view('admin/login_header/header');
        $this->load->view('admin/login');
        $this->load->view('admin/login_footer/footer');
	}

    function adminLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $details = $this->Admin_model->getAdminDetails(array('email' => $email))->row();
    
        if (empty($details))
        {
            $data['status'] = "0";
            $data['message'] = "Email Id not exists";
        }
        else
        {
            $password = md5($password);
            $details = $this->Admin_model->getAdminDetails(array('email' => $email, 'password' => $password))->row();
            if (empty($details))
            {
                $data['status'] = "0";
                $data['message'] = "Password is incorrect";
            }
            else
            {
                $data['status'] = "1";
                $data['message'] = "Login Success!!";

                $sess_data = array( 
                    'gemail'     => $details->email, 
                    'gname'      => $details->admin_name, 
                    'gimage'     => $details->image,
                    'gid'        => $details->admin_id
                );              

                $this->session->set_userdata($sess_data);
            }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
}