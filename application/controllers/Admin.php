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
        $this->load->view("admin/login");
        
    }
    
    public function loginGate()
    {
        
        $user_login=array(
            
            'username'=>$this->input->post('username'),
            'user_password'=>md5($this->input->post('user_password'))
            
        );
        
        $response = $this->Admin_Model->login($user_login['username'],$user_login['user_password']);
        if($response)
        {
            $this->session->set_userdata('user_id',$data['id']);
            $this->session->set_userdata('user_email',$data['email']);
            $this->session->set_userdata('username',$data['user_name']);
            $this->session->set_userdata('user_name',$data['name']);
            $this->session->set_userdata('user_role',$data['role']);
            $this->session->set_userdata('user_session',"active");
            
            
            return redirect('admin/dashboard');
            
        }
        elseif(!empty($user_login['username'])){
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            $this->load->view("admin/login");
            
        }else{
            $this->load->view("admin/login");
        }
    }
    
    public function loginCheck(){
        if ($this->session->userdata('user_session') !== "active") {
            return redirect('admin/login');
        }
    }
    
    public function dashboard(){
        $this->loginCheck();
        $this->load->view('admin/dashboard');
          
    }
    
    public function logout(){
        
        $this->session->set_userdata('user_session',"inactive");
        $this->session->sess_destroy();
        $this->session->set_flashdata('warning_msg', 'Logged Out!');
        $this->load->view("admin/login");
    }
    
    
    
    
    public function reqCategList(){
        $this->loginCheck();
        
        //$jsonlist = $this->reqCategListJson();
        $this->load->view('admin/reqcateglist');
    }
    
    public function reqList(){
        $this->loginCheck();
        
        $this->load->view('admin/reqlist');
    }
    
    public function jobCateg(){
        $this->loginCheck();
        
        $this->load->view('admin/jobcateg');
    }
    
    public function jobRoles(){
        $this->loginCheck();
        
        $this->load->view('admin/jobroles');
    }
    
    
    
    
    public function reqCategListJson(){
        
        $jsonData = $this->Admin_Model->reqCategListJson();
        echo json_encode($jsonData);
        exit();
        
    }
    
    public function reqListJson(){
        
        $jsonData = $this->Admin_Model->reqListJson();
        return $jsonData;
        
    }
    
    public function jobCategJson(){
        
        $jsonData = $this->Admin_Model->jobCategJson();
        return $jsonData;
        
    }
    
    public function jobRolesJson(){
        
        $jsonData = $this->Admin_Model->jobRolesJson();
        return $jsonData;
        
    }
}