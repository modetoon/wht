<?php

class Customer_model extends CI_Model {
	
	protected $table_name = 'customer';
	protected $primary_key = 'CustomerID';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
    
    function get_lists()
    {
        $sql = "SELECT * FROM ".$this->table_name." ORDER BY ".$this->primary_key." DESC"; 
        $query = $this->db->query($sql);        
        return $query->result();
    }
    
    function get_data($id)
    {

        $this->db->where($this->primary_key, $id);
        $this->db->limit(1);
        return $this->db->get($this->table_name)->row();
    } 

    function delete($id){

        $this->db->where($this->primary_key, $id);
        $this->db->delete($this->table_name);
    }

    function insert_data($data){

		$this->db->insert($this->table_name, $data);

    }
    
    function update_data($data,$id){
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name, $data);     
    }


}

?>