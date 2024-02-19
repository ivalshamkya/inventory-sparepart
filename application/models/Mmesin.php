<?php

class Mmesin extends CI_Model{
    public function data_mesin(){
        return $this->db->get('mesin');
    }

    public function lihat_mesin(){
		$query = $this->db->select('id_mesin, nm_mesin');
		$query = $this->db->get('mesin');
		return $query->result();
	}
	
	public function tambah_mesin($data,$table){
		$this->db->insert($table,$data);
	}

    public function edit_mesin($where, $table){
		return $this->db->get_where($table,$where);
	}

	public function update_mesin($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    public function hapus_mesin($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
    
}