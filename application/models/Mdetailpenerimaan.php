<?php

class Mdetailpenerimaan extends CI_Model{
    function tambah($data){
        return $this->db->insert('detail_order', $data);
    }

    function update($data){
        return $this->db->where('id_order', $data['id_order'])
        ->where('part_number', $data['part_number'])
        ->update('detail_order', $data);
    }

    
    function delete($id_order, $part_number)
	{
        $this->db->where('id_order', $id_order);
        $this->db->where('part_number', $part_number);
		$this->db->delete('detail_order');
	}

    function deleteAll($id_order)
	{
        $this->db->where('id_order', $id_order);
		$this->db->delete('detail_order');
	}
    
    function find($data)
	{
        return $this->db->where('id_order', $data['id_order'])
        ->where('part_number', $data['part_number'])
        ->get('detail_order')
        ->result();
	}
    
    function approve($id_order, $field) {
        return $this->db->set($field, '1')
        ->where('id_order', $id_order)
        ->update('detail_order');
    }

    function reject($id_order, $field) {
        return $this->db->set($field, '0')
        ->where('id_order', $id_order)
        ->update('detail_order');
    }
}