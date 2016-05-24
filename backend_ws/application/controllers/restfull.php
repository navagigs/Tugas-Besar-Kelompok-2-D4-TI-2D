<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restfull extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load model m_restfull.php
		$this->load->model('m_restfull');

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
	}

	public function index(){
		$coeg = array(
			'name'		=> 'Nava Gia Ginasta',
			'website'	=> 'http://nava.web.id'
		);
		echo json_encode($coeg);
	}

	//MAHASISWA
	public function get_all_mhs(){
		// Query from m_restfull.php
		$mhs = $this->m_restfull->get_all_mahasiswa();
		if(!empty($mhs)){
			foreach ($mhs as $row) {
				// data array from database
				$json[] = array(
					'mahasiswa_id' 			=> $row['mahasiswa_id'],
					'mahasiswa_npm' 		=> $row['mahasiswa_npm'],
					'mahasiswa_nama'		=> $row['mahasiswa_nama'],
					'mahasiswa_alamat'		=> $row['mahasiswa_alamat'],
					'mahasiswa_email' 		=> $row['mahasiswa_email'],
					'mahasiswa_tlp'			=> $row['mahasiswa_tlp'],
					'mahasiswa_agama'		=> $row['mahasiswa_agama'],
					'kelas_id'		=> $row['kelas_id']
				);
			}
		}else{
			$json = array();
		}
		
		// Print with json_encode()
		echo json_encode($json);
	}

	public function get_mhs(){
		$mahasiswa_id = $this->input->get('mahasiswa_id');

		// Jika variabel $id tidak kosong
		if(!empty($mahasiswa_id)){
			// field condition
			$row = array(
				'mahasiswa_id' => $mahasiswa_id
			);
			// query get one data from model m_restfull.php
			$mhs = $this->m_restfull->get_mahasiswa($row);
			$json = array(
					'mahasiswa_id' 			=> $mhs['mahasiswa_id'],
					'mahasiswa_npm' 		=> $mhs['mahasiswa_npm'],
					'mahasiswa_nama'		=> $mhs['mahasiswa_nama'],
					'mahasiswa_alamat'		=> $mhs['mahasiswa_alamat'],
					'mahasiswa_email' 		=> $mhs['mahasiswa_email'],
					'mahasiswa_tlp'			=> $mhs['mahasiswa_tlp'],
					'mahasiswa_agama'		=> $mhs['mahasiswa_agama'],
					'kelas_id'				=> $mhs['kelas_id']
			);
		}else{
			$json = array();
		}

		// Print with json_encode()
		echo json_encode($json);

	}

	public function add_mhs(){
		$postdata = file_get_contents("php://input");

		$ObjekData = json_decode($postdata);

		@$mahasiswa_npm 	= $ObjekData->data->mahasiswa_npm;
		@$mahasiswa_nama 	= $ObjekData->data->mahasiswa_nama;
		@$mahasiswa_alamat 	= $ObjekData->data->mahasiswa_alamat;
		@$mahasiswa_email 	= $ObjekData->data->mahasiswa_email;
		@$mahasiswa_tlp 	= $ObjekData->data->mahasiswa_tlp;
		@$mahasiswa_agama 	= $ObjekData->data->mahasiswa_agama;
		@$kelas_id 			= $ObjekData->data->kelas_id;

		if(!empty($nama)){
			$input = array(
				// field => isi
				'mahasiswa_npm'		=> $mahasiswa_npm,
				'mahasiswa_nama'	=> $mahasiswa_nama,
				'mahasiswa_alamat'	=> $mahasiswa_alamat,
				'mahasiswa_email'	=> $mahasiswa_email,
				'mahasiswa_tlp'		=> $mahasiswa_tlp,
				'mahasiswa_agama'	=> $mahasiswa_agama,
				'kelas_id'	=> $kelas_id
			);

			$simpan = $this->m_restfull->add_mahasiswa($input);
			if($simpan){
				$json['status'] = 1;
			}else{
				$json['status'] = 0;
			}

			echo json_encode($json);
		}	

	}

	public function edit_mhs(){
		$postdata = file_get_contents("php://input");

		$ObjekData = json_decode($postdata);

		@$mahasiswa_id 		= $ObjekData->data->mahasiswa_id;
		@$mahasiswa_npm 	= $ObjekData->data->mahasiswa_npm;
		@$mahasiswa_nama 	= $ObjekData->data->mahasiswa_nama;
		@$mahasiswa_alamat 	= $ObjekData->data->mahasiswa_alamat;
		@$mahasiswa_email 	= $ObjekData->data->mahasiswa_email;
		@$mahasiswa_tlp 	= $ObjekData->data->mahasiswa_tlp;
		@$mahasiswa_agama 	= $ObjekData->data->mahasiswa_agama;
		@$kelas_id 			= $ObjekData->data->kelas_id;

		if(!empty($nama)){
			$input = array(
				// field => isi
				'mahasiswa_npm'		=> $mahasiswa_npm,
				'mahasiswa_nama'	=> $mahasiswa_nama,
				'mahasiswa_alamat'	=> $mahasiswa_alamat,
				'mahasiswa_email'	=> $mahasiswa_email,
				'mahasiswa_tlp'		=> $mahasiswa_tlp,
				'mahasiswa_agama'	=> $mahasiswa_agama,
				'kelas_id'	=> $kelas_id
			);

			// Primary key table buku_tamu
			$idna['mahasiswa_id'] = $id;

			// Query ubah di model m_restfull.php
			$simpan = $this->m_restfull->edit_mahasiswa($input,$idna);
			if($simpan){
				$json['status'] = 1;
			}else{
				$json['status'] = 0;
			}

			echo json_encode($json);
		}	

	}

	public function hapus_mhs(){

		@$id = $this->input->get('id');

		if(!empty($id)){
			$idna['mahasiswa_id'] = $id;

			// Query hapus di model m_restfull.php
			$hapus = $this->m_restfull->delete_mahasiswa($idna);
			if($hapus){
				$json['status'] = 1;
			}else{
				$json['status']	= 0;
			}
		}

		echo json_encode($json);
	}


	//DOSEN
	public function get_all_dosen(){
		// Query from m_restfull.php
		$dosen = $this->m_restfull->get_all_dosen();
		if(!empty($dosen)){
			foreach ($dosen as $row) {
				// data array from database
				$json[] = array(
					'dosen_nik' 			=> $row['dosen_nik'],
					'dosen_nama' 			=> $row['dosen_nama'],
					'dosen_matkul'			=> $row['dosen_matkul']
				);
			}
		}else{
			$json = array();
		}
		
		// Print with json_encode()
		echo json_encode($json);
	}


	//KELAS
	public function get_id_mhs(){
	
	}

	public function get_all_kelas(){
		// Query from m_restfull.php
		$kelas= $this->m_restfull->get_all_kelas();
		if(!empty($kelas)){
			foreach ($kelas as $row) {
				// data array from database
				$json[] = array(
					'kelas_id' 				=> $row['kelas_id'],
					'kelas_nama' 			=> $row['kelas_nama'],
					'kelas_icon'			=> $row['kelas_icon'],
					'kelas_warna'			=> $row['kelas_warna']
				);
			}
		}else{
			$json = array();
		}
		
		// Print with json_encode()
		echo json_encode($json);
	}
	
}