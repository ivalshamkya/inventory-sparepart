<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['Muser']);
	}

	public function index()
	{
		$this->_rules();

		if($this->form_validation->run()==FALSE) {
			$this->load->view('templates/head');
			$this->load->view('login');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$cek = $this->Muser->cek_login($username, $password);
			
			if($cek == FALSE) 
			{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Username Atau Password Salah!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('welcome');
			}else{
				$this->session->set_userdata('role_id',$cek->role_id);
				$this->session->set_userdata('nama_karyawan',$cek->nama_karyawan);
				$this->session->set_userdata('foto',$cek->foto);
				$this->session->set_userdata('nrp',$cek->nrp);
				switch ($cek->role_id) {
					case 1 : redirect('dashboard');
							break;
					case 2 : redirect('dashboard');
							break;
					case 3 : redirect('pic/dashboard');
							break;
					case 4 : redirect('purch/dashboard');
							break;
					case 5 : redirect('waho/dashboard');
							break;
					default: break; 
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username','required');
		$this->form_validation->set_rules('password', 'password','required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
