<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Types extends CI_Controller {

	/**
	* Auto load model involving gallery
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->load->model('model_gallery_type');

		if(!$this->session->userdata('is_logged_in')){
            redirect('user/login');
        }
	}

	public function index() {
		$this->load_types();
	}

	/**
	* Load gallery tyes
	*
	* @return void
	*/
	public function load_types() {
		$data['title'] = "Admin palel";
		$data['galleryTypes'] = $this->model_gallery_type->getGalleryTypes();
		$data["main_content"] = "admin/view_admin_panel_type";
		$this->load->view("admin/template", $data);	
	}

	/**
	* Add new gallery type
	*
	* @return void
	*/
	public function add_new_type() {

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$type_name['type'] = $this->input->post('type');

			if($this->model_gallery_type->addType($type_name))
				$data['flash_message'] = TRUE; 
	        else
				$data['flash_message'] = FALSE; 

		}

		$data['title'] = 'Admin panel :: Add';

		$data['main_content'] = "admin/view_type_add";
		
		$this->load->view("admin/template", $data);
	}

	/**
	* Update gallery type
	*
	* @return void
	*/
	public function update_type() {
		$id = $this->uri->segment(4);

		$data['type'] = $this->model_gallery_type->getTypeById($id);

		
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$data['type'] = $this->input->post('type');

			$save_name = array(
				'type' => $this->input->post('type')
			);

			if($this->model_gallery_type->updateType($id, $save_name))
				$data['flash_message'] = TRUE; 
	        else
				$data['flash_message'] = FALSE; 

		}

		$data['title'] = 'Admin panel :: Update';

		$data['main_content'] = "admin/view_type_update";
		
		$this->load->view("admin/template", $data);
	}

	/**
	* Delete gallery type
	*
	* @return void
	*/
	public function delete_type() {
		$id = $this->uri->segment(4);

		if($this->model_gallery_type->check_if_can_delete($id)) {
			$this->model_gallery_type->delete_type($id);
			$this->session->set_flashdata('flash_message', 'success'); 
		} else {
			$this->session->set_flashdata('flash_message', 'error');
		}

		redirect("admin/types");
	}
}