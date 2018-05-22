<?php
class Admin extends CI_Controller {
    
    public function __construct(){
        
        parent::__construct();
        $this->load->model('Admin_Model');
        
    }

    public function index(){
        $this->load->view('admin/login');
    }
    
    public function login()
    {
        
        $this->load->view('admin/login');
        
        
        
        //$this->load->model('Admin_Model');
        //$this->Admin_Model->login();
        
        //$this->load->view('admin/login');
    }
    
    function dashboard(){
        
        $user_login=array(
            
            'username'=>$this->input->post('username'),
            'user_password'=>md5($this->input->post('user_password'))
            
        );
        
        $data=$this->Admin_Model->login($user_login['username'],$user_login['user_password']);
        if($data)
        {
            $this->session->set_userdata('user_id',$data['id']);
            $this->session->set_userdata('user_email',$data['email']);
            $this->session->set_userdata('username',$data['user_name']);
            $this->session->set_userdata('user_name',$data['name']);
            $this->session->set_userdata('user_role',$data['role']);
            
            $this->load->view('admin/home');
            
        }
        else{
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            $this->load->view("admin/login");
            
        }
        
        
    }
    
    public function logout(){
        
        $this->session->sess_destroy();
        redirect('admin/login', 'refresh');
    }
}