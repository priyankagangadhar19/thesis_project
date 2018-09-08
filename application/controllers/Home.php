<?php
class Home extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('Admin_Model');
        $this->load->model('Home_Model');


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

    public function getJobRolesByCateg(){

        $catId = $this->input->post('id');
        $jsonData = $this->Home_Model->getJobRolesByCateg($catId);

        $data = ((array) json_decode($jsonData));

        print_r(json_encode($data['data']));
        return;
    }

    public function getJobsAndSkillByRole(){

        $roleId = $this->input->post('id');
        $jsonData = $this->Home_Model->getJobsByRole($roleId);

        $data = ((array) json_decode($jsonData));
        $rawData = (array) $data['data'];

        $reqIdListArray = array();
        foreach ($rawData as $entry){
            $reqListIds = $entry->requirements;
            $reqListArrayRow = $this->explode_brackets("$reqListIds", ",","[", "]");
            $reqIdListArray = array_merge($reqIdListArray, $reqListArrayRow);
        }

        $uniqueReqIds = array_unique($reqIdListArray);

        $reqListArray = array();
        foreach ($uniqueReqIds as $reqId){
            $reqList = $this->Home_Model->getReqList($reqId);
            $reqListArray[$reqId] = $reqList;
        }

        $JobsAndSkills = array();
        $JobsAndSkills['jobs'] = $rawData;
        $JobsAndSkills['skills'] = $reqListArray;

        print_r(json_encode($JobsAndSkills));
        return;
    }

    public function explode_brackets($reqList, $separator=",", $leftbracket="(", $rightbracket=")", $quotesType = '"') {

        $leftBracketRemoved  = str_replace("$leftbracket","","$reqList");
        $rightBracketRemoved = str_replace("$rightbracket","","$leftBracketRemoved");
        $quotesRemoved       = str_replace("$quotesType","","$rightBracketRemoved");

        $finalString = $quotesRemoved;

        $itemsArray = explode(',', $finalString);

        return $itemsArray;
    }




}