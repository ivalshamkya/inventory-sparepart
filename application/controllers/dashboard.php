<?php

class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('role_id') !='1' && $this->session->userdata['role_id'] != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }
    
    public function index()
    {   
		$this->data['jumlah_sparepart'] = $this->Msparepart->jumlah();
		$this->data['jumlah_sparein'] 	= $this->Msparein->jumlah();
		$this->data['jumlah_spareout'] 	= $this->Mspareout->jumlah();
		$this->data['jumlah_user'] 	    = $this->Muser->jumlah();
		$this->data['barang'] 			= $this->Msparepart->data_barang();

        $this->load->view('templates/head');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $this->data);
        $this->load->view('templates/table');
    }
	
}