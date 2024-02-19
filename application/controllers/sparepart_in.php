<?php

class Sparepart_in extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Msparein', 'Msparepart']);

        if($this->session->userdata('role_id') !='1' && $this->session->userdata['role_id'] != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }

	}

    public function index()
    {        
		$data['sparepart_in'] = $this->Msparein->data_sparein();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('sparepart_in', $data);
		$this->load->view('templates/table');
    }
	
	public function add_sparepart_in()
	{
		// Mendapatkan dan men-generate id transaksi
		$kode = 'T-IN-' . date('ymd');
		$kode_terakhir = $this->Msparein->getMax('sparepart_in', 'id_transaksi', $kode);
		$kode_tambah = substr($kode_terakhir, -4, 4);
		$kode_tambah++;
		$number = str_pad($kode_tambah, 4, '0', STR_PAD_LEFT);
		$this->data['id_transaksi'] = $kode . $number;

		//select option
		$this->data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		// $this->load->view('templates/head');
		// $this->load->view('templates/sidebar');
		$this->load->view('add_sparepart_in', $this->data);
		// $this->load->view('templates/table');
	}

	public function get_stok_akhir()
	{
		$data = $this->Msparepart->lihat_stok_akhir($_POST['part_number']);
		echo json_encode($data);
	}

	public function proses_tambah()
	{
		$data = [
			'id_transaksi' 			=> $this->input->post('id_transaksi'),
			'tgl_in' 				=> $this->input->post('tgl_in'),
			'triger_ordering' 		=> $this->input->post('triger_ordering'),
			'id_pengambilan_brg' 	=> $this->input->post('id_pengambilan_brg'),
			'part_number' 			=> $this->input->post('part_number'),
			'jumlah' 				=> $this->input->post('jumlah'),
			'keterangan' 			=> $this->input->post('keterangan'),
			'tgl_plan_pasang' 		=> $this->input->post('tgl_plan_pasang'),
			'nrp' 					=> $this->input->post('nrp'),
		];

        //MENGHITUNG DAN MENGUPDATE JUMLAH DAN STOK AKHIR BESERTA PART MASUK
		$stok = $this->Msparepart->getDataWhere('sparepart', 'part_number', $data['part_number'])->row();
        $update = [
            'stok_akhir' => $stok->stok_akhir + (int) $data['jumlah'],
        ];

		$this->Msparepart->update_part_in('sparepart', 'part_number', $data['part_number'], $update);

		//TAMBAH DATA
		$this->Msparein->add_sparein($data);
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part In <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_in');
	}

	public function edit($id_transaksi)
	{
		$where = array('id_transaksi' =>$id_transaksi);
		
		//select option
		$this->data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->data['sparepart_in'] = $this->Msparein->edit_sparein($where, 'sparepart_in')->result();
		
		$this->load->view('edit_sparepartin', $this->data);
	}

	public function update_sparein()
	{
		$id_transaksi 			= $this->input->post('id_transaksi');
		$tgl_in					= $this->input->post('tgl_in');
		$triger_ordering 		= $this->input->post('triger_ordering');
		$id_pengambilan_brg 	= $this->input->post('id_pengambilan_brg');
		$part_number 			= $this->input->post('part_number');
		$jumlah 				= $this->input->post('jumlah');
		$keterangan 			= $this->input->post('keterangan');
		$tgl_plan_pasang 		= $this->input->post('tgl_plan_pasang');
		$nrp					= $this->input->post('nrp');

		$data = array(
			'id_transaksi'			=> $id_transaksi,
			'tgl_in'				=> $tgl_in,
			'triger_ordering'		=> $triger_ordering,
			'id_pengambilan_brg'	=> $id_pengambilan_brg,
			'part_number'			=> $part_number,
			'jumlah' 				=> $jumlah,
			'keterangan'			=> $keterangan,
			'tgl_plan_pasang'		=> $tgl_plan_pasang,
			'nrp'					=> $nrp
		);

		$where = array(
			'id_transaksi' => $id_transaksi
		);
		
		//MENGHITUNG DAN MENGUPDATE JUMLAH DAN STOK AKHIR BESERTA PART MASUK
		$stok_akhir = $this->Msparepart->getDataWhere('sparepart', 'part_number', $part_number)->row();
        $jumlah = $this->Msparepart->getDataWhere('sparepart_in', 'id_transaksi', $id_transaksi)->row();

		$update_stok = [
            'stok_akhir' => $stok_akhir->stok_akhir - $jumlah->jumlah + (int) $data['jumlah'],
        ];
		
        $this->Msparepart->update_part_in('sparepart', 'part_number', $part_number, $update_stok);

		//UPDATE DATA
		$this->Msparein->update_sparein($where,$data,'sparepart_in');
		$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part In <strong>Berhasil</strong> Diubah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_in');
	}

	public function hapus()
	{
        $id_transaksi = $this->uri->segment(3);

		$jumlah = $this->Msparepart->getDataWhere('sparepart_in', 'id_transaksi', $id_transaksi)->row();
        $stok = $this->Msparepart->getDataWhere('sparepart', 'part_number', $jumlah->part_number)->row();

        $update = [
            'stok_akhir' => $stok->stok_akhir - (int) $jumlah->jumlah,
        ];
        $this->Msparepart->update_part_in('sparepart', 'part_number', $stok->part_number, $update);

		$this->Msparein->hapus('sparepart_in', 'id_transaksi', $id_transaksi);

		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part In <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart_in');	
	}


}