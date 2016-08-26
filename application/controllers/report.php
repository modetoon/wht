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
    }

    public function index() {
        $data = array('title' => 'Report');
        $this->load->view('header', $data);
        $this->load->view('report/index', $data);
    }

    public function whtCriteria() {
        $startDate = date("Y-m-d");
        $endDate = date("Y-m-d");

        $docNos = $this->transaction_model->get_first_last_doc_no_by_date($startDate, $endDate);

        $data = array(
            'title' => 'Print Withholding Tax',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'startDocNo' => $docNos['startDocNo'],
            'endDocNo' => $docNos['endDocNo']
        );

        $this->load->view('header', $data);
        $this->load->view('report/whtcriteria', $data);
    }

    public function processPrintWht() {
        $startDate = $this->input->post('start_date');
        $endDate = $this->input->post('end_date');
        $startDocNo = $this->input->post('start_doc_no');
        $endDocNo = $this->input->post('end_doc_no');
        $file = "assets/excel_templates/wht_template.xlsx";

        $this->load->library('excel');
        $oReader = PHPExcel_IOFactory::createReader('Excel2007');
        $oPHPExcel = $oReader->load($file);
        $oPHPExcel->setActiveSheetIndex(0);

        $pathStructures = explode('\\', dirname(__FILE__));

        $outputPath = '';
        for ($i = 0; $i < count($pathStructures); $i++) {
            $outputPath .= $pathStructures[$i] . '\\';
            if ($pathStructures[$i] == 'wht') {
                $i = 999;
            }
        }

        $outputPath .= 'print_wht' . '\\';

        $transactions = $this->transaction_model->get_data_by_date_docno($startDate, $endDate, $startDocNo, $endDocNo);
        foreach ($transactions as $transaction) {
            $fileName = 'wht-' . $transaction->CustomerCode . '-' . $transaction->TransactionDate . '.xlsx';

            $outputFile = $outputPath . $fileName;

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
        }

        redirect(base_url('Report/whtCriteria'));
    }
}
