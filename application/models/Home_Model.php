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
        $this->db->select('req_list.*, req_categ_list.name AS cName');
        $this->db->from('req_list');
        $this->db->where('req_list.id', $reqId);
        $this->db->where('req_list.status', 'active');
        $this->db->join('req_categ_list', 'req_categ_list.id = req_list.req_categ');
        $query = $this->db->get();
        $data = $query->result_array();

        $result = $data[0];

        return $result;
    }

    public function getReqListByRole($roleId){
        $this->db->select('requirements');
        $this->db->where('job_role_id', $roleId);
        $query = $this->db->get("collected_data");
        $data = $query->result_array();


        $result = $data;

        return $result;
    }

    public function getCategId($reqId){
        $this->db->select('req_categ');
        $this->db->where('id', $reqId);
        $query = $this->db->get("req_list");
        $data = $query->result_array();

        $result = $data[0]['req_categ'];

        return $result;
    }

    public function getCategName($CatId){
        $this->db->select('name');
        $this->db->where('id', $CatId);
        $query = $this->db->get("req_categ_list");
        $data = $query->result_array();

        $result = $data[0]['name'];

        return $result;
    }

    public function getReqName($reqId){
        $this->db->select('name');
        $this->db->where('id', $reqId);
        $query = $this->db->get("req_list");
        $data = $query->result_array();

        $result = $data[0]['name'];

        return $result;
    }


}