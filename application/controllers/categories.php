<?php

class Categories extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Category', 'category');
	}

	public function index() {
		$this->load->helper('form');
		$this->template->set_layout('default')
			->title('Book Catelog', 'Category')
			->build('categories/index', array(
				'data' => $this->category->getAll()
			));
	}

	public function ajax_create() {
		if(!$this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] != 'POST') {
			header($_SERVER['SERVER_PROTOCOL'] . '404 Internal Server Error', true, 404);
			exit;
		}

		$name = $this->input->post('name');

		if (empty($name)) {
			header($_SERVER['SERVER_PROTOCOL'] . '500 Internal Server Error', true, 500);
			exit;
		}

		$id = $this->category->create(array(
			'name' => $name,
			'date_created' => date('Y-m-d')
		));

		$category = $this->category->getOne($id);
		echo json_encode($category);
		exit;
	}

	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');

		$this->validation->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
				->title('Book Catelog', 'Create Category')
				->build('categories/create');
		} else {
			$this->category->create(array(
				'name' => $this->input->post('name'),
				'date_created' => date('Y-m-d')
			));
			redirect('categories/index');
		}
	}

	public function edit($id) {
		$category = $this->category->getOne($id);

		if (empty($category)) {
			$this->session->set_flashdata('error', 'Category does not exist!');
			redirect('categories/index');
		}

		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');

		$this->validation->set_error_delimiters('<span class="error">', '</span>');
		$this->validation->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
				->title('Book Catelog', 'Edit Category')
				->build('categories/edit', array('category' => $category));
		} else {
			$id = $this->input->post('id');
			$this->category->update($id, array(
				'name' => $this->input->post('name'),
				'date_modified' => date('Y-m-d')
			));
			redirect('categories/index');
		}
	}

	public function delete($id) {
		$category = $this->category->getOne($id);

		if (empty($category)) {
			$this->session->set_flashdata('error', 'Category does not exist!');
			redirect('categories/index');
		}

		$this->category->delete($id);
		redirect('categories/index');
	}
}