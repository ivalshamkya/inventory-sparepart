<?php

class Lap_masuk extends CI_Controller{
	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('role_id') !='1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
	}

    public function index()
    {   
        $data['title'] = 'Laporan Spare Part Masuk';
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['laporan'] = $this->db->query("SELECT * FROM sparepart_in sin, sparepart sp, user us WHERE sin.part_number=sp.part_number AND sin.nrp=us.nrp AND date(tgl_in) >= '$dari' AND date(tgl_in) <= '$sampai'")->result();

		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('lap_masuk', $data);
		$this->load->view('templates/table');

    }

	public function cetakLaporan()
	{
		$data['title'] = "Laporan Spare Part Masuk";
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$data['laporan'] = $this->db->query("SELECT * FROM sparepart_in sin, sparepart sp, user us WHERE sin.part_number=sp.part_number AND sin.nrp=us.nrp AND date(tgl_in) >= '$dari' AND date(tgl_in) <= '$sampai'")->result();
		
		$this->load->view('templates/head', $data);
		$this->load->view('cetak_lapmasuk', $data);
	}

}