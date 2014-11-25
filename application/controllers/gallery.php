<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	public function index() {
		$this->loadGallery();
	}

	public function loadGallery() {

		$this->load->model("model_gallery");
		$this->load->model("model_gallery_type");
		$data['gallery'] = $this->model_gallery->getImages(null, null);
		$data['gallery_type'] = $this->model_gallery_type->getGalleryTypes();
		$data['title'] = "Design :: Klemen";
		
		$this->load->view("view_web_site", $data);
	}

	public function test() {
		$this->load->view("admin/old");
	}

	public function bla() {
		echo $this->input->post("uploadImage");
		die();
	}
}