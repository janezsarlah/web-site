<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slides extends CI_Controller {
	/**
	* Auto load model involving slides
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->load->model('model_slides');

		if(!$this->session->userdata('is_logged_in')){
            redirect('user/login');
        }
	}

	public function index() {
		$this->load_slides();
	}

	/**
	* Load all slides from database
	*
	* @return void
	*/
	public function load_slides() {
		$data['slides'] = $this->model_slides->getAllSlides();
		$data['title'] = "Admin panel";
		$data['main_content'] = "admin/view_admin_panel_slides";
		$this->load->view("admin/template", $data);
	}

	/**
	* Add new slide to the database
	*
	* @return vodi
	*/
	public function add_new_slide() {

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
			if ($this->form_validation->run()) {
				ini_set('memory_limit', '200M' );
				ini_set('upload_max_filesize', '200M');  
				ini_set('post_max_size', '200M');  
				ini_set('max_input_time', 3600);  
				ini_set('max_execution_time', 3600);

				$config = array(
					'upload_path'     => "./assets/slides/",
			        'upload_url'      => base_url() . "assets/slides/",
			        'allowed_types'   => "gif|jpg|png|jpeg",
			        'max_size'        => "5000",
			        'max_height'      => "4000",
			        'max_width'       => "4000"  
				);
				
				$this->load->library('upload', $config);
			
				if ($this->upload->do_upload("upload_image")) {
					
					$image_data = $this->upload->data();

					$data = array(
						'name'			=> $this->input->post('name'),
						'slide_path'	=> 'assets/slides/' . $image_data['file_name'],
						'fk_id_user'	=> $this->session->userData("is_logged_in")
					);

					if($this->model_slides->addSlide($data))
						$data['flash_message'] = TRUE; 
			        else
						$data['flash_message'] = FALSE; 
				} 
			}
		}


		$data['title'] = "Admin panel :: Add";
		
		$data['main_content'] = "admin/view_slides_add";
		
		$this->load->view("admin/template", $data);
	}

	/**
	* Remove slide from the database
	*
	* @return vodi
	*/
	public function remove_slide() {

		$id = $this->uri->segment(4);

		$slide_data = $this->model_slides->getSlideById($id);

		foreach ($slide_data as $row) {
			$data['slide_path'] = LOCAL_UPLOAD_PATH.$row->slide_path;
		}

		if($this->model_slides->deleteSlideById($id, $data['slide_path'])) {
			$this->session->set_flashdata('flash_message', 'success');
			chmod($data['slide_path'], 0777);
			if(is_writable($data['path_small'])) {
				unlink($data['path_small']);
			} else {
				echo "small not";die();	
			}
		} else { 
			$this->session->set_flashdata('flash_message', 'error');
		}

		redirect("admin/slides");
	}
}