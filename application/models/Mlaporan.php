<?php

class Mlaporan extends CI_Model
{
    public function lap_masuk($bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('sparepart_in');
        $this->db->join('sparepart', 'sparepart.part_number = sparepart_in.part_number');
        $this->db->join('user', 'user.nrp = sparepart_in.nrp');
        $this->db->where('MONTH(tgl_in)', $bulan);
        $this->db->where('YEAR(tgl_in)', $tahun);
        return $this->db->get()->result();
    }

}