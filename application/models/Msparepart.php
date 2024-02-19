<?php

class MSparepart extends CI_Model{
    protected $_table = 'sparepart';

    public function data_sparepart(){
        // return $this->db->get('sparepart');
        $this->db->from($this->_table.' as sp');
		$this->db->join('lokasi as lok','sp.id_lokasi=lok.id_lokasi');
		$query=$this->db->get();
		return $query->result();
    }

	public function lihat_sparepart(){
		$query = $this->db->select('part_number, deskripsi, stok_akhir, satuan');
		$query = $this->db->get('sparepart');
		return $query->result();
	}

	public function lihat_stok_akhir($part_number){
		$query = $this->db->select('*');
		$query = $this->db->where(['part_number' => $part_number]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
	
    public function add_sparepart($data){
		return $this->db->insert($this->_table, $data);
	}

    public function edit_sparepart($where, $table){
		return $this->db->get_where($table,$where);
	}
	
    public function update_sparepart($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
    public function hapus_sparepart($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	//dashboard
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	
	function data_barang()
	{
		$this->db->select('*');
		$this->db->from('sparepart');
		$this->db->where('stok_akhir <= std_level_stok');
		$query = $this->db->get(); 
		return $query->result();
	}

	public function getDataWhere($tabel, $id, $nilai)
	{
		$this->db->where($id, $nilai);
		$query = $this->db->get($tabel);

		return $query;
	}

	public function update_part_in($tabel, $fieldid, $fieldvalue, $data = [])
    {
        $this->db->where($fieldid, $fieldvalue)->update($tabel, $data);
    }

	public function update_part_out($tabel, $fieldid, $fieldvalue, $data = [])
    {
        $this->db->where($fieldid, $fieldvalue)->update($tabel, $data);
    }

	public function lihat_deskripsi($deskripsi){
		$query = $this->db->select('*');
		$query = $this->db->where(['deskripsi' => $deskripsi]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
}