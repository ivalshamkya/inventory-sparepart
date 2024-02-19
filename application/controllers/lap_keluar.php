<?php

class Lap_keluar extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Mlapkeluar']);

		if($this->session->userdata('role_id') !='1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
	}

    public function index()
    {   
        $data['title'] = 'Laporan Spare Part Keluar';
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['laporan'] = $this->db->query("SELECT * FROM sparepart_out ut, sparepart sp, user us WHERE ut.part_number=sp.part_number AND ut.nrp=us.nrp AND date(tgl_out) >= '$dari' AND date(tgl_out) <= '$sampai'")->result();

		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('lap_keluar', $data);
		$this->load->view('templates/table');

    }

	public function cetakLaporan()
	{
		$data['title'] = "Laporan Spare Part Keluar";
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$data['laporan'] = $this->db->query("SELECT * FROM sparepart_out ut, sparepart sp, user us WHERE ut.part_number=sp.part_number AND ut.nrp=us.nrp AND date(tgl_out) >= '$dari' AND date(tgl_out) <= '$sampai'")->result();
		
		$this->load->view('templates/head', $data);
		$this->load->view('cetak_lapkeluar', $data);
	}

}