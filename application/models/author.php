<?php

class Author extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function getAll() {
		$query = $this->db
			->select('id, name, date_created, date_modified')
			->get('authors');
		return $query->result_array();
	}
	function getOne($id) {
		$query = $this->db
			->select('id, name, date_created, date_modified')
			->where('id', $id)
			->get('authors');
		return $query->row_array();
	}

	function create($author) {
		$this->db->insert('authors', $author);
	}

	function update($id, $author) {
		$this->db->where('id', $id)->update('authors', $author);
	}

	function delete($id) {
		$this->db->where('id', $id)->delete('authors');
	}
}