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
							->select('id, title, author_id, category_id, rating, reading_status')
							->where('id', $id)
							->get('books');

		return $query->row_array();
	}

	function update($id, $book) {
		$this->db->where('id', $id)->update('books', $book);
	}

	function create($book) {
		$this->db->insert('books', $book);
	}

	function delete($id) {
		$this->db->where('id', $id)->delete('books');
	}

	function getSearchResult($title, $author_id, $category_id) {
		$query = $this->db
							->select('b.title, b.rating, at.name AS author, ct.name AS category, b.reading_status')
							->join('authors at', 'b.author_id = at.id')
							->join('categories ct', 'b.category_id = ct.id');

		if (!empty($title)) {
			$query->like('b.title', $title);
		}

		if($category_id != '0') {
			$query->where('b.category_id', $category_id);
			if ($author_id != '0') {
			$query->or_where('b.author_id', $author_id);
			}
		}
		else if($category_id != '0' AND $author_id != '0'){
			$query->where('b.author_id', $author_id);
		}
		$r = $query->get('books b');
		return $r->result_array();
	}
	
	function changeStatus($id,$status) {
		$this->db->where('id',$id)->update('books',array('reading_status' => $status));
	}
}