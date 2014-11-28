<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {
	public function index() {
		$this->load->view('par_home');
		$this->load->view('restricted');
		$this->load->view('par_footer');
	}

	public function send_email() {
		$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email");

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			if($this->form_validation->run()) {
				$name = $this->input->post("name");
				$email = $this->input->post("email");
				$message = $this->input->post("message");

				$config = array(
					"protocol" => "smtp",
					"smtp_host" => "ssl://smtp.googlemail.com",
					"smtp_port" => 465,
					"smtp_user" => "janez.sarlah@gmail.com",
					"smtp_pass" => "janezsarlah1988",
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);

				$this->load->library("email");
				$this->email->initialize($config);

				
				$this->email->set_newline("\r\n"); // Dont know why but it must be here


				$this->email->from($email, $name);
				$this->email->to("janez.sarlah@gmail.com");
				$this->email->subject("This is an email test");
				$this->email->message("Teting this email sender");


				if($this->email->send()) {
					$this->load->view("view_success");
				} else
				echo $this->email->print_debugger(); { 
					//$this->load->view("view_error");
				}
			} else {
				$this->load->view("restricted");
			} 
		}
	}
}