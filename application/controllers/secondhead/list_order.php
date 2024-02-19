<?php

class List_order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Msparepart', 'Mmesin', 'Mlokasi']);
		$this->load->model('Mpenerimaan', 'm_penerimaan');
		$this->load->model('Mdetailpenerimaan', 'm_detail_terima');
	}

	public function index()
	{
		if ($this->input->get('status')) {
			$status = $this->input->get('status');

			if ($status == 'approved') :
				$status = '1';
			elseif ($status == 'rejected') :
				$status = '0';
			elseif ($status == 'waiting') :
				$status = NULL;
			endif;

			$data['detail_order'] = $this->Mlistorder->detail_listorder(['apprSH' => $status])->result();
		} else {
			$data['detail_order'] = $this->Mlistorder->detail_listorder()->result();
		}
		$data['list_order'] = $this->Mlistorder->get_listorder()->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('secondhead/list_order', $data);
		$this->load->view('templates/table');
	}

	public function approve($id_order)
	{
		return $this->m_detail_terima->approve($id_order, 'apprSH');
		
	}

	public function reject($id_order)
	{
		return $this->m_detail_terima->reject($id_order, 'apprSH');
	}

	public function detail_order($id_order)
	{
		$data['list_order'] = $this->Mlistorder->get_listorder(['id_order' => $id_order])->result();
		$data['detail_order'] = $this->Mlistorder->detail_listorder(['id_order' => $id_order])->result();
		$data['datasparepart'] = $this->Msparepart->lihat_sparepart();
		$this->load->view('secondhead/detail_order', $data);
	}
}
