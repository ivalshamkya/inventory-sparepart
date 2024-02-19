<?php

class List_order extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Msparepart', 'Mmesin', 'Mlokasi']);
		$this->load->model('Mpenerimaan', 'm_penerimaan');
		$this->load->model('Msupplier', 'm_supplier');
		$this->load->model('Mdetailpenerimaan', 'm_detail_terima');
	}

    public function index()
    {        
		if($this->input->get('status')) {
			$status = $this->input->get('status');

			if($status == 'approved'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['wbs !=' => 0, 'id_supplier >' => '0'])->result();
			elseif($status == 'rejected'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['wbs !=' => 0, 'id_supplier' => '0'])->result();
			elseif($status == 'waiting'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['wbs !=' => 0, 'id_supplier' => NULL])->result();
			endif;

		}
		else{
			$data['detail_order'] = $this->Mlistorder->detail_listorder(['wbs !=' => 0])->result();
		}
		$this->load->view('templates/head');
		$this->load->view('purch/sidebar');
		$this->load->view('purch/list_order', $data);
		$this->load->view('templates/table');
    }

	public function approve() {

		$jumlah_barang_diterima = count($this->input->post('part_number'));

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			$data_detail_terima[$i]['id_order'] = $this->input->post('id_order');
			$data_detail_terima[$i]['part_number'] = $this->input->post('part_number')[$i];
			$data_detail_terima[$i]['id_supplier'] = $this->input->post('supplier')[$i];
		}

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			if(!empty($this->m_detail_terima->find($data_detail_terima[$i]))) {
				$this->m_detail_terima->update($data_detail_terima[$i]);
			}
		}
		
		$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');

		redirect('purch/list_order');
	}

	public function reject($id_order) {
		$this->m_detail_terima->reject($id_order, 'id_supplier');
		redirect('purch/list_order');
	}

	public function detail_order($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$data['supplier'] = $this->m_supplier->data_supplier()->result();
		$this->load->view('purch/detail_order', $data);
	}

}