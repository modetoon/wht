<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logoff extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		   $data = array(
							   'user_id'  => '',
							   'user_name'  => '',
							   'user_fullname_Thai'  => '',
							   'email'     => '',
							   'logged_in' => FALSE
						   );

		$this->session->unset_userdata($data);
		redirect(site_url('login'));
	}


}
