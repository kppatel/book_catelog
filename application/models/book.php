<?php
class book extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function getAll() {
		$query = $this->db
			->select('b.id, b.title, b.rating, at.name AS author, ct.name AS category, b.reading_status')
			->join('authors at', 'b.author_id = at.id')
			->join('categories ct', 'b.category_id = ct.id')
			->get('books b');
		return $query->result_array();
	}

	function getOne($id) {
		$query = $this->db
			->select('id, title, author_id, category_id, reading_status')
			->where('id', $id)
			->get('books');
		return $query->row_array();
	}

	function update($id, $book)
	{
		$this->db->where('id', $id)->update('books', $book);
	}

	function create($book) {
		$this->db->insert('books', $book);
	}

	function delete($id) {
		$this->db->where('id', $id)->delete('books');
	}

	function getSearchResult($name, $author) {
		$query = $this->db
			->select('b.title, b.rating, at.name AS author, ct.name AS category, b.reading_status')
			->join('authors at', 'b.author_id = at.id')
			->join('categories ct', 'b.category_id = ct.id');

			if (!empty($author)) {
				$this->db->like('b.author_id', $author);

				if(!empty($name)) {
					$this->db->or_like('title', $name);
			}
			else {
				$this->db->like('title', $name);
			}
			$query=  $this->db->get('books b');
			return $query->result_array();
		}
}
}
?>