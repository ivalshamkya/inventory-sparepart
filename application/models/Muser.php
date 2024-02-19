<?php

class Muser extends CI_Model{
    protected $_table = 'user';

    public function data_user(){
        return $this->db->get('user');
    }

    public function add_user($data){
		return $this->db->insert($this->_table, $data);
	}

    public function edit_user($where, $table){
		return $this->db->get_where($table,$where);
	}

    public function update_user($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    public function hapus_user($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function cek_login()
	{
		$username	= set_value('username');
		$password	= set_value('password');

		$result		= $this->db->where('username',$username)
								->where('password',md5($password))
								->limit(1)
								->get('user');
		if($result->num_rows()>0){
			return $result->row();
		}else{
			return FALSE;
		}
	}

}