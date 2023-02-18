<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Home extends CI_Controller
{
	// Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
	public function __construct()
	{
		parent::__construct();
		$this->load->model("home_model");
		$this->load->library("form_validation");
	}

	// Fungsi untuk mengarahkan halaman utama atau halaman default pada halaman yang ada diuser guest
	public function index()
	{
		$data["Home"] = $this->home_model->getDataBerita();
		$this->load->view("guest/home", $data);
	}

	// Fungsi untuk mengarahkan kepada halaman detail berita pada halaman yang ada diuser guest
	public function detail($id = null)
	{
		$data["Home"] = $this->home_model->getDetail($id);
		$data["Homee"] = $this->home_model->getListBerita();
		$this->load->view("guest/detail", $data);
	}
}
