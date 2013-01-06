<?php

class Category extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getAll() {
		$query = $this->db
							->select('id, name, date_created, date_modified')
							->get('categories');

		return $query->result_array();
	}

	function getOne($id) {
		$query = $this->db
							->select('id, name, date_created, date_modified')
							->where('id', $id)
							->get('categories');

		return $query->row_array();
	}

	function create($category) {
		$this->db->insert('categories', $category);
	}

	function update($id, $category) {
		$this->db->where('id', $id)->update('categories', $category);
	}

	function delete($id) {
		$this->db->where('id', $id)->delete('categories');
	}
}