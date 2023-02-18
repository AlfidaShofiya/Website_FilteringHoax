<?php

class Riwayat_model extends CI_Model
{
	// Mendeklarasikan tabel dalam database yang digunakan
	private $_table = "tb_berita";

	// Fungsi yang digunakan untuk mengambil Data Riwayat
	public function getRiwayat()
	{
		$this->db->select('*');
		$this->db->from('tb_berita');
		$this->db->join('tb_admin', 'tb_admin.id_admin = tb_berita.id_admin', 'right');
		$this->db->where('id_status', '2');
		$this->db->order_by('tgl_validasi', 'desc');
		return $this->db->get()->result();
	}
}