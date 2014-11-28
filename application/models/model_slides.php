<?php 
	
class Model_slides extends CI_Model {

	/**
	* Get all slides from database
	*
	* @return array
	*/
	public function getAllSlides() {
		$query = $this->db->get("slides");
	
		return $query->result();
	}

	/**
	* Get slide by its id
	*
	* @param int $slide_id
	* @return array
	*/
	public function getSlideById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('slides'); 

		return $query->result();
	}

	/**
	* Add new image for the slider to the databse
	*
	* @param array $data_to_store
	* @return boolean
	*/
	public function addSlide($data) {
		if($this->db->insert('slides', $data))
			return true;
		else
			return false;
	}

	/**
	* Remove slide image by its id
	*
	* @param int $slide_id
	* @param string $omage_path
	* @return boolean
	*/
	public function deleteSlideById($id, $slide_path) {
		$this->db->where('id', $id);
		$this->db->delete('slides'); 

		if($this->db->affected_rows() > 0) 
			return true;
		else
			return false;
	}
}
