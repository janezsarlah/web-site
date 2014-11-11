<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	public function index() {
		$this->loadGallery();
	}

	public function loadGallery() {


		$this->load->model("model_gallery");
		$data['gallery'] = $this->model_gallery->getImages();
		$data['gallery_type'] = $this->model_gallery->getGalleryTypes();
		

		$this->load->view("view_web_site", $data);
	}
}