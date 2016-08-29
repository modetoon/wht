<?php

    class customer_model extends CI_Model {
	protected $table_name = 'customer';
	protected $primary_key = 'CustomerID';
	public function __construct() {
	    // Call the Model constructor
	    parent::__construct();
	    $this->load->database();
	}
	public function get_lists($ordering = NULL) {
	    if (empty($ordering)) {
		$sql = "SELECT * FROM " . $this->table_name . " ORDER BY " . $this->primary_key . " DESC";
	    } else {
		$sql = "SELECT * FROM " . $this->table_name . " ORDER BY " . $ordering;
	    }
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
	public function update_data_by_customer_code($data, $customerCode) {
	    $this->db->where("CustomerCode", $customerCode)
		    ->update($this->table_name, $data);
	}
	public function number_records_by_customer_code($customerCode) {
	    $this->db->where('CustomerCode', $customerCode);

	    return $this->db->get($this->table_name)->num_rows();
	}
	public function get_data_by_customer_code($customerCode) {
	    $this->db->where('CustomerCode', $customerCode);

	    return $this->db->get($this->table_name)->row();
	}
    }
    