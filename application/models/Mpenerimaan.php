<?php

class Mpenerimaan extends CI_Model{
    function tambah($data){
       return $this->db->insert('list_order', $data);
    }


    // //select option
    // public function getmesin(){
    //     $query = $this->db->query("SELECT * FROM mesin ORDER BY nm_mesin ASC");
    //     return $query->result();
    // }

    // //select option
    // public function getlokasi(){
    //     $query = $this->db->query("SELECT * FROM lokasi ORDER BY nm_lokasi ASC");
    //     return $query->result();
    // }

    // public function add_sparepart($data,$table){
	// 	$this->db->insert($table,$data);
	// }

    // public function edit_sparepart($where, $table){
	// 	return $this->db->get_where($table,$where);
	// }

    // public function hapus_sparepart($where,$table)
	// {
	// 	$this->db->where($where);
	// 	$this->db->delete($table);
	// }

}