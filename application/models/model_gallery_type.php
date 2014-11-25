<?php 
	
class Model_gallery_type extends CI_Model {

	/**
	* Get all gallery types
	*
	* @return array
	*/
	public function getGalleryTypes() {

		$this->db->select("DISTINCT(gallery_type.id)");
		$this->db->select("gallery_type.type");
		$this->db->select("gallery.id_gallery_type");
		$this->db->from("gallery_type");
		$this->db->join("gallery", "gallery_type.id=gallery.id_gallery_type", "left");
		$this->db->order_by("gallery_type.id", "ASC");

		$query = $this->db->get();
		
		return $query->result();
	}

	/**
	* Save new type
	*
	* @return boolean
	*/
	public function addType($name) {
		if($this->db->insert("gallery_type", $name))
			return true;
		else
			return false;
	}

	/**
	* Update type based on its id
	*
	* @param array $save_data
	* @param int $type_id
	* @return void
	*/
	public function updateType($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('gallery_type', $data);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	/**
	* Delite selected type
	*
	* @param int $type_id
	* @return boolean
	*/
	public function delete_type($id) {
		$this->db->where('id', $id);
		$this->db->delete('gallery_type');

		if($this->db->affected_rows() > 0)
		    return true;
		else
			return false;
	}

	/**
	* Checks if gallery type can be delete
	*
	* @param int $type_id
	* @return boolean 
	*/
	public function check_if_can_delete($id) {
		$this->db->select("id");
		$this->db->from("gallery");
		$this->db->where("id_gallery_type", $id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return false;
		else
			return true;
	}

	/**
	* Get type by id
	*
	* @param int $type_id
	* @return array
	*/
	public function getTypeById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('gallery_type');

		foreach ($query->result() as $row) {
			return $row->type; 
		}
	}
}