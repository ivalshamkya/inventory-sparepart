<?php

use Dompdf\Dompdf;

class Sparepart extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Msparepart', 'Mmesin', 'Mlokasi']);

		
        if($this->session->userdata('role_id') !='1' && $this->session->userdata['role_id'] != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
	}

    public function index()
    {        
		$this->data['sparepart'] = $this->Msparepart->data_sparepart();
		$this->load->view('templates/head');
		$this->load->view('templates/sidebar');
		$this->load->view('sparepart', $this->data);
		$this->load->view('templates/table');
    }

	public function menampilkan_stok(){
		$part_number = $_POST['part_number'];
		$s = "SELECT stok_akhir as stok_akhir_b FROM sparepart WHERE part_number='$part_number'";
		$res = $this->db->query($s)->row_array();
		echo json_encode($res);
	}
	
    public function add_sparepart(){
		//select option
		$this->data['datamesin'] = $this->Mmesin->lihat_mesin();
		$this->data['datalokasi'] = $this->Mlokasi->lihat_lokasi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('add_sparepart', $this->data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'petugas'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('dashboard');
		// }

			$part_number 	= $this->input->post('part_number');
			$deskripsi 		= $this->input->post('deskripsi');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$id_mesin 		= $this->input->post('id_mesin');
			$id_lokasi 		= $this->input->post('id_lokasi');
			$stok_akhir 	= $this->input->post('stok_akhir');
			$std_level_stok	= $this->input->post('std_level_stok');
			$gambar 		= $this->input->post('gambar');
			if ($gambar = ''){}else{
				$config['upload_path']= './gambar';
				$config['allowed_types']= 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('gambar')){
					echo "Gambar Gagal Diupload!";
				}else {
					$gambar=$this->upload->data('file_name');
				}
			}

			$data = array (
				'part_number'		=> $part_number,
				'deskripsi'			=> $deskripsi,
				'satuan'			=> $satuan,
				'harga_satuan'		=> $harga_satuan,
				'id_mesin'			=> $id_mesin,
				'id_lokasi'			=> $id_lokasi,
				'stok_akhir'		=> $stok_akhir,
				'std_level_stok'	=> $std_level_stok,
				'gambar'			=> $gambar
			);

			$this->Msparepart->add_sparepart($data);
			$this->session->set_flashdata('tambah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part <strong>Berhasil</strong> Ditambah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('sparepart');
	}

	public function edit_sparepart($part_number)
	{
		$where = array('part_number' => $part_number);
		$this->data['datamesin'] = $this->Mmesin->lihat_mesin();
		$this->data['datalokasi'] = $this->Mlokasi->lihat_lokasi();
		$this->data['sparepart'] = $this->Msparepart->edit_sparepart($where, 'sparepart')->result();
		// $this->data['sparepart'] = $this->Msparepart->edit_sparepart($part_number);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('edit_sparepart', $this->data);
		$this->load->view('templates/footer');
	}

	public function update_sparepart()
	{
		$part_number 			= $this->input->post('part_number');
		$config['upload_path']	= './gambar';
		$config['allowed_types']= 'jpg|jpeg|png|gif';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('gambar'))
		{
			$deskripsi		= $this->input->post('deskripsi');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$id_mesin 		= $this->input->post('id_mesin');
			$id_lokasi 		= $this->input->post('id_lokasi');
			$stok_akhir 	= $this->input->post('stok_akhir');
			$std_level_stok	= $this->input->post('std_level_stok');

			$data = array(
				'part_number'		=> $part_number,
				'deskripsi'			=> $deskripsi,
				'satuan'			=> $satuan,
				'harga_satuan'		=> $harga_satuan,
				'id_mesin'			=> $id_mesin,
				'id_lokasi' 		=> $id_lokasi,
				'stok_akhir'		=> $stok_akhir,
				'std_level_stok'	=> $std_level_stok,
			);
	
			$where = array(
				'part_number' => $part_number
			);
	
			$this->Msparepart->update_sparepart($where,$data,'sparepart');
			$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part <strong>Berhasil</strong> Diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('sparepart');
		} else {
			$gambar			= $this->upload->data('file_name');
			$deskripsi		= $this->input->post('deskripsi');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$id_mesin 		= $this->input->post('id_mesin');
			$id_lokasi 		= $this->input->post('id_lokasi');
			$stok_akhir 	= $this->input->post('stok_akhir');
			$std_level_stok	= $this->input->post('std_level_stok');

			$data = array(
				'part_number'		=> $part_number,
				'deskripsi'			=> $deskripsi,
				'satuan'			=> $satuan,
				'harga_satuan'		=> $harga_satuan,
				'id_mesin'			=> $id_mesin,
				'id_lokasi' 		=> $id_lokasi,
				'stok_akhir'		=> $stok_akhir,
				'std_level_stok'	=> $std_level_stok,
				'gambar'			=> $gambar
			);

			$where = array(
				'part_number' => $part_number
			);
	
			$this->Msparepart->update_sparepart($where,$data,'sparepart');
			$this->session->set_flashdata('ubah', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part <strong>Berhasil</strong> Diubah!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('sparepart');
		}
	}

	public function hapus_sparepart($part_number)
	{
		$where = array('part_number' => $part_number);
		$this->Msparepart->hapus_sparepart($where,'sparepart');
		$this->session->set_flashdata('hapus', '<div class="alert alert-success alert-dismissible" role="alert">Data Spare Part <strong>Berhasil</strong> Dihapus!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('sparepart');	
	}

}