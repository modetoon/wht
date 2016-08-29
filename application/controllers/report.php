<?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of report
     *
     * @author narongdetch
     */
    class Report extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->helper('date');
	    $this->load->library('form_validation');

	    $this->load->model('transaction_model');
	    $this->load->model('customer_model');
	}
	public function index() {
	    $data = array('title' => 'Report');
	    $this->load->view('header', $data);
	    $this->load->view('report/index', $data);
	}
	public function whtCriteria() {
	    $startDate = date("Y-m-d");
	    $endDate = date("Y-m-d");
	    $oCustomers = $this->customer_model->get_lists('FullNameThai');
	    $docNos = $this->transaction_model->get_first_last_doc_no_by_date($startDate, $endDate);

	    $data = array(
		'title' => 'Print Withholding Tax',
		'startDate' => $startDate,
		'endDate' => $endDate,
		'oCustomers' => $oCustomers,
		'startDocNo' => $docNos['startDocNo'],
		'endDocNo' => $docNos['endDocNo']
	    );

	    $this->load->view('header', $data);
	    $this->load->view('report/whtcriteria', $data);
	}
	public function processPrintWht() {
	    $startDate = $this->input->post('start_date');
	    $endDate = $this->input->post('end_date');
	    $customerId = $this->input->post('customer_id');
	    $startDocNo = $this->input->post('start_doc_no');
	    $endDocNo = $this->input->post('end_doc_no');
	    $file = "assets/excel_templates/wht_template.xlsx";

	    $this->load->library('excel');
	    $oReader = PHPExcel_IOFactory::createReader('Excel2007');
	    $oPHPExcel = $oReader->load($file);
	    $oPHPExcel->setActiveSheetIndex(0);

	    $outputPath = '';
	    $pathStructures = explode('\\', dirname(__FILE__));
	    for($i = 0; $i < count($pathStructures); $i++) {
		$outputPath .= $pathStructures[$i].'\\';
		if ($pathStructures[$i] == 'wht') {
		    $i = 999;
		}
	    }

	    $outputPath .= 'print_wht'.'\\';

	    $transactions = $this->transaction_model->get_data_by_date_customer_docno('CreateExcel', $startDate, $endDate, $customerId, $startDocNo, $endDocNo);
	    foreach($transactions as $transaction) {
		$fileName = 'wht-'.$transaction->CustomerCode.'-'.$transaction->TransactionDate.'.xlsx';
		$outputFile = $outputPath.$fileName;

		$oPHPExcel->getActiveSheet()->setCellValue('AU4', $transaction->DocNo);
		$oPHPExcel->getActiveSheet()->setCellValue('AU80', $transaction->DocNo);
		$oPHPExcel->getActiveSheet()->setCellValue('AU156', $transaction->DocNo);
		$oPHPExcel->getActiveSheet()->setCellValue('AU232', $transaction->DocNo);
		$oPHPExcel->getActiveSheet()->setCellValue('AK13', $transaction->TaxNumber);
		$oPHPExcel->getActiveSheet()->setCellValue('AK85', $transaction->TaxNumber);
		$oPHPExcel->getActiveSheet()->setCellValue('AK161', $transaction->TaxNumber);
		$oPHPExcel->getActiveSheet()->setCellValue('AK237', $transaction->TaxNumber);
		$oPHPExcel->getActiveSheet()->setCellValue('AK9', $transaction->IDCard);
		$oPHPExcel->getActiveSheet()->setCellValue('AK89', $transaction->IDCard);
		$oPHPExcel->getActiveSheet()->setCellValue('AK165', $transaction->IDCard);
		$oPHPExcel->getActiveSheet()->setCellValue('AK241', $transaction->IDCard);
		$oPHPExcel->getActiveSheet()->setCellValue('G13', $transaction->FullNameThai);
		$oPHPExcel->getActiveSheet()->setCellValue('G89', $transaction->FullNameThai);
		$oPHPExcel->getActiveSheet()->setCellValue('G165', $transaction->FullNameThai);
		$oPHPExcel->getActiveSheet()->setCellValue('G241', $transaction->FullNameThai);
		$oPHPExcel->getActiveSheet()->setCellValue('G14', $transaction->Address);
		$oPHPExcel->getActiveSheet()->setCellValue('G90', $transaction->Address);
		$oPHPExcel->getActiveSheet()->setCellValue('G166', $transaction->Address);
		$oPHPExcel->getActiveSheet()->setCellValue('G242', $transaction->Address);
		$oPHPExcel->getActiveSheet()->setCellValue('H51', $transaction->ExpenseTypeName);
		$oPHPExcel->getActiveSheet()->setCellValue('H127', $transaction->ExpenseTypeName);
		$oPHPExcel->getActiveSheet()->setCellValue('H203', $transaction->ExpenseTypeName);
		$oPHPExcel->getActiveSheet()->setCellValue('H279', $transaction->ExpenseTypeName);
		$oPHPExcel->getActiveSheet()->setCellValue('Y51', $transaction->TransactionDate);
		$oPHPExcel->getActiveSheet()->setCellValue('Y127', $transaction->TransactionDate);
		$oPHPExcel->getActiveSheet()->setCellValue('Y203', $transaction->TransactionDate);
		$oPHPExcel->getActiveSheet()->setCellValue('Y279', $transaction->TransactionDate);

		$oPHPExcel->getActiveSheet()->setCellValue('C72', $transaction->Remark);
		$oPHPExcel->getActiveSheet()->setCellValue('C148', $transaction->Remark);
		$oPHPExcel->getActiveSheet()->setCellValue('C224', $transaction->Remark);
		$oPHPExcel->getActiveSheet()->setCellValue('C300', $transaction->Remark);

		$dates = explode('-', $transaction->TransactionDate);
		$monthYear = "(".$dates[1]."/".$dates[0].")";

		$oPHPExcel->getActiveSheet()->setCellValue('AV72', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV148', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV22', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV300', $monthYear);

		$oPHPExcel->getActiveSheet()->setCellValue('AF51', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF127', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF203', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF279', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ51', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ127', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ203', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ279', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF55', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF131', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF203', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF283', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ55', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ131', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ203', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ283', number_format($transaction->TaxAmount, 2));

		if ($transaction->Condition == '1') {
		    $oPHPExcel->getActiveSheet()->setCellValue('G62', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G138', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G214', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G290', 'X');
		}

		if ($transaction->Condition == '3') {
		    $oPHPExcel->getActiveSheet()->setCellValue('G66', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G142', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G218', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G292', 'X');
		}

		$oWriter = PHPExcel_IOFactory::createWriter($oPHPExcel, 'Excel2007');
		$oWriter->save($outputFile);

		$data = array(
		    'CreatedExcel' => 1
		);
		$this->transaction_model->update_created_excel($data, $transaction->TransactionID);
	    }

	    $result = $this->displayWhtTable($startDate, $endDate, $customerId, $startDocNo, $endDocNo);

	    echo $result;
	}
	public function whtList() {
	    $startDate = $_REQUEST['start_date'];
	    $endDate = $_REQUEST['end_date'];
	    $customerId = $_REQUEST['customer_id'];
	    $startDocNo = $_REQUEST['start_doc_no'];
	    $endDocNo = $_REQUEST['end_doc_no'];

	    $result = $this->displayWhtTable($startDate, $endDate, $customerId, $startDocNo, $endDocNo);

	    echo $result;
	}
	public function displayWhtTable($startDate, $endDate, $customerId, $startDocNo, $endDocNo) {
	    $oTransactions = $this->transaction_model->get_data_by_date_customer_docno('display', $startDate, $endDate, $customerId, $startDocNo, $endDocNo);
	    $result = '
		    <div class="col-lg-12">
			<div class="panel panel-default">
			    <div class="panel-body">
				<div class="dataTable_wrapper">
				    <table class="table table-striped table-bordered table-hover" id="ListTable">
					<thead>
					    <tr>
						<th style="width:  1%; text-align: center">No</th>
						<th style="width:  5%; text-align: center">Doc No</th>
						<th style="width:  5%; text-align: center">Date</th>
						<th style="width: 25%; text-align: center">Customer</th>
						<th style="width: 10%; text-align: center">ID Card</th>
						<th style="width:  5%; text-align: center">Amount</th>
						<th style="width:  7%; text-align: center">Tax Amount</th>
						<th style="width:  1%; text-align: center">view</th>
					    </tr>
					</thead>
					<tbody>
	    ';

	    $outputPath = '';
	    $pathStructures = explode('\\', dirname(__FILE__));
	    for($i = 0; $i < count($pathStructures); $i++) {
		$outputPath .= $pathStructures[$i].'\\';
		if ($pathStructures[$i] == 'wht') {
		    $i = 999;
		}
	    }

	    $outputPath .= 'print_wht'.'\\';

	    $i = 0;
	    foreach($oTransactions as $oTransaction) {
		$fileName = 'wht-'.$oTransaction->CustomerCode.'-'.$oTransaction->TransactionDate.'.xlsx';
		$excelUrl = base_url('print_wht'.'/'.$fileName);
		$excelFile = $outputPath.$fileName;

		$i++;

		$result .= '
			<tr>
			    <td class="text-right">'.$i.'</td>
			    <td class="text-center">'.$oTransaction->DocNo.'</td>
			    <td class="text-center">'.$oTransaction->TransactionDate.'</td>
			    <td>'.$oTransaction->CustomerCode." : ".$oTransaction->FullNameThai.'</td>
			    <td class="text-center">'.$oTransaction->IDCard.'</td>
			    <td class="text-right">'.number_format($oTransaction->Amount, 2).'</td>
			    <td class="text-right">'.number_format($oTransaction->TaxAmount, 2).'</td>
		';
		if (file_exists($excelFile)) {
		    $result .= '<td class="text-center"><a href="<?php echo $excelUrl; ?>"><i class="btn btn-success fa fa-file-excel-o" style="cursor: grab;" aria-hidden="true"></i></a></td>';
		} else {
		    $result .= '<td class="text-center">-</td>';
		}

		$result .= '</tr>';
	    }

	    if (count($oTransactions) == 0) {
		$result .= '
			<tr>
			    <td colspan="7" class="text-center"><--- No Data Found ---><td>
			</tr>
		';
	    }

	    $result .= '
					</tbody>
				    </table>
				</div>
			    </div>
			</div>
		    </div>
	    ';

	    return $result;
	}
	public function summaryCriteria() {
	    $oCustomers = $this->customer_model->get_lists('FullNameThai');

	    $data = array(
		'title' => 'Print Summary Report',
		'oCustomers' => $oCustomers
	    );

	    $this->load->view('header', $data);
	    $this->load->view('report/summarycriteria', $data);
	}
	public function summaryList() {
	    $startDate = $_REQUEST['start_date'];
	    $endDate = $_REQUEST['end_date'];
	    $customerId = $_REQUEST['customer_id'];

	    $result = $this->displaySummaryTable($startDate, $endDate, $customerId);

	    echo $result;
	}
	public function displaySummaryTable($startDate, $endDate, $customerId) {
	    $result = '
		    <div class="col-lg-12">
			<div class="panel panel-default">
			    <div class="panel-body">
				<div class="dataTable_wrapper">
				    <table class="table table-striped table-bordered table-hover" id="ListTable">
					<thead>
					    <tr>
						<th style="width:  1%; text-align: center">No</th>
						<th style="width: 25%; text-align: center">Customer</th>
						<th style="width: 10%; text-align: center">ID Card</th>
						<th style="width:  5%; text-align: center">DocNo</th>
						<th style="width:  5%; text-align: center">Date</th>
						<th style="width:  5%; text-align: center">Amount</th>
						<th style="width:  7%; text-align: center">Tax Amount</th>
						<th style="width:  1%; text-align: center">view</th>
					    </tr>
					</thead>
					<tbody>
	    ';

	    $oTransactions = $this->transaction_model->get_summary_data_by_customer($startDate, $endDate, $customerId);

	    $outputPath = '';
	    $pathStructures = explode('\\', dirname(__FILE__));
	    for($i = 0; $i < count($pathStructures); $i++) {
		$outputPath .= $pathStructures[$i].'\\';
		if ($pathStructures[$i] == 'wht') {
		    $i = 999;
		}
	    }

	    $outputPath .= 'print_summary'.'\\';

	    $i = 0;
	    $totalAmount = 0;
	    $totalTaxAmount = 0;
	    foreach($oTransactions as $oTransaction) {
		$fileName = 'wht-'.$oTransaction->CustomerCode.'.xlsx';
		$excelUrl = base_url('print_summary'.'/'.$fileName);
		$excelFile = $outputPath.$fileName;

		$i++;
		$totalAmount += $oTransaction->Amount;
		$totalTaxAmount += $oTransaction->TaxAmount;
		$result .= '
			<tr>
			    <td class="text-right">'.$i.'</td>
			    <td>'.$oTransaction->CustomerCode." : ".$oTransaction->FullNameThai.'</td>
			    <td class="text-center">'.$oTransaction->IDCard.'</td>
			    <td class="text-center">'.$oTransaction->DocNo.'</td>
			    <td class="text-center">'.$oTransaction->TransactionDate.'</td>
			    <td class="text-right">'.number_format($oTransaction->Amount, 2).'</td>
			    <td class="text-right">'.number_format($oTransaction->TaxAmount, 2).'</td>
		';
		if (file_exists($excelFile)) {
		    $result .= '<td class="text-center"><a href="<?php echo $excelUrl; ?>"><i class="btn btn-success fa fa-file-excel-o" style="cursor: grab;" aria-hidden="true"></i></a></td>';
		} else {
		    $result .= '<td class="text-center">-</td>';
		}

		$result .= '</tr>';
	    }

	    if (count($oTransactions) == 0) {
		$result .= '
			<tr>
			    <td colspan="5" class="text-center"><--- No Data Found ---><td>
			</tr>
		';
	    }

	    $result .= '
					</tbody>
	    ';
	    
	    if (count($oTransaction) != 0) {
		$result .= '
				<tfoot>
				    <tr>
					<td class="text-left" colspan="5">Total</d>
					<td class="text-right"><strong>'.number_format($totalAmount, 2).'</strong></d>
					<td class="text-right"><strong>'.number_format($totalTaxAmount, 2).'</strong></d>
				    </tr>
				</tfoot>
		';
	    }

	    
	    $result .= '
				    </table>
				</div>
			    </div>
			</div>
		    </div>
	    ';

	    return $result;
	}
	public function processPrintSummary() {
	    $startDate = $this->input->post('start_date');
	    $endDate = $this->input->post('end_date');
	    $customerId = $this->input->post('customer_id');

	    $file = "assets/excel_templates/summary_data.xlsx";

	    $this->load->library('excel');
	    $oReader = PHPExcel_IOFactory::createReader('Excel2007');
	    $oPHPExcel = $oReader->load($file);
	    $oPHPExcel->setActiveSheetIndex(0);

	    $outputPath = '';
	    $pathStructures = explode('\\', dirname(__FILE__));
	    for($i = 0; $i < count($pathStructures); $i++) {
		$outputPath .= $pathStructures[$i].'\\';
		if ($pathStructures[$i] == 'wht') {
		    $i = 999;
		}
	    }

	    $outputPath .= 'print_summary'.'\\';

	    $transactions = $this->transaction_model->get_summary_data_by_customer($startDate, $endDate, $customerId);
	    $base_row = 2;
	    $i = $base_row + 1;
	    foreach($transactions as $transaction) {
		$fileName = 'wht-'.$transaction->CustomerCode.'.xlsx';
		$outputFile = $outputPath.$fileName;

		$oPHPExcel->getActiveSheet()->setCellValue('A'.$i, $transaction->DocNo);
		$oPHPExcel->getActiveSheet()->setCellValue('B'.$i, $transaction->TransactionDate);
		$oPHPExcel->getActiveSheet()->setCellValue('C'.$i, $transaction->FullNameThai);
		$oPHPExcel->getActiveSheet()->setCellValue('D'.$i, $transaction->Address);
		$oPHPExcel->getActiveSheet()->setCellValue('E'.$i, $transaction->TaxNumber);
		$oPHPExcel->getActiveSheet()->setCellValue('F'.$i, $transaction->);	// ประเภทเงินได้
		$oPHPExcel->getActiveSheet()->setCellValue('G'.$i, $transaction->);	// เงื่อนไข
		$oPHPExcel->getActiveSheet()->setCellValue('H'.$i, $transaction->Amount);
		$oPHPExcel->getActiveSheet()->setCellValue('I'.$i, $transaction->TaxAmount);


		$dates = explode('-', $transaction->TransactionDate);
		$monthYear = "(".$dates[1]."/".$dates[0].")";

		$oPHPExcel->getActiveSheet()->setCellValue('AV72', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV148', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV22', $monthYear);
		$oPHPExcel->getActiveSheet()->setCellValue('AV300', $monthYear);

		$oPHPExcel->getActiveSheet()->setCellValue('AF51', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF127', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF203', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF279', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ51', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ127', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ203', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ279', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF55', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF131', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF203', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AF283', number_format($transaction->Amount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ55', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ131', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ203', number_format($transaction->TaxAmount, 2));
		$oPHPExcel->getActiveSheet()->setCellValue('AQ283', number_format($transaction->TaxAmount, 2));

		if ($transaction->Condition == '1') {
		    $oPHPExcel->getActiveSheet()->setCellValue('G62', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G138', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G214', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G290', 'X');
		}

		if ($transaction->Condition == '3') {
		    $oPHPExcel->getActiveSheet()->setCellValue('G66', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G142', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G218', 'X');
		    $oPHPExcel->getActiveSheet()->setCellValue('G292', 'X');
		}

		$oWriter = PHPExcel_IOFactory::createWriter($oPHPExcel, 'Excel2007');
		$oWriter->save($outputFile);

		$data = array(
		    'CreatedExcel  ' => 1
		);
		$this->transaction_model->update_created_excel($data, $transaction->TransactionID);
	    }

	    $result = $this->displayWhtTable($startDate, $endDate, $customerId);

	    echo $result;
	}
    }
    