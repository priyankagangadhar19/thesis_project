<?php
class Admin extends CI_Controller {
    
    public function index()
    {
        $this->load->view('admin');
    }
    
    public function addreq()
    {
        $this->load->view('admin/addreq');
    }
}