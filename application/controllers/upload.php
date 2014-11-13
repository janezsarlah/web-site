<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function index() {
		
	}

	// Uploaded image
	public function uploadImage() {
		ini_set('memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);

		$config = array(
			'upload_path'     => "./assets/uploads/",
	        'upload_url'      => base_url() . "assets/uploads/",
	        'allowed_types'   => "gif|jpg|png|jpeg",
	        'overwrite'       => TRUE,
	        'max_size'        => "5000",
	        'max_height'      => "4000",
	        'max_width'       => "4000"  
		);
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload("uploadImage")) {

			$image_data = $this->upload->data();
			unset($config);

			$config = array(
				'image_library' 	=> 'gd2',
				'source_image'		=> $image_data['full_path'],
				'create_thumb'		=> TRUE,
				'maintain_ratio'	=> TRUE,
				'width'				=> 360,
				'height'			=> 240,
				'x_axis'			=> (($image_data['image_width'] - 360) / 2),
				'y_axis'			=> (($image_data['image_height'] - 240) / 2),
			); 


			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$this->image_lib->crop();

			$this->session->set_flashdata("upload_error", $this->upload->display_errors());
			redirect("user/adminpanel");

		}
		else {
			$this->session->set_flashdata("upload_error", $this->upload->display_errors());
			redirect("user/adminpanel");
		}
	}	
}