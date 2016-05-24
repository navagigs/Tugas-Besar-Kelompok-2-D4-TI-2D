<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('Kelas_model');
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
        $kelas = $this->Kelas_model->get_all();

        $data = array(
            'kelas_data' => $kelas
        );

        $this->template->load('template','kelas_list', $data);
    }
    }

    public function read($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kelas_id' => $row->kelas_id,
		'kelas_nama' => $row->kelas_nama,
		'kelas_icon' => $row->kelas_icon,
		'kelas_warna' => $row->kelas_warna,
	    );
            $this->template->load('template','kelas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
	    'kelas_id' => set_value('kelas_id'),
	    'kelas_nama' => set_value('kelas_nama'),
	    'kelas_icon' => set_value('kelas_icon'),
	    'kelas_warna' => set_value('kelas_warna'),
	);
        $this->template->load('template','kelas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kelas_nama' => $this->input->post('kelas_nama',TRUE),
		'kelas_icon' => $this->input->post('kelas_icon',TRUE),
		'kelas_warna' => $this->input->post('kelas_warna',TRUE),
	    );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
		'kelas_id' => set_value('kelas_id', $row->kelas_id),
		'kelas_nama' => set_value('kelas_nama', $row->kelas_nama),
		'kelas_icon' => set_value('kelas_icon', $row->kelas_icon),
		'kelas_warna' => set_value('kelas_warna', $row->kelas_warna),
	    );
            $this->template->load('template','kelas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kelas_id', TRUE));
        } else {
            $data = array(
		'kelas_nama' => $this->input->post('kelas_nama',TRUE),
		'kelas_icon' => $this->input->post('kelas_icon',TRUE),
		'kelas_warna' => $this->input->post('kelas_warna',TRUE),
	    );

            $this->Kelas_model->update($this->input->post('kelas_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kelas_nama', 'kelas nama', 'trim|required');
	$this->form_validation->set_rules('kelas_icon', 'kelas icon', 'trim|required');
	$this->form_validation->set_rules('kelas_warna', 'kelas warna', 'trim|required');

	$this->form_validation->set_rules('kelas_id', 'kelas_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelas.xls";
        $judul = "kelas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas Icon");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas Warna");

	foreach ($this->Kelas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas_icon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas_warna);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kelas.doc");

        $data = array(
            'kelas_data' => $this->Kelas_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kelas_doc',$data);
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-24 15:28:58 */
/* http://harviacode.com */