<?php
class Admin_Model extends CI_Model {
    
    public function login($username,$pass) {
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('user_name',$username);
        $this->db->where('password',$pass);
        
        if($query=$this->db->get())
        {
            return $query->row_array();
        }
        else{
            return false;
        }
    }
    
    
    public function reqCategListJson(){
        
        $this->db->select('*');
        $this->db->from('req_categ_list');
        
        if($query=$this->db->get())
        {
            return ($query->result());
        }
        else{
            return false;
        }
        
    }
    
    public function reqListJson(){
        
        $this->db->select('*');
        $this->db->from('req_list');
        
        if($query=$this->db->get())
        {
            return json_encode($query->result());
        }
        else{
            return false;
        }
        
    }
    
    public function jobCategJson(){
        
        $this->db->select('*');
        $this->db->from('job_category');
        
        if($query=$this->db->get())
        {
            return json_encode($query->result());
        }
        else{
            return false;
        }
        
    }
    
    public function jobRolesJson(){
        
        $this->db->select('*');
        $this->db->from('job_roles');
        
        if($query=$this->db->get())
        {
            return json_encode($query->result());
        }
        else{
            return false;
        }
        
    }
} 