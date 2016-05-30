<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    
       // $link = "http://localhost:8080/tbwebservice/server/mahasiswa/insert_mhs.php";
        
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('Mahasiswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        else // remove this elseif if you want to enable this for non-admins
        {
        $mahasiswa = $this->Mahasiswa_model->get_all_query();

        $data = array(
            'mahasiswa_data' => $mahasiswa
        );

        $this->template->load('template','mahasiswa_list', $data);
    }
    }

    public function read($id) 
    {
        $row = $this->Mahasiswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'mahasiswa_id' => $row->mahasiswa_id,
		'mahasiswa_npm' => $row->mahasiswa_npm,
		'mahasiswa_nama' => $row->mahasiswa_nama,
		'mahasiswa_alamat' => $row->mahasiswa_alamat,
		'mahasiswa_email' => $row->mahasiswa_email,
		'mahasiswa_tlp' => $row->mahasiswa_tlp,
		'mahasiswa_agama' => $row->mahasiswa_agama,
        'mahasiswa_foto' => $row->mahasiswa_foto,
		'kelas_id' => $row->kelas_id,
	    );
            $this->template->load('template','mahasiswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mahasiswa/create_action'),
	    'mahasiswa_id' => set_value('mahasiswa_id'),
	    'mahasiswa_npm' => set_value('mahasiswa_npm'),
	    'mahasiswa_nama' => set_value('mahasiswa_nama'),
	    'mahasiswa_alamat' => set_value('mahasiswa_alamat'),
	    'mahasiswa_email' => set_value('mahasiswa_email'),
	    'mahasiswa_tlp' => set_value('mahasiswa_tlp'),
	    'mahasiswa_agama' => set_value('mahasiswa_agama'),
        'mahasiswa_foto' => set_value('mahasiswa_foto'),
	    'kelas_id' => set_value('kelas_id'),
	);
        $this->template->load('template','mahasiswa_form', $data);
    }
    
    public function create_action() 
    {
        //$data['link'] = "http://localhost:8080/tbwebservice/server/mahasiswa/insert_mhs.php");
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'mahasiswa_npm' => $this->input->post('mahasiswa_npm',TRUE),
		'mahasiswa_nama' => $this->input->post('mahasiswa_nama',TRUE),
		'mahasiswa_alamat' => $this->input->post('mahasiswa_alamat',TRUE),
		'mahasiswa_email' => $this->input->post('mahasiswa_email',TRUE),
		'mahasiswa_tlp' => $this->input->post('mahasiswa_tlp',TRUE),
		'mahasiswa_agama' => $this->input->post('mahasiswa_agama',TRUE),
        'mahasiswa_foto' => upload_image('mahasiswa_foto', "./assets/images/mahasiswa/", "230x160"),
		'kelas_id' => $this->input->post('kelas_id',TRUE),
	    );

           $this->Mahasiswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mahasiswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mahasiswa/update_action'),
		'mahasiswa_id' => set_value('mahasiswa_id', $row->mahasiswa_id),
		'mahasiswa_npm' => set_value('mahasiswa_npm', $row->mahasiswa_npm),
		'mahasiswa_nama' => set_value('mahasiswa_nama', $row->mahasiswa_nama),
		'mahasiswa_alamat' => set_value('mahasiswa_alamat', $row->mahasiswa_alamat),
		'mahasiswa_email' => set_value('mahasiswa_email', $row->mahasiswa_email),
		'mahasiswa_tlp' => set_value('mahasiswa_tlp', $row->mahasiswa_tlp),
		'mahasiswa_agama' => set_value('mahasiswa_agama', $row->mahasiswa_agama),
        'mahasiswa_foto' => set_value('mahasiswa_foto', $row->mahasiswa_foto),
		'kelas_id' => set_value('kelas_id', $row->kelas_id),
	    );
            $this->template->load('template','mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('mahasiswa_id', TRUE));
        } else {
            $data = array(
		'mahasiswa_npm' => $this->input->post('mahasiswa_npm',TRUE),
		'mahasiswa_nama' => $this->input->post('mahasiswa_nama',TRUE),
		'mahasiswa_alamat' => $this->input->post('mahasiswa_alamat',TRUE),
		'mahasiswa_email' => $this->input->post('mahasiswa_email',TRUE),
		'mahasiswa_tlp' => $this->input->post('mahasiswa_tlp',TRUE),
		'mahasiswa_agama' => $this->input->post('mahasiswa_agama',TRUE),
        'mahasiswa_foto' => upload_image('mahasiswa_foto', "./assets/images/mahasiswa/", "230x160"),
		'kelas_id' => $this->input->post('kelas_id',TRUE),
	    );

            $this->Mahasiswa_model->update($this->input->post('mahasiswa_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mahasiswa_model->get_by_id($id);

        if ($row) {
            $this->Mahasiswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('mahasiswa_npm', 'mahasiswa npm', 'trim|required');
	$this->form_validation->set_rules('mahasiswa_nama', 'mahasiswa nama', 'trim|required');
	$this->form_validation->set_rules('mahasiswa_alamat', 'mahasiswa alamat', 'trim|required');
	$this->form_validation->set_rules('mahasiswa_email', 'mahasiswa email', 'trim|required');
	$this->form_validation->set_rules('mahasiswa_tlp', 'mahasiswa tlp', 'trim|required');
	$this->form_validation->set_rules('mahasiswa_agama', 'mahasiswa agama', 'trim|required');
	$this->form_validation->set_rules('kelas_id', 'kelas id', 'trim|required');

	$this->form_validation->set_rules('mahasiswa_id', 'mahasiswa_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mahasiswa.xls";
        $judul = "mahasiswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Npm");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Tlp");
	xlsWriteLabel($tablehead, $kolomhead++, "Mahasiswa Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas Id");

	foreach ($this->Mahasiswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_npm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_tlp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mahasiswa_agama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kelas_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mahasiswa.doc");

        $data = array(
            'mahasiswa_data' => $this->Mahasiswa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mahasiswa_doc',$data);
    }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-12 04:38:14 */
/* http://harviacode.com */