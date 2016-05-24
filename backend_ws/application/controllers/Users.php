<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','users_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'username' => $row->username,
		'password' => $row->password,
		'salt' => $row->salt,
		'email' => $row->email,
		'activation_code' => $row->activation_code,
		'forgotten_password_code' => $row->forgotten_password_code,
		'forgotten_password_time' => $row->forgotten_password_time,
		'remember_code' => $row->remember_code,
		'created_on' => $row->created_on,
		'last_login' => $row->last_login,
		'active' => $row->active,
		'first_name' => $row->first_name,
		'last_name' => $row->last_name,
		'company' => $row->company,
		'phone' => $row->phone,
	    );
            $this->template->load('template','users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'salt' => set_value('salt'),
	    'email' => set_value('email'),
	    'activation_code' => set_value('activation_code'),
	    'forgotten_password_code' => set_value('forgotten_password_code'),
	    'forgotten_password_time' => set_value('forgotten_password_time'),
	    'remember_code' => set_value('remember_code'),
	    'created_on' => set_value('created_on'),
	    'last_login' => set_value('last_login'),
	    'active' => set_value('active'),
	    'first_name' => set_value('first_name'),
	    'last_name' => set_value('last_name'),
	    'company' => set_value('company'),
	    'phone' => set_value('phone'),
	);
        $this->template->load('template','users_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'salt' => set_value('salt', $row->salt),
		'email' => set_value('email', $row->email),
		'activation_code' => set_value('activation_code', $row->activation_code),
		'forgotten_password_code' => set_value('forgotten_password_code', $row->forgotten_password_code),
		'forgotten_password_time' => set_value('forgotten_password_time', $row->forgotten_password_time),
		'remember_code' => set_value('remember_code', $row->remember_code),
		'created_on' => set_value('created_on', $row->created_on),
		'last_login' => set_value('last_login', $row->last_login),
		'active' => set_value('active', $row->active),
		'first_name' => set_value('first_name', $row->first_name),
		'last_name' => set_value('last_name', $row->last_name),
		'company' => set_value('company', $row->company),
		'phone' => set_value('phone', $row->phone),
	    );
            $this->template->load('template','users_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Users_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('salt', 'salt', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('activation_code', 'activation code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_code', 'forgotten password code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_time', 'forgotten password time', 'trim|required');
	$this->form_validation->set_rules('remember_code', 'remember code', 'trim|required');
	$this->form_validation->set_rules('created_on', 'created on', 'trim|required');
	$this->form_validation->set_rules('last_login', 'last login', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');
	$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
	$this->form_validation->set_rules('company', 'company', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-24 15:27:35 */
/* http://harviacode.com */