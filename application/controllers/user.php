<?php

class User extends CI_Controller{
	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('role_id') !='1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {        
		$data['user'] = $this->Muser->data_user()->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('user', $data);
		$this->load->view('templates/table');
    }
	
    public function add_user()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('add_user');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
		$nrp 			= $this->input->post('nrp');
		$nama_karyawan	= $this->input->post('nama_karyawan');
		$email	 		= $this->input->post('email');
		$telepon 		= $this->input->post('telepon');
		$alamat 		= $this->input->post('alamat');
		$username 		= $this->input->post('username');
		$password 		= md5($this->input->post('password'));
		$role_id 		= $this->input->post('role_id');
		$foto			= $this->input->post('foto');
		if ($foto = ''){}else{
			$config['upload_path']= './foto';
			$config['allowed_types']= 'jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('foto')){
				echo "Foto Gagal Diupload!";
			}else {
				$foto=$this->upload->data('file_name');
			}
		}

		$data = array (
			'nrp'			=> $nrp,
			'nama_karyawan'	=> $nama_karyawan,
			'email'			=> $email,
			'telepon'		=> $telepon,
			'alamat'		=> $alamat,
			'username'		=> $username,
			'password'		=> $password,
			'role_id'		=> $role_id,
			'foto'			=> $foto
		);

		$this->Muser->add_user($data);
		$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data User <strong>Berhasil</strong> Ditambah!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('user');
	}
	
	public function edit_user($nrp)
	{
		$where = array('nrp' => $nrp);
		$this->data['user'] = $this->Muser->edit_user($where, 'user')->result();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('edit_user', $this->data);
		$this->load->view('templates/table');
	}

	public function update_user()
	{
		$nrp 					= $this->input->post('nrp');
		$config['upload_path']	= './foto';
		$config['allowed_types']= 'jpg|jpeg|png|gif';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('foto'))
		{
			$nama_karyawan	= $this->input->post('nama_karyawan');
			$email 			= $this->input->post('email');
			$telepon 		= $this->input->post('telepon');
			$alamat 		= $this->input->post('alamat');
			$username 		= $this->input->post('username');
			$password 		= md5($this->input->post('password'));
			$role_id 		= $this->input->post('role_id');

			$data = array(
				'nrp'				=> $nrp,
				'nama_karyawan'		=> $nama_karyawan,
				'email'				=> $email,	
				'telepon'			=> $telepon,	
				'alamat'			=> $alamat,
				'username'	 		=> $username,	
				'password'			=> $password,
				'role_id'			=> $role_id,
			);
	
			$where = array(
				'nrp' => $nrp
			);
	
			$this->Muser->update_user($where,$data,'user');
			$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data User <strong>Berhasil</strong> Diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user');
		} else {
			$foto			= $this->upload->data('file_name');
			$nama_karyawan	= $this->input->post('nama_karyawan');
			$email 			= $this->input->post('email');
			$telepon 		= $this->input->post('telepon');
			$alamat 		= $this->input->post('alamat');
			$username 		= $this->input->post('username');
			$password 		= $this->input->post('password');
			$role_id 		= $this->input->post('role_id');

			$data = array(
				'nrp'				=> $nrp,
				'nama_karyawan'		=> $nama_karyawan,
				'email'				=> $email,	
				'telepon'			=> $telepon,	
				'alamat'			=> $alamat,
				'username'	 		=> $username,	
				'password'			=> $password,
				'role_id'			=> $role_id,
				'foto'				=> $foto
			);

			$where = array(
				'nrp' => $nrp
			);

			$this->Muser->update_user($where,$data,'user');
			$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data User <strong>Berhasil</strong> Diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user');
		}
	}

	public function hapus_user($nrp)
	{
		$where = array('nrp' => $nrp);
		$this->Muser->hapus_user($where,'user');
		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data User <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('user');	
	}

}