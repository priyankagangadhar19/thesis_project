<?php
class Home extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('Admin_Model');


    }
    
    public function index()
    {
        $jobCateg = $this->Admin_Model->jobCategDataJson();
        $jobRoles = $this->Admin_Model->pureJsonJobRoles();
        $rawData  = $this->Admin_Model->jsonRawData();

        $jobCateg = json_decode($jobCateg);
        $jobRoles = json_decode($jobRoles);
        $rawData = json_decode($rawData);

        $data['jobCateg'] = (array) $jobCateg;
        $data['jobRoles'] = (array) $jobRoles;
        $data['rawData'] = (array) $rawData;

        $this->load->view('home', $data);
    }
}