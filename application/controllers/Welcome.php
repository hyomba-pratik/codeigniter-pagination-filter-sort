<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('pagination');
		$this->load->model('World_model');


		$config['base_url'] = base_url('welcome/index');
		
		$config['per_page'] = ($this->input->get('limitRows')) ? $this->input->get('limitRows') : 10;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;


		 // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
       
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$config['base_url'].'?per_page=0">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

		$data['page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$data['searchFor'] = ($this->input->get('query')) ? $this->input->get('query') : NULL;
		$data['orderField'] = ($this->input->get('orderField')) ? $this->input->get('orderField') : '';
		$data['orderDirection'] = ($this->input->get('orderDirection')) ? $this->input->get('orderDirection') : '';
		$data['citylist'] = $this->World_model->get_city($config["per_page"], $data['page'], $data['searchFor'], $data['orderField'], $data['orderDirection']);
		$config['total_rows'] = $this->World_model->count_city($config["per_page"], $data['page'], $data['searchFor'], $data['orderField'], $data['orderDirection']);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('welcome_message', $data);
	}

}
