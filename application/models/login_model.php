<?php

class Login_model extends CI_Model {
	
	protected $table_name = 'user';
	protected $primary_key = 'UserID';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();

    }
    
    function get_data($username='')
    {

        $this->db->where('UserName', $username);
        $this->db->limit(1);
        return $this->db->get($this->table_name)->row();
    } 



}

?>