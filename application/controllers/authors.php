<?php
class Authors extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Author', 'author');
	}

	public function index() {
		$this->template->set_layout('default')
			->title('Book Catelog', 'Authors')
			->build('authors/index', array(
				'data' => $this->author->getAll()
			));
	}

	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');

		$this->validation->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
			->title('Book Catelog', 'Create Authors')
			->build('authors/create');
		} else {
			$this->author->create(array(
				'name' => $this->input->post('name'),
				'date_created' => date('Y-m-d')
			));
			redirect('authors/index');
		}
	}

	public function edit($id) {
		$author = $this->author->getOne($id);

		if (empty($author)) {
			$this->session->set_flashdata('error', 'Author does not exist!');
			redirect('admin/authors/index');
		}

		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');
		
		$this->validation
			->set_error_delimiters('<span class="error">', '</span>')
			->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
				->title('Book Catelog', 'Edit Authors')
				->build('authors/edit', array('author' => $author));
		} else {
			$id = $this->input->post('id');

			$this->author->update($id, array(
				'name' => $this->input->post('name'),
				'date_modified' => date('Y-m-d')
			));
			redirect('authors/index');
		}
	}

	public function delete($id) {
		$author = $this->author->getOne($id);

		if (empty($author)) {
			$this->session->set_flashdata('error', 'Author does not exist!');
			redirect('authors/index');
		}

		$this->author->delete($id);
		redirect('authors/index');
	}
}