<?php

class Supplier extends CI_Controller{
	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('role_id') !='4' && $this->session->userdata['role_id'] != '5') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {        
		$data['supplier'] = $this->Msupplier->data_supplier()->result();
		$this->load->view('templates/head');
		$this->load->view('purch/sidebar');
		$this->load->view('purch/supplier', $data);
		$this->load->view('templates/table');
    }
	
    public function tambah_supplier()
	{
		// Mendapatkan dan men-generate id transaksi
		// $kode = 'T-IN-' . date('ymd');
		// $kode_terakhir = $this->Msparein->getMax('sparepart_in', 'id_transaksi', $kode);
		// $kode_tambah = substr($kode_terakhir, -4, 4);
		// $kode_tambah++;
		// $number = str_pad($kode_tambah, 4, '0', STR_PAD_LEFT);
		// $this->data['id_transaksi'] = $kode . $number;

		$id_supplier	= $this->input->post('id_supplier');
		$nama_supplier	= $this->input->post('nama_supplier');
		$no_telepon	    = $this->input->post('no_telepon');
		$alamat	        = $this->input->post('alamat');
		
		$data = array(
			'id_supplier'		=> $id_supplier,
			'nama_supplier'		=> $nama_supplier,
			'no_telepon'	    => $no_telepon,
			'alamat'	        => $alamat		
		);

		$this->Msupplier->tambah_supplier($data, 'supplier');
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Supplier <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('purch/supplier');
	}

    public function edit_supplier($id_supplier)
	{
		$where = array('id_supplier' =>$id_supplier);
		$data['supplier'] = $this->Msupplier->edit_supplier($where, 'supplier')->result();
	}

	public function update_supplier()
	{
		$id_supplier	= $this->input->post('id_supplier');
		$nama_supplier	= $this->input->post('nama_supplier');
		$no_telepon	    = $this->input->post('no_telepon');
		$alamat	        = $this->input->post('alamat');

		$data = array(
			'id_supplier'		=> $id_supplier,
			'nama_supplier'		=> $nama_supplier,
			'no_telepon'	    => $no_telepon,
			'alamat'	        => $alamat	
		);

		$where = array(
			'id_supplier' => $id_supplier
		);

		$this->Msupplier->update_supplier($where,$data,'supplier');
		$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Supplier <strong>Berhasil</strong> Diubah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('purch/supplier');
	}

	public function hapus_supplier($id_supplier)
	{
		$where = array('id_supplier' => $id_supplier);
		$this->Msupplier->hapus_supplier($where,'supplier');
		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Supplier <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('purch/supplier');	
	}

}