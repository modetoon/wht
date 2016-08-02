<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in')){
		function is_logged_in() {

				  $CI =& get_instance();

					/*
				   $data = array(
									   'user_id'  => '1',
									   'user_name'  => 'modetoon',
									   'email'     => 'natthaphol@gmail.com',
									   'logged_in' => TRUE
								   );
				  $CI->session->set_userdata($data);
				  */
				  
				  $user_id = $CI->session->userdata('user_id');
				  if ((isset($user_id)) && ($user_id != '')) { 
						 return true; 
				  } 
				 else 
				 { 
						redirect(site_url('login'));
				 }
		}
}

?>  