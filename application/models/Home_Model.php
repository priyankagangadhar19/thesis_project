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


}