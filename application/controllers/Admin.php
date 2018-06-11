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
            $this->session->set_userdata('user_id',$response['id']);
            $this->session->set_userdata('user_email',$response['email']);
            $this->session->set_userdata('username',$response['user_name']);
            $this->session->set_userdata('user_name',$response['name']);
            $this->session->set_userdata('user_role',$response['role']);
            $this->session->set_userdata('user_session',"active");
            
            //print_r($user_login); exit;
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
        $this->loginCheck();
        
        $jsonData = $this->Admin_Model->reqCategListJson();
        echo $jsonData;
        exit();
        
    }
    
    public function reqListJson(){
        
        $jsonData = $this->Admin_Model->reqListJson();
        return $jsonData;
        
    }
    
    public function jobCategJson(){
        $this->loginCheck();
        
        $jsonData = $this->Admin_Model->jobCategJson();
        echo $jsonData;
        exit();
    }
    
    public function jobRolesJson(){
        $this->loginCheck();
        
        $jsonData = $this->Admin_Model->jobRolesJson();
        echo $jsonData;
        exit();
        
    }
    
    public function toMD5($value){
        $this->loginCheck();
        
        $md5 = md5($value);
        
        echo $md5;
        exit();
        
    }
    
    public function reqcateglistStatusToggle(){
        $this->loginCheck();
        
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        if ($status == "disabled" OR $status == "active") {
            $response = $this->Admin_Model->reqcateglistStatusToggle($id, $status);
        }else{
            $response = "error";
            echo $response;
            exit();
        }
        
        if ($response == true) {
            echo 'true';
            exit();
        }else {
            echo 'false';
            exit();
        }
    }
    
    public function addReqCategItem(){
        $this->loginCheck();
        
        $name = "";
        $description = "";
        $status = "";
        
        $name = $this->input->post('itemName');
        $description = $this->input->post('itemDescription');
        $status = $this->input->post('itemStatus');
        
        if ($name !== "") {
            if($status == "active" || $status == "disabled"){
                $response = $this->Admin_Model->addReqCategItem($name, $description, $status);
            }else{
                $response = "error: name can't be empty and status should be either 'active' or 'disabled'!";
            }
            
        }else{
            $response = "error: name can't be empty and status should be either 'active' or 'disabled'!";
        }
        
        if ($response === true) {
            echo 'true';
        }else {
            echo 'false';
        }
        
    }
    
    public function jobcategStatusToggle(){
        $this->loginCheck();
        
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        if ($status == "disabled" OR $status == "active") {
            $response = $this->Admin_Model->jobcategStatusToggle($id, $status);
        }else{
            $response = "error";
            echo $response;
            exit();
        }
        
        if ($response == true) {
            echo 'true';
            exit();
        }else {
            echo 'false';
            exit();
        }
    }
    
}