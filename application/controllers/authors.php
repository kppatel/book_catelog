<?php
/* var_dump(mdate("%d-%m-%Y", time())); */
class Authors extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Author', 'author');
	}

	public function index()
	{
		$this->load->helper('assets');
		$this->load->helper('date');

		$data = array(
			'data' => $this->author->getAll(),
		);
		$this->template->set_layout('default')
			->title('Book Catelog', 'Authors')
			->build('authors/index', $data);
	}

	public function create()
	{
		$this->load->helper(array('form', 'assets', 'date'));
		$this->load->library('form_validation', null, 'validation');

		$this->validation->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
			->title('Book Catelog', 'Create Authors')
			->build('authors/create');
		} else {
			$author=array(
							'name' => $this->input->post('name'),
							'date_created' => mdate("%d-%m-%Y", time()),
							);
			$this->author->create($author);
			redirect('authors/index');
		}
	}

	public function edit($id)
	{
		$author = $this->author->getOne($id);

		if (empty($author)) {
			$this->session->set_flashdata('error', 'Author does not exist!');
			redirect('admin/authors/index');
		}

		$this->load->helper(array('form', 'assets', 'date'));
		$this->load->library('form_validation', null, 'validation');
		$this->validation->set_error_delimiters('<span class="error">', '</span>');

		$this->validation->set_rules('name', 'Name', 'trim|ucfirst|required');

		if ($this->validation->run() == false) {
			$this->template->set_layout('default')
			->title('Book Catelog', 'Edit Authors')
			->build('authors/edit', array('author' => $author));
		} else {
			$author=array(
							'name' => $this->input->post('name'),
							'date_modified' => mdate("%d-%m-%Y", time())
							);
			$id = $this->input->post('id');
			$this->author->update($id, $author);
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

?>
