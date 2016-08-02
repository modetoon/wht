<?php

class User_model extends CI_Model {
	
	protected $table_name = 'user';
	protected $primary_key = 'UserID';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
    
    function get_lists()
    {
        $sql = "SELECT * FROM user ORDER BY UserID DESC"; 
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

		$this->db->where('UserName ', $data['UserName']);
			$query = $this->db->get($this->table_name);
			if($query->num_rows <= 0)
			{
				$this->db->insert($this->table_name, $data);
			}
			else
			{
				return false;
			}

        
    }
    
    function update_data($data,$id){
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name, $data);     
    }


}

?>