<?php

class Transaction_model extends CI_Model {

    protected $table_name = 'transaction';
    protected $primary_key = 'TransactionID';
    protected $customer_table_name = 'customer';
    protected $expensetype_table_name = 'expense_type';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_lists() {
        $sql = "SELECT * FROM " . $this->table_name . " ORDER BY " . $this->primary_key . " DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_data($id) {
        $this->db->where($this->primary_key, $id);
        $this->db->limit(1);
        return $this->db->get($this->table_name)->row();
    }

    public function delete($id) {

        $this->db->where($this->primary_key, $id);
        $this->db->delete($this->table_name);
    }

    public function insert_data($data) {
        $this->db->insert($this->table_name, $data);
    }

    public function update_data($data, $id) {
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name, $data);
    }

    public function get_customer_dd($selected = '') {
        $this->db->order_by('FullNameThai', 'asc');
        $this->db->select('*')->from($this->customer_table_name);
        $q = $this->db->get();
        $html = '';
        $html .= '<select class="form-control" name="CustomerID" id="CustomerID"><option value="">Please select';
        foreach ($q->result() as $r) {
            $cls = ($selected == $r->CustomerID) ? 'selected' : '';
            $html .= '<option value="' . $r->CustomerID . '" ' . $cls . '>' . $r->FullNameThai;
        }
        $html .= '</select>';
        return $html;
    }

    public function get_expensetype_dd($selected = '') {
        $this->db->order_by('Percent', 'asc');
        $this->db->select('*')->from($this->expensetype_table_name);
        $q = $this->db->get();
        $html = '';
        $html .= '<select class="form-control" name="ExpenseTypeID" id="ExpenseTypeID"><option value="">Please select';
        $arrTmp = explode('|', $selected);
        foreach ($q->result() as $r) {
            $cls = ($arrTmp[0] == $r->ExpenseTypeID) ? 'selected' : '';
            $html .= '<option value="' . $r->ExpenseTypeID . '|' . $r->Percent . '" ' . $cls . '>' . $r->ExpenseTypeName . ' (' . $r->Percent . ')';
        }
        $html .= '</select>';
        return $html;
    }

    public function get_docno() {
        $nums_row = $this->db->count_all($this->table_name);
        $thisYear2Digit = date('y') + 43;
        if ($nums_row > 0) {
            $query = $this->db->query("SELECT DocNo FROM " . $this->table_name . " ORDER BY TransactionID DESC LIMIT 0,1");
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $DocNo = $row['DocNo'];
                $arrTmp = explode('/', $DocNo);
                $max_transaction_id = (int) $arrTmp[1];
                $max_transaction_id++;
                $transaction_id = sprintf('%05d', $max_transaction_id);
                $transaction_id = $thisYear2Digit . '/' . $transaction_id;
            }
        } else {
            $max_transaction_id = 1;
            $transaction_id = sprintf('%05d', $max_transaction_id);
            $transaction_id = $thisYear2Digit . '/' . $transaction_id;
        }
        return $transaction_id;
    }

    public function get_first_last_doc_no_by_date($startDate, $endDate) {
        $results = array(
            'startDocNo' => '',
            'endDocNo' => ''
        );

        $sql = "   SELECT      `DocNo`   ";
        $sql .= "   FROM        `transaction` ";
        $sql .= "   WHERE       `TransactionDate` >= '" . $startDate . "'";
        $sql .= "   AND         `TransactionDate` <= '" . $endDate . "'";
        $sql .= "   ORDER BY    DocNo";
        $sql_desc = " DESC ";
        $sql_asc = " ASC ";
        $sql_limit = " LIMIT 1";

        $lastSql = $sql . $sql_asc . $sql_limit;
        $query = $this->db->query($lastSql);
        if ($query->num_rows() > 0)
            $results['startDocNo'] = $query->row()->DocNo;

        $lastSql = $sql . $sql_desc . $sql_limit;
        $query = $this->db->query($lastSql);
        if ($query->num_rows() > 0)
            $results['endDocNo'] = $query->row()->DocNo;

        return $results;
    }

    public function get_data_by_date_docno($startDate, $endDate, $startDocNo, $endDocNo) {
        $selection = array(
            'transaction.TransactionID', 'transaction.DocNo', 'transaction.CustomerID',
            'transaction.Amount', 'transaction.TaxAmount', 'transaction.NetAmount', 'transaction.TransactionDate',
            'transaction.ExpenseTypeID', 'transaction.Condition', 'transaction.Printed',
            'customer.CustomerCode', 'customer.Version', 'customer.Type', 'customer.FullNameThai',
            'customer.FullNameEnglish', 'customer.IDCard', 'customer.TaxNumber', 'customer.Address',
            'expense_type.ExpenseTypeID', 'expense_type.ExpenseTypeName', 'expense_type.Wht_Type'
        );
        $this->db->select($selection)
                ->join('customer', 'transaction.CustomerID = customer.CustomerID')
                ->join('expense_type', 'transaction.ExpenseTypeID = expense_type.ExpenseTypeID');

        if ($startDate != '') $this->db->where('transaction.TransactionDate >= ', $startDate);
        if ($endDate != '') $this->db->where('transaction.TransactionDate <= ', $endDate);

        if ($startDocNo != '') $this->db->where('transaction.DocNo >= ', $startDocNo);
        if ($endDocNo != '') $this->db->where('transaction.DocNo <= ', $endDocNo);

        return $this->db->get($this->table_name)->result();
    }

}
