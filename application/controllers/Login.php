<?php

class Login extends CI_Controller
{
	// Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->library('form_validation');
	}

	// Fungsi untuk mengarahkan halaman login
	public function index()
	{
		check_already_login();
		if ($this->input->post()) {
			if ($this->user_model->doLogin()) {
				redirect(site_url('overview'));
			}
		}
		$this->load->view("admin/login_page.php");
	}
	
	// Fungsi untuk logout dan mengarahkan kembali pada halaman login
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
