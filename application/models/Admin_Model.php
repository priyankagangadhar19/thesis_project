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
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        
        
        $query = $this->db->get("req_list");
        
        
        $data = [];
        $number = 1;
        
        
        foreach($query->result() as $r) {
            
            $id = $r->id;
            $name = $r->name;
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
    
    public function jobCategJson(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        
        
        $query = $this->db->get("job_category");
        
        
        $data = [];
        $number = 1;
        
        
        foreach($query->result() as $r) {
            
            $id = $r->id;
            $category = $r->category;
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
                
                '<i class="'.$fadeTextClass.'"><strong>'.$category.'</strong></i>',
                
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
    
    public function jobRolesJson(){
        
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        
        
        $query = $this->db->get("job_roles");
        
        
        $data = [];
        $number = 1;
        
        
        foreach($query->result() as $r) {
            
            $id = $r->id;
            $jobCategoryId = $r->job_category_id;
            $name = $r->role;
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
                
                '<i class="'.$fadeTextClass.'"><strong>'.$jobCategoryId.'</strong></i>',
                
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
    
    public function jobcategStatusToggle($id, $status) {
        $data = array(
            'status'   => $status
        );
        
        $this->db->where('id', $id);
        $update = $this->db->update('job_category', $data);
        
        if ($update) {
            return true;
        }else{
            return false;
        }
        
    }
    
    public function addJobCategItem($name, $description, $status){
        
        $data = array(
            'category'    => $name,
            'description' => $description,
            'status'      => $status
        );
        
        $insert = $this->db->insert('job_category', $data);
        
        if ($insert) {
            return true;
        }else{
            return false;
        }
    }
    
    public function jobrolesStatusToggle($id, $status) {
        $data = array(
            'status'   => $status
        );
        
        $this->db->where('id', $id);
        $update = $this->db->update('job_roles', $data);
        
        if ($update) {
            return true;
        }else{
            return false;
        }
        
    }
    
    public function addJobRolesItem($name, $category, $description, $status){
        
        $data = array(
            'role'               => $name,
            'job_category_id'    => $category, 
            'description'        => $description,
            'status'             => $status
        );
        
        $insert = $this->db->insert('job_roles', $data);
        
        if ($insert) {
            return true;
        }else{
            return false;
        }        
    }
    
    public function reqlistStatusToggle($id, $status) {
        $data = array(
            'status'   => $status
        );
        
        $this->db->where('id', $id);
        $update = $this->db->update('req_list', $data);
        
        if ($update) {
            return true;
        }else{
            return false;
        }
        
    }
    
    public function addReqListItem($name, $category, $description, $status){
        $data = array(
            'name'        => $name,
            'req_categ'   => $category,
            'description' => $description,
            'status'      => $status
        );
        
        $insert = $this->db->insert('req_list', $data);
        
        if ($insert) {
            return true;
        }else{
            return false;
        }
    }
    
    public function jobCategDataJson(){
        
        $this->db->where('status', 'active');
        $query = $this->db->get("job_category");
        $data = $query->result_array();
        
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );
        
        
        return json_encode($result);
        
    }
    
    public function reqCategDataJson(){
        
        $this->db->where('status', 'active');
        $query = $this->db->get("req_categ_list");
        $data = $query->result_array();
        
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );
        
        
        return json_encode($result);
        
    }
    
} 