<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function index() {
		$this->login();
	}

	public function login() {
		$title["title"] = "Login :: Klemen";
		
		$this->load->view("admin/par_admin_home", $title);
		$this->load->view("admin/view_login");
		$this->load->view("admin/par_admin_footer");
	}


	public function validateLogin() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("username", "Username", "required|trim|xss_clean|callback_validate_credentials"); 
		$this->form_validation->set_rules("password", "Password", "required|md5");

		if($this->form_validation->run()) {
			$data = array(
				"username" => $this->input->post("username"),
				"is_logged_in" => 1
			);
			$this->session->set_userdata($data);
			redirect("user/adminpanel");
		} else {
			$title["title"] = "Login :: Klemen";
		
			$this->load->view("admin/par_admin_home", $title);
			$this->load->view("admin/view_login");
			$this->load->view("admin/par_admin_footer");
		}
	}

	public function adminpanel() {
		if($this->session->userdata("is_logged_in")) {
			$data["title"] = "Admin panel";
			$data["upload_error"] = $this->session->flashdata("upload_error");
			$data["upload_success"] = $this->session->flashdata("upload_success");
			$data['galleryTypes'] = $this->uploadGalleryTypes();
			$this->load->view("admin/par_admin_home", $data);
			$this->load->view("admin/view_admin_panel", $data);
			$this->load->view("admin/par_admin_footer");
		} else {
			redirect("user/restricted");
		}
	}

	public function uploadGalleryTypes() {
		$this->load->model("model_gallery");
		return $this->model_gallery->getGalleryTypes(); 
	}

	public function restricted() {
		$data['title'] = "Restricted";
		$this->load->view("admin/par_admin_home", $data);
		$this->load->view("restricted");
		$this->load->view("admin/par_admin_footer");
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("user/login");
	}

	public function validate_credentials() {
		$this->load->model("model_user");

		if($this->model_user->can_log_in()) {
			return true;
		} else {
			$this->form_validation->set_message("validate_credentials", "Incorrect username/password!");
			return false;
		}
	}
}