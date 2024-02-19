<?php

class Mlapkeluar extends CI_Model{
    protected $_table = 'sparepart';
    
    function data_barang()
	{
		$this->db->select('*');
		$this->db->from('sparepart');
		$this->db->where('stok_akhir <= std_level_stok');
		$query = $this->db->get(); 
		return $query->result();
	}
}