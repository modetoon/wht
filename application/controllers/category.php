<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Category_model');

    }

	public function index()
	{
		$data = array('title'=> 'Listing');

		$this->load->view('header', $data);
		$this->load->view('category/lists');
	}

	public function lists()
	{
		$data['title'] = 'Category List';

		$res = $this->Category_model->get_category();
		$data['result'] = $res;

		$this->load->view('header', $data);
		$this->load->view('category/lists', $data);
	}

	public function add($id='')
	{
		$data['title'] = 'Add Category';

		$selected = '';
		if($id!=''){
			$result = $this->Category_model->get_data($id);
			$data['result'] = $result;
			$selected = $result->Parent;
		}
		$main_menu = $this->Category_model->get_menu_structure($selected);
		$data['menu_dropdownlist'] = $main_menu;	

		$this->form_validation->set_rules('Parent', 'Parent Category', 'required');
		$this->form_validation->set_rules('CategoryNameTH', 'Category Name (TH)', 'required|min_length[1]');
		$this->form_validation->set_rules('CategoryNameEN', 'Category Name (EN)', 'required|min_length[1]');
		$this->form_validation->set_rules('Position', 'Position', 'required|numeric');

		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('header', $data);
			$this->load->view('category/add', $data);

		}
		else
		{

			$_data = $this->Category_model->get_data($this->input->post('Parent'));
			$next_level = $_data->Level + 1;
			$data_insert = array(
				'Parent' => $this->input->post('Parent'),
				'Level' => $next_level,
				'CategoryNameEN' => $this->input->post('CategoryNameEN'),
				'CategoryNameTH' => $this->input->post('CategoryNameTH'),
				'Position' => $this->input->post('Position'),
				'Status' => $this->input->post('Status')
			);
			if($this->input->post('ID') == '')
			{
				$main_menu = $this->Category_model->insert_data($data_insert);
			}
			else
			{
				$main_menu = $this->Category_model->update_data($data_insert,$this->input->post('ID'));
			}
			redirect(site_url('category/lists'), 'refresh');
		}

	}	

	public function delete($id='')
	{
		$this->Category_model->delete($id);
		redirect(site_url('category/lists'), 'refresh');

	}

}
