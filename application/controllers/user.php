<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');
        
        is_logged_in();
    }

    public function index() {
        $data = array('title' => 'Listing');

        $this->load->view('header', $data);
        $this->load->view('user/lists');
    }

    public function lists() {
        $data['title'] = 'User List';

        $res = $this->User_model->get_lists();
        $data['result'] = $res;

        $this->load->view('header', $data);
        $this->load->view('user/lists', $data);
    }

    public function add($id = '') {
        $this->load->model('user_model');
        $data['title'] = 'Add User';

        $selected = '';
        $selected2 = '';
        if ($id != '') {
            $result = $this->User_model->get_data($id);
            $data['result'] = $result;
        }

        $this->form_validation->set_rules('UserType', 'User Type', 'required');

        if ($this->input->post('ID') != '') {
            $this->form_validation->set_rules('UserName', 'UserName', 'required|min_length[4]');
        } else {
            $this->form_validation->set_rules('UserName', 'UserName', 'required|min_length[4]|is_unique[user.UserName]');
        }
        $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('FullNameThai', 'FullNameThai', 'required|min_length[1]');
        $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|min_length[1]');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('header', $data);
            $this->load->view('user/add', $data);
        } else {
            $data_insert = array(
                'UserType' => $this->input->post('UserType'),
                'UserName' => $this->input->post('UserName'),
                'Password' => $this->input->post('Password'),
                'FullNameThai' => $this->input->post('FullNameThai'),
                'Email' => $this->input->post('Email'),
                'Status' => $this->input->post('Status')
            );
            if ($this->input->post('ID') == '') {
                $result = $this->User_model->insert_data($data_insert);
            } else {
                $result = $this->User_model->update_data($data_insert, $this->input->post('ID'));
            }

            redirect(site_url('user/lists'), 'refresh');
        }
    }

    public function delete($id = '') {
        $this->User_model->delete($id);
        redirect(site_url('user/lists'), 'refresh');
    }

}
