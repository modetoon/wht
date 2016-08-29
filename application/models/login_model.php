<?php

    class Login_model extends CI_Model {
	protected $table_name = 'user';
	protected $primary_key = 'UserID';
	function __construct() {
	    // Call the Model constructor
	    parent::__construct();
	    $this->load->database();
	}
	function get_data($username = '') {
	    $Status = 1;
	    $this->db->where('UserName', $username)->where('Status', $Status);
	    $this->db->limit(1);
	    return $this->db->get($this->table_name)->row();
	}
    }

?>