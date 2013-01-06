
<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class books extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Book', 'book');
		$this->load->model('Author', 'author');
		$this->load->model('Category', 'category');
	}

	public function index() {
		$this->load->helper('form');

		$this->template->set_layout('default')
			->title('Book Catelog', 'Books')
			->build('books/index', array(
				'data' => $this->book->getAll()
			)
		);
	}

	public function create() {
		$data = array(
			'author' => $this->assoc2numeric($this->author->getAll()),
			'category' => $this->assoc2numeric($this->category->getAll())
		);

		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');

		$this->validation
			->set_rules('name', 'Name', 'trim|ucfirst|required')
			->set_rules('category', 'Category', 'trim|required')
			->set_rules('status', 'Status', 'trim|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
				->title('Book Catelog', 'Create Book')
				->build('books/create', $data);
		} else {
			$book = array(
				'title' => $this->input->post('name'),
				'author_id' => $this->input->post('author'),
				'category_id' => $this->input->post('category'),
				'reading_status' => $this->input->post('status'),
				'date_created' => date('Y-m-d'),
				'rating' => $this->input->post('rating')
			);

			$this->book->create($book);
			redirect('books/index');
		}
	}

	public function edit($id) {
		$book = $this->book->getOne($id);

		if (empty($book)) {
			$this->session->set_flashdata('error', 'Book does not exist!');
			redirect('books/index');
		}

		$data = array(
			'author' => $this->assoc2numeric($this->author->getAll()),
			'category' => $this->assoc2numeric($this->category->getAll()),
			'book' => $book
		);

		$this->load->helper('form');
		$this->load->library('form_validation', null, 'validation');

		$this->validation->set_error_delimiters('<span class="error">', '</span>')
			->set_rules('name', 'Name', 'trim|ucfirst|required')
			->set_rules('status', 'Status', 'trim|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
				->title('Book Catelog', 'Edit Book')
				->build('books/edit', $data);
		} else {
			$book = array(
				'title' => $this->input->post('name'),
				'category_id' => $this->input->post('category'),
				'author_id' => $this->input->post('author'),
				'reading_status' => $this->input->post('status'),
				'rating' => $this->input->post('rating'),
				'date_modified' => date('Y-m-d')
			);

			$id = $this->input->post('id');
			$this->book->update($id, $book);
			redirect('books/index');
		}
	}

	public function delete($id) {
		$book = $this->book->getOne($id);

		if (empty($book)) {
			$this->session->set_flashdata('error', 'Book does not exist!');
			redirect('books/index');
		}

		$this->book->delete($id);

		//redirect('books/index');
	}

	public function search() {
		$this->load->helper('form');

		$data = array(
			'author' => $this->assoc2numeric($this->author->getAll()),
			'category' => $this->assoc2numeric($this->category->getAll()),
		);

		$data['author'] = array('Select Author') + $data['author'];
		$data['category'] = array('Select Category') + $data['category'];

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$name = $this->input->post('name');
			$author = $this->input->post('author');
			$category = $this->input->post('category');
			$data['results'] = $this->book->getSearchResult($name, $author, $category);
		}

		$this->template->set_layout('default')
			->title('Book Catelog', 'Search Book')
			->build('books/search', $data);
	}

	public function toggle($id, $status) {
		$this->book->changeStatus($id, $status);
		if(!$this->input->is_ajax_request()) {
			redirect('books/index');
		}

		echo $status == 'Unread' ? 'Read' : 'Unread';
	}

	private function assoc2numeric(array $assoc) {
		$numeric = array();

		foreach ($assoc as $a) {
			$numeric[$a['id']] = $a['name'];
		}

		return $numeric;
	}
}