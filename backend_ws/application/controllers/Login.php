<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $login = $this->Login_model->get_all();

        $data = array(
            'login_data' => $login
        );

        $this->template->load('template','login_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Login_model->get_by_id($id);
        if ($row) {
            $data = array(
		'login_id' => $row->login_id,
		'login_username' => $row->login_username,
		'login_password' => $row->login_password,
		'login_nama' => $row->login_nama,
		'login_tlp' => $row->login_tlp,
	    );
            $this->template->load('template','login_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('login/create_action'),
	    'login_id' => set_value('login_id'),
	    'login_username' => set_value('login_username'),
	    'login_password' => set_value('login_password'),
	    'login_nama' => set_value('login_nama'),
	    'login_tlp' => set_value('login_tlp'),
	);
        $this->template->load('template','login_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'login_username' => $this->input->post('login_username',TRUE),
		'login_password' => $this->input->post('login_password',TRUE),
		'login_nama' => $this->input->post('login_nama',TRUE),
		'login_tlp' => $this->input->post('login_tlp',TRUE),
	    );

            $this->Login_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('login'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Login_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('login/update_action'),
		'login_id' => set_value('login_id', $row->login_id),
		'login_username' => set_value('login_username', $row->login_username),
		'login_password' => set_value('login_password', $row->login_password),
		'login_nama' => set_value('login_nama', $row->login_nama),
		'login_tlp' => set_value('login_tlp', $row->login_tlp),
	    );
            $this->template->load('template','login_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('login_id', TRUE));
        } else {
            $data = array(
		'login_username' => $this->input->post('login_username',TRUE),
		'login_password' => $this->input->post('login_password',TRUE),
		'login_nama' => $this->input->post('login_nama',TRUE),
		'login_tlp' => $this->input->post('login_tlp',TRUE),
	    );

            $this->Login_model->update($this->input->post('login_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('login'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Login_model->get_by_id($id);

        if ($row) {
            $this->Login_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('login_username', 'login username', 'trim|required');
	$this->form_validation->set_rules('login_password', 'login password', 'trim|required');
	$this->form_validation->set_rules('login_nama', 'login nama', 'trim|required');
	$this->form_validation->set_rules('login_tlp', 'login tlp', 'trim|required');

	$this->form_validation->set_rules('login_id', 'login_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "login.xls";
        $judul = "login";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Login Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Login Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Login Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Login Tlp");

	foreach ($this->Login_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->login_username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->login_password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->login_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->login_tlp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=login.doc");

        $data = array(
            'login_data' => $this->Login_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('login_doc',$data);
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:46:30 */
/* http://harviacode.com */