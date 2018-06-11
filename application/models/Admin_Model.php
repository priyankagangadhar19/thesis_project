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
        $number = 1;
        
        
        foreach($query->result() as $r) {
            
            $id = $r->id;
            $name = $r->name;
            $description = $r->description;
            $status = $r->status;
            
            if($status == "active"){
                $fadeTextClass = "font-weight-bold";
                $toggleStatusButton = ' <button id="statusToggleButton" type="button" class="btn btn-warning" itemId="'.$id.'" action="disabled">Disable</button> ';
            }elseif($status == "disabled"){
                $fadeTextClass = "text-muted";
                $toggleStatusButton = ' <button id="statusToggleButton" type="button" class="btn btn-success" itemId="'.$id.'" action="active">Activate</button> ';
            }
            
            $data[] = array(
                '<i class="'.$fadeTextClass.'"><strong>'.$number.'</strong></i>',
                
                '<i class="'.$fadeTextClass.'"><strong>'.$id.'</strong></i>',
                
                '<i class="'.$fadeTextClass.'"><strong>'.$name.'</strong></i>',
                
                '<i class="'.$fadeTextClass.'"><strong>'.$description.'</strong></i>',
                
                '<i class=""><strong>'.$status.'</strong></i>',
                
                $toggleStatusButton
            );
            
            $number++;
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
    
    public function reqcateglistStatusToggle($id, $status) {
        $data = array(
            'status'   => $status
        );
        
        $this->db->where('id', $id);
        $update = $this->db->update('req_categ_list ', $data);

        if ($update) {
            return true;
        }else{
            return false;
        }
        
    }
    
    public function addReqCategItem($name, $description, $status){
        $data = array(
            'name'        => $name,
            'description' => $description,
            'status'      => $status
        );
        
        $insert = $this->db->insert('req_categ_list', $data);
        
        if ($insert) {
            return true;
        }else{
            return false;
        }
    }
    
    
} 