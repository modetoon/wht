<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Menu_model');

    }

	public function index()
	{
		$data = array('title'=> 'Listing');

		$this->load->view('header', $data);
		$this->load->view('menu/lists');
	}

	public function lists()
	{
		$data['title'] = 'Menu List';

		$res = $this->Menu_model->get_menu();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('menu/lists', $data);
	}

	public function add($id='')
	{
		$data['title'] = 'Add Menu';

		$selected = '';
		if($id!=''){
			$result = $this->Menu_model->get_data($id);
			$data['result'] = $result;
			$selected = $result->Parent;
		}
		$main_menu = $this->Menu_model->get_menu_structure($selected);
		$data['menu_dropdownlist'] = $main_menu;	

		$this->form_validation->set_rules('Parent', 'Menu Parent', 'required');
		$this->form_validation->set_rules('MenuNameTH', 'Menu Name (TH)', 'required|min_length[1]');
		$this->form_validation->set_rules('MenuNameEN', 'Menu Name (EN)', 'required|min_length[1]');
		$this->form_validation->set_rules('Position', 'Position', 'required|numeric');	

		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('header', $data);
			$this->load->view('menu/add', $data);

		}
		else
		{

			$_data = $this->Menu_model->get_data($this->input->post('Parent'));
			$next_level = $_data->Level + 1;
			$data_insert = array(
				'Parent' => $this->input->post('Parent'),
				'Level' => $next_level,
				'MenuNameEN' => $this->input->post('MenuNameEN'),
				'MenuNameTH' => $this->input->post('MenuNameTH'),
				'Position' => $this->input->post('Position'),
				'Status' => $this->input->post('Status')
			);
			if($this->input->post('ID') == '')
			{
				$main_menu = $this->Menu_model->insert_data($data_insert);
			}
			else
			{
				$main_menu = $this->Menu_model->update_data($data_insert,$this->input->post('ID'));
			}

			redirect(site_url('menu/lists'), 'refresh');
		}

	}	

	public function delete($id='')
	{
		$this->Menu_model->delete_menu($id);
		redirect(site_url('menu/lists'), 'refresh');

	}

}
