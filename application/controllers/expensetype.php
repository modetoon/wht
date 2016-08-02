<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expensetype extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Expensetype_model');

		is_logged_in();

    }

	public function index()
	{
		$data['title'] = 'Expense Type List';

		$res = $this->Expensetype_model->get_lists();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('expensetype/lists', $data);
	}

	public function lists()
	{
		$data['title'] = 'Expense Type List';

		$res = $this->Expensetype_model->get_lists();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('expensetype/lists', $data);
	}

	public function add($id='')
	{
		$data['title'] = 'Add Expense Type';

		$selected = '';
		if($id!=''){
			$result = $this->Expensetype_model->get_data($id);
			$data['result'] = $result;
		}

		$this->form_validation->set_rules('ExpenseTypeName', 'Expense Type Name', 'required|min_length[2]');
		$this->form_validation->set_rules('Percent', 'Percent', 'required|max_length[2]');

		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('header', $data);
			$this->load->view('expensetype/add', $data);

		}
		else
		{

			$data_insert = array(
				'ExpenseTypeName' => $this->input->post('ExpenseTypeName'),
				'Percent' => $this->input->post('Percent'),
				'Status' => $this->input->post('Status')
			);
			if($this->input->post('ID') == '')
			{
				$main_menu = $this->Expensetype_model->insert_data($data_insert);
			}
			else
			{
				$main_menu = $this->Expensetype_model->update_data($data_insert,$this->input->post('ID'));
			}
			redirect(site_url('expensetype/lists'), 'refresh');
		}

	}	

	public function delete($id='')
	{
		$this->Expensetype_model->delete($id);
		redirect(site_url('expensetype/lists'), 'refresh');

	}

}
