<?php

class Profil extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(['Muser']);
	}

	public function index()
    {        
		$id = $this->session->userdata('nrp');
		$data['profil'] = $this->db->query("SELECT * FROM user WHERE nrp='$id'")->result();
		
		$this->load->view('templates/head');
		$this->load->view('pic/sidebar');
		$this->load->view('pic/profil',$data);
		$this->load->view('templates/table');
    }

	public function edit_profil()
	{
		$id = $this->session->userdata('nrp');
		$data['ubah'] = $this->db->query("SELECT * FROM user WHERE nrp='$id'")->result();

		$this->load->view('templates/head');
		$this->load->view('pic/sidebar');
		$this->load->view('pic/edit_profil',$data);
		$this->load->view('templates/table');
	}

	public function proses_ubah()
	{
		$nama_karyawan = $this->input->post('nama_karyawan');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$alamat = $this->input->post('alamat');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('nama_karyawan', 'Nama diubah','required');		
        $this->form_validation->set_rules('email', 'Email diubah','required');		
		$this->form_validation->set_rules('telepon', 'Telepon diubah','required');		
        $this->form_validation->set_rules('alamat', 'Alamat diubah','required');		
        $this->form_validation->set_rules('username', 'Username diubah','required');	
        $this->form_validation->set_rules('password', 'Password diubah','required');

		$config['upload_path']	= './foto';
		$config['allowed_types']= 'jpg|jpeg|png|gif';
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('foto')){
			if($this->form_validation->run() != FALSE) 
			{
				$data = array(
					'nama_karyawan' => $nama_karyawan,
					'email' 		=> $email,
					'telepon' 		=> $telepon,
					'alamat' 		=> $alamat,
					'username' 		=> $username,
					'password' 		=> md5($password)
					);
				$nrp = array('nrp' => $this->session->userdata('nrp'));
				$this->Muser->update_user($nrp,$data,'user');
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Profil Berhasil Diubah!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('pic/profil');
			} else {
				$this->load->view('templates/head');
				$this->load->view('pic/sidebar');
				$this->load->view('pic/profil',$data);
				$this->load->view('templates/table');
			}
		} else {
			$foto			= $this->upload->data('file_name');
			$nama_karyawan	= $this->input->post('nama_karyawan');
			$email			= $this->input->post('email');
			$telepon		= $this->input->post('telepon');
			$alamat			= $this->input->post('alamat');
			$username 		= $this->input->post('username');
			$password 		= $this->input->post('password');

			$data = array(
				'nama_karyawan' => $nama_karyawan,
				'email' 		=> $email,
				'telepon' 		=> $telepon,
				'alamat' 		=> $alamat,
				'username' 		=> $username,
				'password' 		=> md5($password),
				'foto'			=> $foto
				);
			$nrp = array('nrp' => $this->session->userdata('nrp'));
			$this->Muser->update_user($nrp,$data,'user');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Profil Berhasil Diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('pic/profil');
		}

		
	}

}