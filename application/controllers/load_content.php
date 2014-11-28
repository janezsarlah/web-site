<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Load_content extends CI_Controller {
	/**
	* Auto load model involving slides
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->load->model('model_slides');
		$this->load->model("model_gallery");
		$this->load->model("model_gallery_type");
	}

	public function index() {
		$this->load_all();
	}

	/**
	* Load all the images (slider and gallery)
	*
	* @return void
	*/
	public function load_all() {
		$data['slides'] = $this->model_slides->getAllSlides();
		$data['gallery'] = $this->model_gallery->getImages(null, null);
		$data['gallery_type'] = $this->model_gallery_type->getGalleryTypes();
		$data['title'] = "Design :: Klemen";
		
		$this->load->view("view_web_site", $data);
	}
}