<?php

class Mesin extends CI_Controller{
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
		$data['mesin'] = $this->Mmesin->data_mesin()->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('mesin', $data);
		$this->load->view('templates/table');
    }

    public function tambah_mesin()
	{
		$id_mesin	= $this->input->post('id_mesin');
		$nm_mesin	= $this->input->post('nm_mesin');
		$keterangan	= $this->input->post('keterangan');
		
		$data = array(
			'id_mesin'		=> $id_mesin,
			'nm_mesin'		=> $nm_mesin,
			'keterangan'	=> $keterangan	
		);

		$this->Mmesin->tambah_mesin($data, 'mesin');
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Mesin <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('mesin');
	}

	public function edit_mesin($id_mesin)
	{
		$where = array('id_mesin' =>$id_mesin);
		$data['mesin'] = $this->Mmesin->edit_mesin($where, 'mesin')->result();
	}

	public function update_mesin()
	{
		$id_mesin		= $this->input->post('id_mesin');
		$nm_mesin		= $this->input->post('nm_mesin');
		$keterangan		= $this->input->post('keterangan');

		$data = array(
			'id_mesin'		=> $id_mesin,
			'nm_mesin'		=> $nm_mesin,
			'keterangan'	=> $keterangan,
		);

		$where = array(
			'id_mesin' => $id_mesin
		);

		$this->Mmesin->update_mesin($where,$data,'mesin');
		$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Mesin <strong>Berhasil</strong> Diubah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('mesin');
	}

	public function hapus_mesin($id_mesin)
	{
		$where = array('id_mesin' => $id_mesin);
		$this->Mmesin->hapus_mesin($where,'mesin');
		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Mesin <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('mesin');	
	}

}