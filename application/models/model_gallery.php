<?php 
	
class Model_gallery extends CI_Model {
	public function getImages() {
		$query = $this->db->query("SELECT g.title, g.path_small, g.path_original, g.post_date, gt.type FROM gallery AS g INNER JOIN gallery_type AS gt ON g.id_gallery_type=gt.id");
		return $query->result();
	}

	public function getGalleryTypes() {
		$query = $this->db->query("SELECT DISTINCT gt.type, g.id_gallery_type FROM gallery_type AS gt LEFT JOIN gallery AS g ON gt.id=g.id_gallery_type");
		return $query->result();
	}

	public function addImage($values) {
		$this->db->insert('gallery', $values); 
	}

	public function getTypeId($galleryType) {
		$query = $this->db->query("SELECT id FROM gallery_type WHERE type='". $galleryType . "';");
		if($query->row())
			return $query->row()->id;
		else
			return "";
	}
	
}

?>