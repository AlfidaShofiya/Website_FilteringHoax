<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	// Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('databerita_model');
		$this->load->library('form_validation');
		if ($this->user_model->isNotLogin()) redirect(site_url('login'));
	}

	// Fungsi untuk mengarahkan halaman list admin pada menu Admin
	public function index()
	{
		$data["User"] = $this->user_model->getAll();
		$this->load->view("admin/user/list", $data);
	}
	
	// Fungsi untuk mengarahkan kepada halaman input admin dan pengecekan form yang sudah diisi pada menu Admin
	public function input( )
	{
		$this->form_validation->set_message('required', '{field}Kolom Wajib Diisi !');

		$user = $this->user_model;
		$validation = $this->form_validation;
		$validation->set_rules($user->rules());

		if ($validation->run()) {
			$user->save();
		}
		$this->load->view('admin/user/new_form');
	}

	// Fungsi untuk mengarahkan kepada halaman edit admin dan mengecek form yang diisi saat edit data pada menu Admin
	public function edit($id = NULL)
	{
		$data['User']  = $this->user_model->getById($id);
		
		$user = $this->user_model;
		$validation = $this->form_validation;
		$validation->set_rules($user->rules());

		if ($validation->run() === FALSE) {
			$this->load->view("admin/user/edit_form", $data);
		} else {
			$user->update();
		}
	}

	// Fungsi untuk menghapus data admin pada menu Admin
	public function delete($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->user_model->delete($id)) {
			redirect(site_url('admin/user'));
		}
	}

}
