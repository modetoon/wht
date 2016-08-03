<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->model('Customer_model');

		is_logged_in();

    }

	public function index()
	{
		$data = array('title'=> 'Listing');

		$this->load->view('header', $data);
		$this->load->view('customer/lists');
	}

	public function lists()
	{
		$data['title'] = 'Customer List';

		$res = $this->Customer_model->get_lists();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('customer/lists', $data);
	}

	public function add($id='')
	{
		$this->load->model('Customer_model');
		$data['title'] = 'Add Customer';

		$selected = '';
		$selected2 = '';
		if($id !=''){
			$result = $this->Customer_model->get_data($id);
			$data['result'] = $result;
		}

		$this->form_validation->set_rules('Type', 'Customer Type', 'required');
		$this->form_validation->set_rules('FullName', 'FullName', 'required|min_length[3]');
		$this->form_validation->set_rules('IDCard', 'ID Card', 'required|exact_length[13]');
		$this->form_validation->set_rules('TaxNumber', 'Tax Number', 'required|min_length[1]');
		$this->form_validation->set_rules('Email', 'Email', 'required|valid_email|min_length[5]');										
		$this->form_validation->set_rules('Phone', 'Phone', 'required');										
		$this->form_validation->set_rules('Address', 'Address', 'min_length[5]');										

		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('header', $data);
			$this->load->view('customer/add', $data);

		}
		else
		{
			if($this->input->post('ID') == '')
			{
				$data_insert = array(
					'Type' => $this->input->post('Type'),
					'FullName' => $this->input->post('FullName'),
					'IDCard' => $this->input->post('IDCard'),
					'TaxNumber' => $this->input->post('TaxNumber'),
					'Email' => $this->input->post('Email'),
					'Phone' => $this->input->post('Phone'),
					'Address' => $this->input->post('Address'),
					'CreatedDate' => date('Y-m-d'),
					'CreatedBy' => $this->session->userdata('user_name'),
					'Status' => $this->input->post('Status')
				);
				$result = $this->Customer_model->insert_data($data_insert);
			}
			else
			{
				$data_insert = array(
					'Type' => $this->input->post('Type'),
					'FullName' => $this->input->post('FullName'),
					'IDCard' => $this->input->post('IDCard'),
					'TaxNumber' => $this->input->post('TaxNumber'),
					'Email' => $this->input->post('Email'),
					'Phone' => $this->input->post('Phone'),
					'Address' => $this->input->post('Address'),
					'UpdatedDate' => date('Y-m-d'),
					'UpdatedBy' => $this->session->userdata('user_name'),
					'Status' => $this->input->post('Status')
				);
				$result = $this->Customer_model->update_data($data_insert,$this->input->post('ID'));
			}

			redirect(site_url('customer/lists'), 'refresh');
		}

	}	

	public function delete($id='')
	{
		$this->Customer_model->delete($id);
		redirect(site_url('customer/lists'), 'refresh');

	}

}
