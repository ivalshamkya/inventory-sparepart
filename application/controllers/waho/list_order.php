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
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_supplier !=' => 0, 'id_supplier !=' => NULL, 'apprWAHO' => 1 ])->result();
			elseif($status == 'rejected'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_supplier !=' => 0, 'id_supplier !=' => NULL, 'apprWAHO' => '0'])->result();
			elseif($status == 'waiting'):
				$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_supplier !=' => 0, 'id_supplier !=' => NULL, 'apprWAHO' => NULL])->result();
			endif;

		}
		else{
			$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_supplier !=' => '0'])->result();
		}    
		$data['list_order'] = $this->Mlistorder->get_listorder()->result();
		$this->load->view('templates/head');
		$this->load->view('waho/sidebar');
		$this->load->view('waho/list_order', $data);
		$this->load->view('templates/table');
    }

	public function approve($id_order) {
		$this->m_detail_terima->approve($id_order, 'apprWAHO');
		redirect('waho/list_order');
	}

	public function reject($id_order) {
		$this->m_detail_terima->reject($id_order, 'apprWAHO');
		redirect('waho/list_order');
	}

	public function detail_order($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$data['supplier'] = $this->m_supplier->data_supplier()->result();
		$this->load->view('waho/detail_order', $data);
	}

}