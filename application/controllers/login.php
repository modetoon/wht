<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Login_model');
    }

    public function index() {
        $data = array('title' => 'Listing');

        $this->load->view('login');
    }

    public function check() {

        $this->form_validation->set_rules('Username', 'Username', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required|min_length[1]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login');
        } else {
            $_data = $this->Login_model->get_data($this->input->post('Username'));
            if (count($_data) > 0) {
                if ($_data->UserID != '') {
                    if ($_data->Password == $this->input->post('Password')) {
                        $data = array(
                            'user_id' => $_data->UserID,
                            'user_name' => $_data->UserName,
                            'user_fullname_thai' => $_data->FullNameThai,
                            'email' => $_data->Email,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($data);
                        redirect(site_url(''), 'refresh');
                    } else {
                        redirect(site_url('login'), 'refresh');
                    }
                } else {
                    redirect(site_url('login'), 'refresh');
                }
            } else {
                redirect(site_url('login'), 'refresh');
            }
        }
    }

}
