<?php

class Msparein extends CI_Model{
    protected $_table = 'sparepart_in';

    public function data_sparein(){
        // return $this->db->get('sparepart_in');
		$this->db->from($this->_table.' as i');
		$this->db->join('sparepart as s','i.part_number=s.part_number');
		$query=$this->db->get();
		return $query->result();
    }

    public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

    public function add_sparein($data){
		return $this->db->insert($this->_table, $data);
	}

    public function getMax($table, $field, $kode = null){
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function edit_sparein($where, $table){
		return $this->db->get_where($table,$where);
	}

    public function update_sparein($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    public function hapus($table, $fieldid, $fieldvalue){
		$this->db->where($fieldid, $fieldvalue)->delete($table);
	}

}