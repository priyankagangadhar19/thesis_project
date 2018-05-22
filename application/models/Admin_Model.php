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
} 