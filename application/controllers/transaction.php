<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->model('Transaction_model');

		is_logged_in();

    }

	public function index()
	{
		$data = array('title'=> 'Listing');

		$this->load->view('header', $data);
		$this->load->view('transaction/lists');
	}

	public function lists()
	{
		$data['title'] = 'Transaction List';

		$res = $this->Transaction_model->get_lists();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('transaction/lists', $data);
	}

	public function add($id='')
	{
		$this->load->model('Transaction_model');
		$data['title'] = 'Add Transaction';

		$selected = '';
		$selected2 = '';
		if($id !=''){
			$result = $this->Transaction_model->get_data($id);
			$data['result'] = $result;
			$selected = $result->CustomerID;
			$selected2 = $result->ExpenseTypeID;
			$data['Overhead'] = $result->OverHead;
		}else{
			$data['DocNo'] = $this->Transaction_model->get_docno($id);
		}
		if($this->input->post('CustomerID') != '')
		{
			$selected = $this->input->post('CustomerID');
		}
		if($this->input->post('ExpenseTypeID') != '')
		{
			$selected2 = $this->input->post('ExpenseTypeID');
		}

		$customer_menu = $this->Transaction_model->get_customer_dd($selected);
		$data['customer_dropdownlist'] = $customer_menu;	
		
		$expensetype_menu = $this->Transaction_model->get_expensetype_dd($selected2);
		$data['expensetype_dropdownlist'] = $expensetype_menu;

		$this->form_validation->set_rules('DocNo', 'Document No', 'required');
		$this->form_validation->set_rules('CustomerID', 'Customer', 'required');
		$this->form_validation->set_rules('TransactionDate', 'Transaction Date', 'required');
		$this->form_validation->set_rules('AmountExclVat', 'Amount Excl Vat', 'required|min_length[1]');
		$this->form_validation->set_rules('ExpenseTypeID', 'Expense Type', 'required');										
		//$this->form_validation->set_rules('TaxPercent', 'Tax (%)', 'required|integer');										
		$this->form_validation->set_rules('AmountInclVat', 'Amount Incl Vat', 'required');										
		$this->form_validation->set_rules('Overhead', 'Overhead', 'required');										

		if ($this->form_validation->run() === FALSE)
		{
			$data['CustomerID'] = $this->input->post('CustomerID');
			$data['Overhead'] = $this->input->post('Overhead');
			$this->load->view('header', $data);
			$this->load->view('transaction/add', $data);

		}
		else
		{
			$arrExpense = explode('|',$this->input->post('ExpenseTypeID'));
			$data_insert = array(
					'DocNo' => $this->input->post('DocNo'),
					'CustomerID' => $this->input->post('CustomerID'),
					'TransactionDate' => $this->input->post('TransactionDate'),
					'AmountExclVat' => $this->input->post('AmountExclVat'),
					'ExpenseTypeID' => $arrExpense[0],
					'TaxPercent' => $arrExpense[1],
					'AmountInclVat' => $this->input->post('AmountInclVat'),
					'OverHead' => $this->input->post('Overhead')
			);
			if($this->input->post('ID') == '')
			{
				$result = $this->Transaction_model->insert_data($data_insert);
			}
			else
			{
				$result = $this->Transaction_model->update_data($data_insert,$this->input->post('ID'));
			}

			redirect(site_url('transaction/lists'), 'refresh');
		}

	}	

	public function delete($id='')
	{
		$this->Transaction_model->delete($id);
		redirect(site_url('transaction/lists'), 'refresh');

	}

}
