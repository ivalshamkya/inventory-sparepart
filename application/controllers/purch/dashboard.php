<?php

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('role_id') !='4') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {   
        $this->load->view('templates/head');
        $this->load->view('purch/sidebar');
        $this->load->view('purch/dashboard');
        $this->load->view('templates/table');
    }
}