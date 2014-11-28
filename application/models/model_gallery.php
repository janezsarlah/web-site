<?php 
	
class Model_gallery extends CI_Model {
	/**
	* Get all images limit
	*
	* @param int $id_gallery_type
	* @param string $order_parameter
	* @param string $order_parameter
	* @return array
	*/
	public function getImages($gallery_type=null, $order_col_name='post_date', $order_type='DESC') {
		$this->db->select('gallery.id');
		$this->db->select('gallery.position');
		$this->db->select('gallery.title');
		$this->db->select('gallery.path_small');
		$this->db->select('gallery.path_original');
		$this->db->select('gallery.post_date');
		$this->db->select('gallery_type.type');
		$this->db->from('gallery');

		if($gallery_type != null && $gallery_type != 0)
			$this->db->where("id_gallery_type", $gallery_type);

		$this->db->join('gallery_type', 'gallery.id_gallery_type=gallery_type.id', 'inner');
			
		if($order_col_name)
			$this->db->order_by($order_col_name, $order_type);
		
		$query = $this->db->get();

		return $query->result();
	}

	/**
	* Get image by its id 
	*
	* @param int $image_id
	* @return array
	*/
	public function getImageById($id) {
		$this->db->select('gallery.id');
		$this->db->select('gallery.position');
		$this->db->select('gallery.title');
		$this->db->select('gallery.path_small');
		$this->db->select('gallery.path_original');
		$this->db->select('gallery.post_date');
		$this->db->select('gallery.id_gallery_type');
		$this->db->from('gallery');

		$this->db->where('gallery.id', $id);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	* Get old image and update it (for correct positioning)
	*
	* @param int $id_gallery_type
	* @param int $image_position
	* @return array
	*/
	public function getOldImageById($gallery_type_id, $position) {
		$this->db->select('gallery.id');
		$this->db->select('gallery.position');
		$this->db->select('gallery.title');
		$this->db->select('gallery.path_small');
		$this->db->select('gallery.path_original');
		$this->db->select('gallery.post_date');
		$this->db->select('gallery.id_user');
		$this->db->select('gallery.id_gallery_type');
		$this->db->from('gallery');

		$this->db->where('id_gallery_type', $gallery_type_id);
		$this->db->where('gallery.position', $position);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	* Add new image to database
	*
	* @param array imageData
	* @return boolean
	*/
	public function addImage($values) {
		$this->db->insert('gallery', $values);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false; 
	}

	/**
	* Update image data
	*
	* @param int $user_id
	* @param array $values
	* @return boolean
	*/
	public function updateImage($id, $values) {
		$this->db->where("id", $id);
		$this->db->update("gallery", $values);
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	* Delete image from database
	*
	* @param int $id
	* @return boolean
	*/
	public function deleteImage($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('gallery');
		
		if($query->num_rows() > 0) {
		    $this->db->where('id', $id);
			$this->db->delete('gallery');
			return true;    
		} else {
			return false;
		}
	}

	/**
	* Get image that need to be repositioned
	*
	* @param int $gallery_id
	* @param int $image_position
	* @return array
	*/
	public function getForRepositioning($gallery_type, $position) {
		$this->db->select('id');
		$this->db->from('gallery');
		$this->db->where('id_gallery_type', $gallery_type);
		$this->db->where('position >', $position);

		$query = $this->db->get();

		return $query->result();
	}

	/**
	* Reposition the image
	*
	* @param int $image_id
	* @return
	*/
	public function repositionImages($id) {
		$this->db->query("UPDATE gallery  	
   					      SET position = position - 1
					      WHERE id = $id");
	}

	/**
	* Get the number of images in database
	*
	* @param int $id_type
	* @return int
	*/
	public function count_images($gallery_type_id) {
		$this->db->select('COUNT(id) AS count');
		$this->db->from('gallery');
		$this->db->where('id_gallery_type', $gallery_type_id);
		$query = $this->db->get();
		return $query->row()->count;
	}
}

?>