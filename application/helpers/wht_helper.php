<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_customer_name')) {

    function get_customer_name($cust_id = '') {
        $ci = & get_instance();
        $ci->load->database();
        $query = $ci->db->query("SELECT FullNameThai FROM customer WHERE CustomerID = '" . $cust_id . "'");
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row['FullNameThai'];
        }
    }

}
?>  