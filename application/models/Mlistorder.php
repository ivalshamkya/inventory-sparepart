<?php

class Mlistorder extends CI_Model{
    public function get_listorder($where = ""){
        if($where) {
            return $this->db->join('user', 'user.nrp = list_order.creaby')->get_where('list_order', $where);
        }
        else {
            return $this->db->get('list_order');
        }
    }
    
    public function detail_listorder($where = ""){
        if($where) {
            return $this->db->get_where('detail_order', $where);
        }
        else {
            return $this->db->get('detail_order');
        }
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