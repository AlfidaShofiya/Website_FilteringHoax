<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends CI_Controller
{
  // Fungsi yang digunakan untuk memanggil atau mengimport berbagai library dan model yang digunakan
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('validasi_model');
    $this->load->library('form_validation');
    $this->load->model('user_model');
    if ($this->user_model->isNotLogin()) redirect(site_url('login'));
  }

  // Fungsi untuk mengarahkan halaman list berita hasil filtering pada menu Validasi
  public function index()
  {
    $data["Validasi"] = $this->validasi_model->getAll();
    $this->load->view("admin/validasi/list", $data);
  }

  // Fungsi untuk mengarahkan kepada halaman detail berita pada menu Validasi
  public function detail($id = NULL)
	{
		$data["Validasi"] = $this->validasi_model->getDetail($id);
		$this->load->view("admin/validasi/detail", $data);
	}

  // Fungsi untuk mengambil seluruh data session yang sudah dibuat saat login
  public function get_session_data(){
    $this->session->all_userdata();
  }

  // Fungsi untuk mengubah nilai pada bagian data berita menjadi tervalidasi
  public function validasi($id = null)
  {
    $id_admin = $this->session->userdata('id_admin');
    if ($this->validasi_model->validasi($id, $id_admin)) {
      $this->session->set_flashdata('success', 'Data Berita Berhasil Divalidasi');
      redirect(site_url('validasi'));
    }
  }
}
