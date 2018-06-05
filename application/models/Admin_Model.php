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
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        
        
        $query = $this->db->get("req_categ_list");
        
        
        $data = [];
        
        
        foreach($query->result() as $r) {
            
            $id = $r->id;
            $name = $r->name;
            $description = $r->description;
            
            $data[] = array(
                $id,
                
                $name,
                
                $description,
                
                '<button type="button" class="btn btn-warning">Disable</button>
                 <button type="button" class="btn btn-danger">Delete</button>'
            );
        }
        
        
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );
        
        
        return json_encode($result);
        
        
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