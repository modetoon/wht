<?php

class Menu_model extends CI_Model {
	
	protected $table_name = 'menu';
	protected $primary_key = 'MenuID';
    protected $parent_key = 'Parent';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();

    }
    
    function get_menu()
    {
        $sql = "SELECT M2.MenuNameEN as ParentMenuName, M1.MenuID, M1.MenuNameEN as MenuName FROM ".$this->table_name." M1 LEFT JOIN ".$this->table_name." M2 ON M1.Parent = M2.MenuID ORDER BY M1.Parent, M1.Position"; 
        $query = $this->db->query($sql);        
        return $query->result();
    }

    function get_menu_parent($parent=0)
    {

        $sql = "SELECT * FROM ".$this->table_name." WHERE Parent = ? AND Status = 1"; 
        $query = $this->db->query($sql, array($parent));
        //$query = $this->db->get_where($this->table_name, array($this->parent_key => $parent))->row();
        return $query->result();
    } 
    
    function get_data($id)
    {

        $this->db->where($this->primary_key, $id);
        $this->db->limit(1);
        return $this->db->get($this->table_name)->row();
    } 

    function delete_menu($id){

        $this->db->where('MenuID', $id);
        $this->db->delete($this->table_name);
    }

    function get_menu_structure($selected=''){
        //$this->db->where('parent',$parent);
        $this->db->order_by('Position','asc');
        $this->db->select('*')->from($this->table_name);
        $q=$this->db->get();
        foreach($q->result() as $r){
            
            $data[$r->Parent][] = $r;
        }
        $menu=$this->build_menu($data, 0,$selected); // From Parent ID 1
        return $menu;
    } 
    
    
    function build_menu($category, $parent,$selected=0){
        static $i = 1;
        $path = '';
        if (array_key_exists($parent, $category)) {
            $menu = ($parent != 0) ? '': '<select class="form-control" name="Parent"><option value="">Please select';
            $i++;
            foreach ($category[$parent] as $r) {
                $child = $this->build_menu($category, $r->MenuID);
                $level_str = "";
                if($parent != 0){
                    $level_str = str_repeat("&nbsp;&nbsp;",$r->Level);
                    $level_str .= "|--";
                }
                $cls = ($selected == $r->MenuID) ? 'selected': '';
                $menu .= '<option value="'.$r->MenuID.'" '.$cls.'>'.$level_str.$r->MenuNameEN;
                if ($child) {
                    $i--;
                    $menu .= $child;
                }
                $menu .= '</option>';
            }
            $menu .= ($parent != 0) ? '': '</select>';
            return $menu;
        } else {
            return false;
        }
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