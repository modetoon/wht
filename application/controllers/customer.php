<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {
    function __construct() {
        // Call the Model constructor

        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->model('customer_model');

        is_logged_in();
    }

    public function index() {
        $data = array('title' => 'Listing');

        $this->load->view('header', $data);
        $this->load->view('customer/lists');
    }

    public function lists() {
        $data['title'] = 'Customer List';

        $res = $this->customer_model->get_lists();
        $data['result'] = $res;
        
        $this->load->view('header', $data);
        $this->load->view('customer/lists', $data);
    }

    public function add($id = '') {
        $this->load->model('Customer_model');
        $data['title'] = 'Add Customer';

        $selected = '';
        $selected2 = '';
        if ($id != '') {
            $result = $this->Customer_model->get_data($id);
            $data['result'] = $result;
        }

        $this->form_validation->set_rules('Type', 'Customer Type', 'required');
        $this->form_validation->set_rules('FullNameThai', 'FullNameThai', 'required|min_length[3]');
        $this->form_validation->set_rules('IDCard', 'ID Card', 'required|exact_length[13]');
        $this->form_validation->set_rules('TaxNumber', 'Tax Number', 'required|min_length[1]');
        $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|min_length[5]');
        $this->form_validation->set_rules('Phone', 'Phone', 'required');
        $this->form_validation->set_rules('Address', 'Address', 'min_length[5]');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('header', $data);
            $this->load->view('customer/add', $data);
        } else {
            if ($this->input->post('ID') == '') {
                $data_insert = array(
                    'Type' => $this->input->post('Type'),
                    'FullNameThai' => $this->input->post('FullNameThai'),
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
            } else {
                $data_insert = array(
                    'Type' => $this->input->post('Type'),
                    'FullNameThai' => $this->input->post('FullNameThai'),
                    'IDCard' => $this->input->post('IDCard'),
                    'TaxNumber' => $this->input->post('TaxNumber'),
                    'Email' => $this->input->post('Email'),
                    'Phone' => $this->input->post('Phone'),
                    'Address' => $this->input->post('Address'),
                    'UpdatedDate' => date('Y-m-d'),
                    'UpdatedBy' => $this->session->userdata('user_name'),
                    'Status' => $this->input->post('Status')
                );
                $result = $this->Customer_model->update_data($data_insert, $this->input->post('ID'));
            }

            redirect(site_url('customer/lists'), 'refresh');
        }
    }

    public function delete($id = '') {
        $this->Customer_model->delete($id);
        redirect(site_url('customer/lists'), 'refresh');
    }

    public function importExcel() {
        $data['title'] = 'Import Transaction from Excel';
        $this->load->view('header', $data);
        $this->load->view('customer/import_excel', $data);
    }

    public function processImport() {
        $file = $_FILES['file']['tmp_name'];
        $this->load->library('excel');
        $oPhpExcel = PHPExcel_IOFactory::load($file);
        $sheet = $oPhpExcel->getActiveSheet(0);
        $maxRow = $sheet->getHighestRow();
        $maxColumn = $sheet->getHighestColumn();

        $curDateTime = date('Y-m-d H:i:s');
        
        $this->db->trans_begin();
        for ($row = 2; $row <= $maxRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $maxColumn . $row, NULL, TRUE, FALSE);

            $customerCode = $rowData[0][0];
            $version = $rowData[0][1];
            $englishName = $rowData[0][2];
            $thaiName = $rowData[0][3];
            $street = $rowData[0][4];
            $District = $rowData[0][5];
            $subDistrict = $rowData[0][6];
            $province = $rowData[0][11];
            $zipCode = $rowData[0][7];
            $country = $rowData[0][8];

            $address = $street . " " . $subDistrict . " " . $District . " " . $province . " " . $zipCode;

            // Insert New Customer or Update Customer
            // --------------------------------------
            $customer = $this->customer_model->get_data_by_customer_code($customerCode);
            if (empty($customer)) {
                $data = array(
                    "CustomerCode" => "$customerCode",
                    "Version" => "$version",
                    "Type" => "",
                    "FullNameThai" => "$thaiName",
                    "FullNameEnglish" => "$englishName",
//                    "IDCard" => "",
//                    "TaxNumber" => "",
//                    "Phone" => "",
//                    "Email" => "",
                    "Address" => "$address",
                    "CreatedDate" => $curDateTime,
                    "CreatedBy" => "",
                    "status" => 1
                );

                $this->customer_model->insert_data($data);
                
            } else {
                $data = array();
                if ($customer['CustomerCode'] == "")
                    $data['CustomerCode'] = "$customerCode";
                if ($customer['Version'] == "") $data['Version'] = "$version";
                if ($customer['Type'] == "") $data['Type'] = "";
                if ($customer['FulllNameThai'] == "")
                    $data['FulllNameThai'] = "$thaiName";
                if ($customer['FullNameEnglish'] == "")
                    $data['FullNameEnglish'] = "$englishName";

//                if ($customer['IDCard'] == "") $data['IDCard'] = "$idCard";
//                if ($customer['TaxNumber'] == "") $data['TaxNumber'] = "$taxNumber";
//                if ($customer['Phone'] == "") $data['Phone'] = "$phone";
//                if ($customer['Email'] == "") $data['Email'] = "$email";
                
                if ($customer['Address'] == "")
                    $data['Address'] = "$address";
                $data['UpdatedDate'] = $curDateTime;
                $data['UpdatedBy'] = "";
                $data['Status'] = 1;

                $this->customer_model->update_data_by_customer_code($data, $customerCode);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        
        redirect(base_url('Customer/importexcel'));
    }
}
