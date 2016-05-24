<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_restfull extends CI_Model {

	//MAHASISWA
	public function get_all_mahasiswa(){
		$query = $this->db->get('mahasiswa');
		$query = $query->result_array();
		return $query;
	}

	public function get_mahasiswa($where=array()){
		$query = $this->db->get_where('mahasiswa',$where);
		$query = $query->result_array();

		if($query){
			return $query[0];
		}
	}

	public function add_mahasiswa($inp=array()){
		$query = $this->db->insert('mahasiswa',$inp);
		return $query;
	}

	public function edit_mahasiswa($inp=array(),$id=array()){
		$query = $this->db->update('mahasiswa',$inp,$id);
		return $query;
	}

	public function delete_mahasiswa($inp=array()){
		$query = $this->db->delete('mahasiswa',$inp);
		return $query;
	}

	//DOSEN
	public function get_all_dosen(){
		$query = $this->db->get('dosen');
		$query = $query->result_array();
		return $query;
	}


	//KELAS
	public function get_all_kelas(){
		$query = $this->db->get('kelas');
		$query = $query->result_array();
		return $query;
	}


	public function get_id_kelas($select, $where){
		$query = $this->db->get('kelas');
		$query = $query->result_array();
		return $query;
	}


}