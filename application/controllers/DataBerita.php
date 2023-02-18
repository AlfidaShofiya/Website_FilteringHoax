<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataBerita extends CI_Controller
{
	// Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
	public function __construct()
	{
		parent::__construct();
		$this->load->model('databerita_model');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		if ($this->user_model->isNotLogin()) redirect(site_url('login'));
	}

	// Fungsi untuk mengarahkan halaman utama atau halaman default pada menu Data Berita
	public function index()
	{
		$data["DataBerita"] = $this->databerita_model->getDataBerita();
		$this->load->view("admin/databerita/list", $data);
	}
	
	// Fungsi untuk mengarahkan kepada halaman detail berita pada menu Data Berita
	public function detail($id = NULL)
	{
		$data["DataBerita"] = $this->databerita_model->getDetail($id);
		$this->load->view("admin/databerita/detail", $data);
	}
	
	// Fungsi untuk mengarahkan kepada halaman edit dan mengecek form yang diisi saat edit data pada menu Data Berita
	public function edit($id = NULL)
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		
		$data['DataBerita']  = $this->databerita_model->getById($id);
		
		if ($this->form_validation->run()) {
			$this->databerita_model->update();
		}
		$this->load->view("admin/databerita/edit_form", $data);
	}

	// Fungsi untuk menghapus data pada menu Data Berita
	public function delete($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->databerita_model->delete($id)) {
			redirect(site_url('admin/databerita'));
		}
	}
}
