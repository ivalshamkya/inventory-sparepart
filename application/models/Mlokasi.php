<?php

class Mlokasi extends CI_Model{
    public function data_lokasi(){
        return $this->db->get('lokasi');
    }

	public function lihat_lokasi(){
		$query = $this->db->select('id_lokasi, nm_lokasi');
		$query = $this->db->get('lokasi');
		return $query->result();
	}

    public function tambah_lokasi($data,$table){
		$this->db->insert($table,$data);
	}

    public function edit_lokasi($where, $table){
		return $this->db->get_where($table,$where);
	}

	public function update_lokasi($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    public function hapus_lokasi($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}