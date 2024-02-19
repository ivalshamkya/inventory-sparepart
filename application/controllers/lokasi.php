<?php

class Lokasi extends CI_Controller
{
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
		$data['lokasi'] = $this->Mlokasi->data_lokasi()->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('lokasi', $data);
		$this->load->view('templates/table');
    }

    public function tambah_lokasi()
	{
		$id_lokasi	= $this->input->post('id_lokasi');
		$nm_lokasi	= $this->input->post('nm_lokasi');
		$keterangan	= $this->input->post('keterangan');
		
		$data = array(
			'id_lokasi'		=> $id_lokasi,
			'nm_lokasi'		=> $nm_lokasi,
			'keterangan'	=> $keterangan	
		);

		$this->Mlokasi->tambah_lokasi($data, 'lokasi');
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Lokasi <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('lokasi');
	}

	public function edit_lokasi($id_lokasi)
	{
		$where = array('id_lokasi' =>$id_lokasi);
		$data['lokasi'] = $this->Mlokasi->edit_lokasi($where, 'lokasi')->result();
	}

	public function update_lokasi()
	{
		$id_lokasi		= $this->input->post('id_lokasi');
		$nm_lokasi		= $this->input->post('nm_lokasi');
		$keterangan		= $this->input->post('keterangan');

		$data = array(
			'id_lokasi'		=> $id_lokasi,
			'nm_lokasi'		=> $nm_lokasi,
			'keterangan'	=> $keterangan,
		);

		$where = array(
			'id_lokasi' => $id_lokasi
		);

		$this->Mlokasi->update_lokasi($where,$data,'lokasi');
		$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Lokasi <strong>Berhasil</strong> Diubah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('lokasi');
	}

	public function hapus_lokasi($id_lokasi)
	{
		$where = array('id_lokasi' => $id_lokasi);
		$this->Mlokasi->hapus_lokasi($where,'lokasi');
		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Lokasi <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('lokasi');	
	}

}