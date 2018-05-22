<?php
class First_Loader extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    } 
}