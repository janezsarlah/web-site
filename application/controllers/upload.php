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

			$resSettings = $this->resizeSettings($image_data);
			
			// Resize image 
			$config = array(
				'image_library' 	=> 'gd2',
				'source_image'		=> $image_data['full_path'],
				'create_thumb'		=> TRUE,
				'maintain_ratio'	=> TRUE,
				'width'				=> $resSettings['res_w']
			);

			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);

			if(!$this->image_lib->resize()) {
				$this->session->set_flashdata("upload_error", $this->upload->display_errors('<p>', '</p>'));
				redirect("user/adminpanel");
			}

			$this->load->library('image_lib', $config);
			unset($config);

			$image_size = getimagesize($image_data['file_path'] . $image_data['raw_name'] . '_thumb' . $image_data['file_ext']);
			
			// Crop image
			$config = array(
				'image_library' 	=> 'gd2',
				'source_image'		=> $image_data['file_path'] . $image_data['raw_name'] . '_thumb' . $image_data['file_ext'],
				'create_thumb'		=> FALSE,
				'maintain_ratio'	=> FALSE,
				'width'				=> $resSettings['crop_w'],
				'height'			=> $resSettings['crop_h'],
				'x_axis'			=> (($image_size[0] - $resSettings['crop_w']) / 2),
				'y_axis'			=> (($image_size[1] - $resSettings['crop_h']) / 2)
			);

			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);

			if(!$this->image_lib->crop()) {
				$this->session->set_flashdata("upload_error", $this->upload->display_errors('<p>', '</p>'));
				redirect("user/adminpanel");
			}

			$this->load->model("model_gallery");

			

			$data = array(
				'title'				=> $image_data['raw_name'],
				'path_small'		=> 'assets/uploads/' . $image_data['raw_name'] . "_thumb" . $image_data['file_ext'],
				'path_original'		=> 'assets/uploads/' . $image_data['orig_name'],
				'post_date'			=> date('Y-m-d H:i:s'),
				'id_user'			=> $this->session->userData("is_logged_in"),
				'id_gallery_type'	=> $this->model_gallery->getTypeId($this->input->post()["galleryType"])			
			);


			$this->load->model("model_gallery");
			if(!$this->model_gallery->addImage($data)) {
				$this->session->set_flashdata("upload_error", ('<p>Cant upload to DB.</p>'));
				redirect("user/adminpanel");
			}

			$this->session->set_flashdata("upload_success", "Your image has been uploaded successfully.");
			redirect("user/adminpanel");

		} else {
			$this->session->set_flashdata("upload_error", $this->upload->display_errors('<p>', '</p>'));
			redirect("user/adminpanel");
		}
	}	

	// Getiation optionsng image information and returning manipul
	public function resizeSettings($image) {
		$settings['old_w'] = $image['image_width'];
		$settings['old_h'] = $image['image_height'];

		if($image['image_width'] > $image['image_height']) {
			echo "Landscape<br/>";
			$settings['res_w'] = 600;
			$settings['res_h'] = 400;
			$settings['crop_w'] = 360;
			$settings['crop_h'] = 240;
		} else {
			echo "Portrate";
			$settings['res_w'] = 400;
			$settings['res_h'] = 600;
			$settings['crop_w'] = 270;
			$settings['crop_h'] = 390;
		}

		if($this->scaleHeight($settings) >= $settings['crop_h']) {
			return $settings;
		} else {
			$settings['res_w'] = $this->scaleWidth($settings);
			return $settings;
		}
	}

	// Scale image return=width
	public function scaleWidth($settings) {
		return $settings['old_w']/$settings['old_h']*$settings['res_h'];
	}

	// Scale image return=height
	public function scaleHeight($settings) {
		return $settings['old_h']/$settings['old_w']*$settings['res_w']; 
	}
}