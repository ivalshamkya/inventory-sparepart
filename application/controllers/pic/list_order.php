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
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => '1', 'LENGTH(wbs) >' => 1, 'wbs !=' => NULL])->result();
			elseif($status == 'rejected'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => '1', 'wbs' => 0])->result();
			elseif($status == 'waiting'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => '1', 'wbs' => NULL])->result();
			endif;

		}
		else{
			$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => 1])->result();
		}
		$data['list_order'] = $this->Mlistorder->get_listorder()->result();
		$this->load->view('templates/head');
		$this->load->view('pic/sidebar');
		$this->load->view('pic/list_order', $data);
		$this->load->view('templates/table');
    }

	public function approve() {
		$data_detail_terima = [];
	
		// Iterate through the submitted data
		foreach ($this->input->post('part_number') as $index => $part_number) {
			// Assuming part_number, id_order, and wbs are present in each index
			$data_detail_terima[$index]['id_order'] = $this->input->post('id_order');
			$data_detail_terima[$index]['part_number'] = $part_number;
			$data_detail_terima[$index]['wbs'] = $this->input->post('wbs')[$index];
	
			// Check if the data exists in the database
			$existingData = $this->m_detail_terima->find($data_detail_terima[$index]);
	
			if (!empty($existingData)) {
				// If data exists, update it
				$this->m_detail_terima->update($data_detail_terima[$index]);
			}
		}
	
		$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
		// redirect('pic/list_order');
	}
	

	public function reject($id_order) {
		$this->m_detail_terima->reject($id_order, 'wbs');
		redirect('pic/list_order');
	}

	public function detail_order($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->load->view('pic/detail_order', $data);
	}

}