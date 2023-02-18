<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{
    // Fungsi untuk mengarahkan halaman utama atau halaman default pada menu kontak user guest
    public function index()
    {
        $this->load->view("guest/kontak");
    }
}