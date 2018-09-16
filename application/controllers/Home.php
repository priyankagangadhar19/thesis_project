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

    public function getReqIdsByRole($roleId){

        $data = $this->Home_Model->getReqListByRole($roleId);

        $reqIdList = array();
        foreach ($data as $row) {
            $IdList = $row['requirements'];
            $IdArray = $this->explode_brackets("$IdList", ",","[", "]");
            foreach ($IdArray as $id){
                $reqIdList[] = $id;
            }
        }

        return $reqIdList;
    }

    public function reqListAndCategJson(){

        $roleId = $this->input->post('id');
        $reqList = array_unique($this->getReqIdsByRole($roleId));

        foreach ($reqList as $reqId){
            $catId = $this->Home_Model->getCategId($reqId);
            $wholeData[$reqId]['reqId'] = $reqId;
            $wholeData[$reqId]['catId'] = $catId;
        }

        $processList = array();
        foreach ($wholeData as $data){
            $catId = $data['catId'];
            $processList[$catId][] = $data['reqId'];
        }

        $finalList = array();
        foreach ($processList as $catId => $reqIds){
            $catName = $this->Home_Model->getCategName($catId);
            foreach ($reqIds as $reqId){
                $finalList[$catName][] = $reqName = $this->Home_Model->getReqName($reqId);
            }
        }

        print_r(json_encode($finalList));
        return;
    }

    public function getSkillCountArray($roleId){
        $reqList = $this->getReqIdsByRole($roleId);

        $repeatCount = array();
        foreach ($reqList as $reqId){
            $indexes = array_keys($reqList, $reqId);
            $repeatCount[$reqId] = count($indexes);
        }

        return $repeatCount;
    }

    public function getSkillCountForRole($roleId, $skillId){
        $skillsCountArray = $this->getSkillCountArray($roleId);
        $result = $skillsCountArray[$skillId];

        return $result;
    }

    public function mostPreferredSkillByCateg($roleId){
        $reqList = array_unique($this->getReqIdsByRole($roleId));
        $skillsCountArray = $this->getSkillCountArray($roleId);

        foreach ($reqList as $reqId){
            $catId = $this->Home_Model->getCategId($reqId);
            $wholeData[$reqId]['reqId'] = $reqId;
            $wholeData[$reqId]['catId'] = $catId;
            $wholeData[$reqId]['repeats'] = $skillsCountArray[$reqId];
        }

        $processList = array();
        foreach ($wholeData as $data){
            $catId = $data['catId'];
            $reqid = $data['reqId'];
            $processList[$catId][$reqid]['catId'] = $data['catId'];
            $processList[$catId][$reqid]['reqId'] = $data['reqId'];
            $processList[$catId][$reqid]['repeats'] = $data['repeats'];
        }

        $mostPrefArray = array();
        $tempNumb = 0;
        foreach ($processList as $categ => $skills){
            foreach ($skills as $skill){
                $tempNumbNow = $skill['repeats'];
                if ($tempNumbNow >= $tempNumb){
                    $mostPrefArray[$categ] = $skill['reqId'];
                    $tempNumb = $tempNumbNow;
                }
            }
            $tempNumb = 0;
        }

        return $mostPrefArray;
    }

    public function mostPrefjson(){

        $roleId = $this->input->post('id');

        $mostPrefIdsArray = $this->mostPreferredSkillByCateg($roleId);

        $mostPrefArray = array();
        foreach ($mostPrefIdsArray as $cat => $req){
            $catName = $this->Home_Model->getCategName($cat);
            $reqName = $this->Home_Model->getReqName($req);

            $mostPrefArray[$catName] = $reqName;
        }

        print_r(json_encode($mostPrefArray));
        return;
    }

    public function topRankedSkillsJson(){
        $roleId = $this->input->post('id');
        $repeatThreshold = 1;
        $repeatCount = $this->getSkillCountArray($roleId);

        $data = array();
        foreach ($repeatCount as $reqId => $nosRepeated){
            if ($nosRepeated >= $repeatThreshold){
                $data[$reqId]['name'] = $this->Home_Model->getReqName($reqId);
                $data[$reqId]['repeated'] = $nosRepeated;
            }
        }

        foreach ($data as $key => $row) {
            $repeated[$key]  = $row['repeated'];
        }

        array_multisort($repeated, SORT_DESC, $data);

        print_r(json_encode($data));
        return;

    }
}