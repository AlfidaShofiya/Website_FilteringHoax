<?php defined('BASEPATH') or exit('No direct script access allowed');

class Overview extends CI_Controller
{
	// Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		if ($this->user_model->isNotLogin()) redirect(site_url('login'));
	}

	// Fungsi untuk mengarahkan halaman overview pada menu Overview
	public function index()
	{
		$this->load->view("admin/overview");
	}
}