<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('Dosen_model');
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
        $dosen = $this->Dosen_model->get_all();

        $data = array(
            'dosen_data' => $dosen
        );

        $this->template->load('template','dosen_list', $data);
    }
    }

    public function read($id) 
    {
        $row = $this->Dosen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'dosen_id' => $row->dosen_id,
		'dosen_nik' => $row->dosen_nik,
		'dosen_nama' => $row->dosen_nama,
		'dosen_matkul' => $row->dosen_matkul,
	    );
            $this->template->load('template','dosen_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dosen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dosen/create_action'),
	    'dosen_id' => set_value('dosen_id'),
	    'dosen_nik' => set_value('dosen_nik'),
	    'dosen_nama' => set_value('dosen_nama'),
	    'dosen_matkul' => set_value('dosen_matkul'),
	);
        $this->template->load('template','dosen_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'dosen_nik' => $this->input->post('dosen_nik',TRUE),
		'dosen_nama' => $this->input->post('dosen_nama',TRUE),
		'dosen_matkul' => $this->input->post('dosen_matkul',TRUE),
	    );

            $this->Dosen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dosen'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Dosen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dosen/update_action'),
		'dosen_id' => set_value('dosen_id', $row->dosen_id),
		'dosen_nik' => set_value('dosen_nik', $row->dosen_nik),
		'dosen_nama' => set_value('dosen_nama', $row->dosen_nama),
		'dosen_matkul' => set_value('dosen_matkul', $row->dosen_matkul),
	    );
            $this->template->load('template','dosen_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dosen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('dosen_id', TRUE));
        } else {
            $data = array(
		'dosen_nik' => $this->input->post('dosen_nik',TRUE),
		'dosen_nama' => $this->input->post('dosen_nama',TRUE),
		'dosen_matkul' => $this->input->post('dosen_matkul',TRUE),
	    );

            $this->Dosen_model->update($this->input->post('dosen_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dosen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Dosen_model->get_by_id($id);

        if ($row) {
            $this->Dosen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dosen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dosen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('dosen_nik', 'dosen nik', 'trim|required');
	$this->form_validation->set_rules('dosen_nama', 'dosen nama', 'trim|required');
	$this->form_validation->set_rules('dosen_matkul', 'dosen matkul', 'trim|required');

	$this->form_validation->set_rules('dosen_id', 'dosen_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "dosen.xls";
        $judul = "dosen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Dosen Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Dosen Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Dosen Matkul");

	foreach ($this->Dosen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dosen_nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dosen_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dosen_matkul);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=dosen.doc");

        $data = array(
            'dosen_data' => $this->Dosen_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dosen_doc',$data);
    }

}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-24 15:33:43 */
/* http://harviacode.com */