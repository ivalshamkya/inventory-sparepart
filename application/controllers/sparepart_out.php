<?php

class Sparepart_out extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Mspareout', 'Msparepart']);

		if($this->session->userdata('role_id') !='1' && $this->session->userdata['role_id'] != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
	}

    public function index()
    {        
		$data['sparepart_out'] = $this->Mspareout->data_spareout();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('sparepart_out', $data);
		$this->load->view('templates/table');
    }
	
	public function add_sparepart_out()
	{
		// Mendapatkan dan men-generate id transaksi
		$kode = 'T-OU-' . date('ymd');
		$kode_terakhir = $this->Mspareout->getMax('sparepart_out', 'id_transaksi', $kode);
		$kode_tambah = substr($kode_terakhir, -4, 4);
		$kode_tambah++;
		$number = str_pad($kode_tambah, 4, '0', STR_PAD_LEFT);
		$this->data['id_transaksi'] = $kode . $number;

		//select option
		$this->data['datasparepart'] = $this->Msparepart->lihat_sparepart();

		$this->load->view('add_sparepart_out', $this->data);
	}

	public function proses_tambah()
	{
		$data = [
			'id_transaksi' 			=> $this->input->post('id_transaksi'),
			'tgl_out' 				=> $this->input->post('tgl_out'),
			'part_number' 			=> $this->input->post('part_number'),
			'jumlah' 				=> $this->input->post('jumlah'),
			'keterangan' 			=> $this->input->post('keterangan'),
			'tujuan_penggunaan' 	=> $this->input->post('tujuan_penggunaan'),
			'nrp' 					=> $this->input->post('nrp'),
		];

        //MENGHITUNG JUMLAH DAN STOK AKHIR BESERTA PART KELUAR
		$stok = $this->Msparepart->getDataWhere('sparepart', 'part_number', $data['part_number'])->row();
        $update = [
            'stok_akhir' => $stok->stok_akhir - (int) $data['jumlah'],
        ];

		$this->Msparepart->update_part_out('sparepart', 'part_number', $data['part_number'], $update);

		//TAMBAH DATA
		$this->Mspareout->add_spareout($data);
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part Out <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_out');
	}

	public function edit($id_transaksi)
	{
		$where = array('id_transaksi' =>$id_transaksi);
		//select option
		$this->data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->data['sparepart_out'] = $this->Mspareout->edit_spareout($where, 'sparepart_out')->result();
		
		$this->load->view('edit_sparepartout', $this->data);
	}

	public function update_spareout()
	{
		$id_transaksi 			= $this->input->post('id_transaksi');
		$tgl_out				= $this->input->post('tgl_out');
		$part_number 			= $this->input->post('part_number');
		$jumlah 				= $this->input->post('jumlah');
		$keterangan 			= $this->input->post('keterangan');
		$tujuan_penggunaan 		= $this->input->post('tujuan_penggunaan');
		$nrp					= $this->input->post('nrp');

		$data = array(
			'id_transaksi'			=> $id_transaksi,
			'tgl_out'				=> $tgl_out,
			'part_number'			=> $part_number,
			'jumlah' 				=> $jumlah,
			'keterangan'			=> $keterangan,
			'tujuan_penggunaan'		=> $tujuan_penggunaan,
			'nrp'					=> $nrp
		);

		$where = array(
			'id_transaksi' => $id_transaksi
		);

		//MENGHITUNG DAN MENGUPDATE JUMLAH DAN STOK AKHIR BESERTA PART KELUAR
		$stok_akhir = $this->Msparepart->getDataWhere('sparepart', 'part_number', $part_number)->row();
        $jumlah = $this->Msparepart->getDataWhere('sparepart_out', 'id_transaksi', $id_transaksi)->row();

		$update_stok = [
            'stok_akhir' => $stok_akhir->stok_akhir + $jumlah->jumlah - (int) $data['jumlah'],
        ];
		
        $this->Msparepart->update_part_out('sparepart', 'part_number', $part_number, $update_stok);

		//UPDATE DATA
		$this->Mspareout->update_spareout($where,$data,'sparepart_out');
		$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part Out <strong>Berhasil</strong> Diubah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_out');
	}
	
	public function hapus()
	{
		$id_transaksi = $this->uri->segment(3);

		$jumlah = $this->Msparepart->getDataWhere('sparepart_out', 'id_transaksi', $id_transaksi)->row();
        $stok = $this->Msparepart->getDataWhere('sparepart', 'part_number', $jumlah->part_number)->row();

        $update = [
            'stok_akhir' => $stok->stok_akhir + (int) $jumlah->jumlah,
        ];
        $this->Msparepart->update_part_out('sparepart', 'part_number', $stok->part_number, $update);

		$this->Mspareout->hapus('sparepart_out', 'id_transaksi', $id_transaksi);

		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part Out <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_out');	
	}

}