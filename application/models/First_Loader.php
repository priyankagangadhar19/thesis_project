<?php
class First_Loader extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    } 
}