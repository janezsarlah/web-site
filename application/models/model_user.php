<?php 

class Model_User extends CI_Model {
	public function can_log_in() {
		$this->db->where("username", $this->input->post("username")); // Where username from database is equal to username from the post function
		$this->db->where("password", md5($this->input->post("password"))); 


		$query = $this->db->get("user"); // Pass in the table that you want to get. Query is nov an object 

		if($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
}


?>