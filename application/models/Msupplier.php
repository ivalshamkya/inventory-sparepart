<?php

class Msupplier extends CI_Model{
    protected $_table = 'supplier';

    public function data_supplier(){
        return $this->db->get('supplier');
    }

    public function tambah_supplier($data){
		return $this->db->insert($this->_table, $data);
	}

    public function edit_supplier($where, $table){
		return $this->db->get_where($table,$where);
	}

	public function update_supplier($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    public function hapus_supplier($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}