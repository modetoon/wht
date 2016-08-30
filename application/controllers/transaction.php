<?php

    if (!defined('BASEPATH'))
	exit('No direct script access allowed');

    class Transaction extends CI_Controller {
	public function __construct() {
	    // Call the Model constructor
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->helper('date');
	    $this->load->library('form_validation');
	    $this->load->model('Transaction_model');
	    $this->load->model('customer_model');
	    $this->load->model('expensetype_model');

	    is_logged_in();
	}
	public function index() {
	    $data = array('title' => 'Listing');

	    $this->load->view('header', $data);
	    $this->load->view('transaction/lists');
	}
	public function lists() {
	    $data['title'] = 'Transaction List';

	    $res = $this->Transaction_model->get_lists();
	    $data['result'] = $res;

	    $this->load->view('header', $data);
	    $this->load->view('transaction/lists', $data);
	}
	public function add($id = '') {
	    $this->load->model('Transaction_model');
	    $data['title'] = 'Add/Edit Transaction';

	    $selected = '';
	    $selected2 = '';
	    if ($id != '') {
		$result = $this->Transaction_model->get_data($id);
		$data['result'] = $result;
		$selected = $result->CustomerID;
		$selected2 = $result->ExpenseTypeID;
		$data['Condition'] = $result->Condition;
	    } else {
		$data['DocNo'] = $this->Transaction_model->get_docno($id);
	    }
	    if ($this->input->post('CustomerID') != '') {
		$selected = $this->input->post('CustomerID');
	    }
	    if ($this->input->post('ExpenseTypeID') != '') {
		$selected2 = $this->input->post('ExpenseTypeID');
	    }

	    $customer_menu = $this->Transaction_model->get_customer_dd($selected);
	    $data['customer_dropdownlist'] = $customer_menu;

	    $expensetype_menu = $this->Transaction_model->get_expensetype_dd($selected2);
	    $data['expensetype_dropdownlist'] = $expensetype_menu;

	    $this->form_validation->set_rules('DocNo', 'Document No', 'required');
	    $this->form_validation->set_rules('CustomerID', 'Customer', 'required');
	    $this->form_validation->set_rules('TransactionDate', 'Transaction Date', 'required');
	    $this->form_validation->set_rules('NetAmount', 'Amount (จำนวนเงินที่ต้องจ่าย Excl Va', 'required|min_length[1]');
	    $this->form_validation->set_rules('ExpenseTypeID', 'Expense Type', 'required');
	    //$this->form_validation->set_rules('TaxPercent', 'Tax (%)', 'required|integer');										
	    $this->form_validation->set_rules('Amount', 'Amount (จำนวนเงินที่ต้องจ่าย Incl Vat)', 'required');
	    $this->form_validation->set_rules('Condition', 'Condition', 'required');

	    if ($this->form_validation->run() === FALSE) {
		$data['CustomerID'] = $this->input->post('CustomerID');
		$data['Condition'] = $this->input->post('Condition');
		$this->load->view('header', $data);
		$this->load->view('transaction/add', $data);
	    } else {
		$arrExpense = explode('|', $this->input->post('ExpenseTypeID'));
		$data_insert = array(
		    'DocNo' => $this->input->post('DocNo'),
		    'CustomerID' => $this->input->post('CustomerID'),
		    'TransactionDate' => $this->input->post('TransactionDate'),
		    'Amount' => $this->input->post('Amount'),
		    'TaxAmount' => $this->input->post('TaxAmount'),
		    'NetAmount' => $this->input->post('NetAmount'),
		    'ExpenseTypeID' => $arrExpense[0],
		    'TaxPercent' => $arrExpense[1],
		    'Condition' => $this->input->post('Condition'),
		    'Remark' => $this->input->post('Remark'),
		    'Status' => $this->input->post('Status')
		);
		/* echo '<pre>';
		  print_r($data_insert);
		  echo '</pre>';
		  die; */
		if ($this->input->post('ID') == '') {
		    $result = $this->Transaction_model->insert_data($data_insert);
		} else {
		    $result = $this->Transaction_model->update_data($data_insert, $this->input->post('ID'));
		}

		redirect(site_url('transaction/lists'), 'refresh');
	    }
	}
	public function delete($id = '') {
	    $this->Transaction_model->delete($id);
	    redirect(site_url('transaction/lists'), 'refresh');
	}
	public function importExcel() {
	    $data['title'] = 'Import Transaction from Excel';
	    $this->load->view('header', $data);
	    $this->load->view('transaction/import_excel', $data);
	}
	public function processImport() {
	    $file = $_FILES['file']['tmp_name'];
	    $this->load->library('excel');
	    $oPhpExcel = PHPExcel_IOFactory::load($file);
	    $sheet = $oPhpExcel->getActiveSheet(0);
	    $maxRow = $sheet->getHighestRow();
	    $maxColumn = $sheet->getHighestColumn();

	    $this->db->trans_begin();
	    for($row = 2; $row <= $maxRow; $row++) {
		$rowData = $sheet->rangeToArray('A'.$row.':'.$maxColumn.$row, NULL, TRUE, FALSE);

		if (($rowData[0][0] == '') and ( $rowData[0][1] == '') and ( $rowData[0][2] == '') and ( $rowData[0][3] == '')
			and ( $rowData[0][4] == '') and ( $rowData[0][5] == '') and ( $rowData[0][6] == '')
			and ( $rowData[0][7] == '') and ( $rowData[0][8] == '')) {
		    
		} else {
		    $customerCode = $rowData[0][0];
		    $customerThaiName = $rowData[0][1];
		    $date = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($rowData[0][2]));
		    $whtType = $rowData[0][3];
		    $condition = $rowData[0][4];
		    $cnAmount = $rowData[0][5];
		    $remark = $rowData[0][6];
		    $customerEnglishName = $rowData[0][7];
		    $address = $rowData[0][8];

		    // Insert New Customer or Update Customer
		    // --------------------------------------
		    if ($customerCode != '') {
			$customer = $this->customer_model->get_data_by_customer_code($customerCode);
			if (empty($customer)) {
			    $data = array(
				"CustomerCode" => "$customerCode",
//                    "Type" => "",
				"FullNameThai" => "$customerThaiName",
				"FullNameEnglish" => "$customerEnglishName",
//                    "IDCard" => "",
//                    "TaxNumber" => "",
//                    "Phone" => "",
//                    "Email" => "",
				"Address" => "$address",
				"CreatedDate" => now(),
				"CreatedBy" => ""
			    );

			    $this->customer_model->insert_data($data);
			} else {
			    $data = array();
			    if ($customer->CustomerCode == "")
				$data['CustomerCode'] = "$customerCode";
			    if ($customer->FullNameThai == "")
				$data['FulllNameThai'] = "$customerThaiName";
			    if ($customer->FullNameEnglish == "")
				$data['FullNameEnglish'] = "$customerEnglishName";
			    if ($customer->Address == "")
				$data['Address'] = "$address";

			    if (!empty($data))
				$this->customer_model->update_data_by_customer_code($data, $customerCode);
			}
		    }
		    // <----------------   End of Insert or Update Customer  -------------------->
		    // 
		    // Insert into Transaction
		    // ------------------------

		    $customer = $this->customer_model->get_data_by_customer_code($customerCode);
		    $customerId = (empty($customer)) ? 0 : $customer->CustomerID;

		    $expenseType = $this->expensetype_model->get_data_by_wht_type($whtType);
		    $taxPercent = 0;
		    $expenseTypeId = 0;
		    if (!empty($expenseType)) {
			$taxPercent = $expenseType->Percent;
			$expenseTypeId = $expenseType->ExpenseTypeID;
		    }
		    $amount = round((((100 - $taxPercent) * $cnAmount) / 100), 2);
		    $taxAmount = $cnAmount - $amount;
		    $docNo = $this->Transaction_model->get_docno();
		    $data = array(
			"DocNo" => $docNo,
			"CustomerID" => $customerId,
			"TransactionDate" => $date,
			"Amount" => $cnAmount,
			"TaxAmount" => $taxAmount,
			"NetAmount" => $amount,
			"ExpenseTypeID" => $expenseTypeId,
			"TaxPercent" => $taxPercent,
			"Condition" => $condition,
			"Remark" => $remark
		    );

		    $this->Transaction_model->insert_data($data);
		}
		// <----------------  End of Insert Transaction ----------------------------->
	    }

	    $this->db->trans_complete();

	    if ($this->db->trans_status() === FALSE) {
		$this->db->trans_rollback();
	    } else {
		$this->db->trans_commit();
	    }

	    redirect(base_url('Transaction/importexcel'));
	}
    }
    