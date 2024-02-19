<?php

class List_order extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Msparepart', 'Mmesin', 'Mlokasi']);
		$this->load->model('Mpenerimaan', 'm_penerimaan');
		$this->load->model('Mdetailpenerimaan', 'm_detail_terima');
	}

    public function index()
    {        
		if($this->input->get('status')) {
			$status = $this->input->get('status');

			if($status == 'approved'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => '1', 'LENGTH(wbs) >' => 1, 'id_supplier >' => '0', 'apprWAHO' => 1])->result();
			elseif($status == 'waiting'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => NULL, 'wbs' => NULL, 'id_supplier' => NULL, 'apprWAHO' => NULL])->result();
			elseif($status == 'rejected'):
				$data['detail_order'] = $this->db->where('apprSH', '0')->or_where('wbs', '0')->or_where('id_supplier', '0')->or_where('apprWAHO', '0')->get('detail_order')->result();
			endif;
		}
		else{
			$data['detail_order'] = $this->Mlistorder->detail_listorder()->result();
		}
		$data['list_order'] = $this->Mlistorder->get_listorder()->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('list_order', $data);
		$this->load->view('templates/table');
    }
	
    public function add_list_order()
	{
		//select option
		$this->data['datasparepart'] = $this->Msparepart->lihat_sparepart();

		$this->load->view('add_list_order', $this->data);
	}

	public function get_all_sparepart(){
		$data = $this->Msparepart->lihat_deskripsi($_POST['deskripsi']);
		echo json_encode($data);
	}

	public function keranjang_sparepart(){
		$this->load->view('keranjang');
	}

	public function proses_tambah(){
		$jumlah_barang_diterima = count($this->input->post('part_number'));

		$data_terima = [
			'id_order' => $this->input->post('id_order'),
			'tgl_order' => date('Y-m-d', strtotime($this->input->post('tgl_order'))),
			'creaby' => $this->input->post('nrp'),
		];

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			$data_detail_terima[$i]['id_order'] = $this->input->post('id_order');
			$data_detail_terima[$i]['part_number'] = $this->input->post('part_number')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('qty')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan')[$i];
			$data_detail_terima[$i]['deskripsi'] = $this->input->post('deskripsi')[$i];
		}

		if($this->m_penerimaan->tambah($data_terima)){
			for($i = 0; $i < $jumlah_barang_diterima; $i++){
				$this->m_detail_terima->tambah($data_detail_terima[$i]);
			}
			// for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
			// 	$this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['part_number']) or die('gagal min stok');
			// }
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('list_order');
		}
		redirect('list_order');
	}

	public function edit_sparepart($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->load->view('edit_list_order', $data);
	}

	public function proses_edit(){
		$jumlah_barang_diterima = count($this->input->post('part_number'));

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			$data_detail_terima[$i]['id_order'] = $this->input->post('id_order');
			$data_detail_terima[$i]['part_number'] = $this->input->post('part_number')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('qty')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan')[$i];
			$data_detail_terima[$i]['deskripsi'] = $this->input->post('deskripsi')[$i];
		}

		// Reset detail_order of selected order
		$this->m_detail_terima->deleteAll($this->input->post('id_order'));

		// Re-insert detial_order of selected order
		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			$this->m_detail_terima->tambah($data_detail_terima[$i]);
		}
		
		$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
		redirect('list_order');
	}

	public function proses_delete($id_order, $part_number) {
		if($this->m_detail_terima->delete($id_order, $part_number)) {
			$this->session->set_flashdata('success', 'Delete berhasil!');
			redirect('list_order');
		}
		$this->session->set_flashdata('fail', 'Delete gagal!');
		redirect('list_order');
	}

	public function detail_order($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->load->view('detail_order', $data);
	}

	// public function edit_sparepart($part_number)
	// {
	// 	$where = array('part_number' =>$part_number);
	// 	$data['sparepart'] = $this->Msparepart->edit_sparepart($where, 'sparepart')->result();
	// 	$this->load->view('templates/header');
	// 	$this->load->view('templates/sidebar');
	// 	$this->load->view('edit_sparepart', $data);
	// 	$this->load->view('templates/footer');
	// }

	
	// public function update_sparepart()
	// {
	// 	$part_number		= $this->input->post('part_number');
	// 	$nm_mesin		= $this->input->post('nm_mesin');
	// 	$keterangan		= $this->input->post('keterangan');

	// 	$data = array(
	// 		'part_number'		=> $part_number,
	// 		'nm_mesin'		=> $nm_mesin,
	// 		'keterangan'	=> $keterangan,
	// 	);

	// 	$where = array(
	// 		'part_number' => $part_number
	// 	);

	// 	$this->inventory->update_mesin($where,$data,'mesin');
	// 	redirect('dashboard/mesin');
	// }

	// public function hapus_sparepart($part_number)
	// {
	// 	$where = array('part_number' => $part_number);
	// 	$this->Msparepart->hapus_sparepart($where,'sparepart');
	// 	redirect('sparepart');	
	// }

}