<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function index() {
		$this->login();
	}

	/**
	* Check if the user is logged in, if he's not, send him to the login page
	*
	* @return void
	*/
	public function login() {
		$data["title"] = "Login :: Klemen";
		
		if($this->session->userData('is_logged_in'))
			redirect('admin/gallery');
		else
			$this->load->view("admin/view_login", $data);
	}

	/**
	* Checks the username and password with database
	*
	* @return void
	*/
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
			redirect("admin/gallery");
		} else {
			redirect("admin/login");
		}
	}

	/**
	* Validate credentials with database
	*
	* @return bool
	*/
	public function validate_credentials() {
		$this->load->model("model_user");

		if($this->model_user->can_log_in()) {
			return true;
		} else {
			$this->form_validation->set_message("validate_credentials", "Incorrect username/password!");
			return false;
		}
	}	

	/**
	* Destroy session and logout user
	*
	* @return void
	*/
	public function logout() {
		$this->session->sess_destroy();
		redirect("user");
	}
}