<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: athul
 * Date: 08/09/18
 * Time: 3:51 PM
 */

class Home_Model extends CI_Model {

    public function getJobRolesByCateg($catId){
        $this->db->where('job_category_id', $catId);
        $this->db->where('status', 'active');
        $query = $this->db->get("job_roles");
        $data = $query->result_array();

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );

        return json_encode($result);
    }

    public function getJobsByRole($roleId){
        $this->db->where('job_role_id', $roleId);
        $query = $this->db->get("collected_data");
        $data = $query->result_array();

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );

        return json_encode($result);
    }

    public function getReqList($reqId){
        $this->db->where('id', $reqId);
        $this->db->where('status', 'active');
        $query = $this->db->get("req_list");
        $data = $query->result_array();

        $result = $data[0];

        return $result;
    }


}