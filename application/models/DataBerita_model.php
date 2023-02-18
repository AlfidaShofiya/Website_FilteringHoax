<?php

class DataBerita_model extends CI_Model
{
	// Mendeklarasikan tabel dalam database yang digunakan
	private $_table = "tb_berita";

	// Fungsi yang digunakan untuk mengambil Data Berita
	public function getDataBerita()
	{
		$this->db->select('*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_berita.id_kategori', 'left');
		$this->db->where('id_status', '2');
		$this->db->order_by('tgl_validasi', 'desc');
		return $this->db->get()->result();
	}
	
	// Fungsi yang digunakan untuk mengambil Berita berdasarkan id Berita
	public function getById($id)
	{
		$this->db->select('*');
		$this->db->from('tb_berita');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_berita.id_kategori', 'left');
		$this->db->where('id_berita', $id);
		$this->db->order_by('id_berita', 'desc');
		return $this->db->get()->result();
	}
	
	// Fungsi yang digunakan untuk mengambil Berita berdasarkan id Berita
	public function getDetail($id)
	{
		return $this->db->get_where($this->_table, ["id_berita" => $id])->result();
	}
	
	// Fungsi yang digunakan untuk mengupdate isi dari Data Berita
	public function update($id = NULL)
	{
		$id = $this->input->post('id');
		
		$data = array(
			'id_berita' => $id,
			'judul' => $this->input->post('judul'),
			'tgl_berita' => $this->input->post('tgl_berita'),
			'tgl_filtering' => $this->input->post('tgl_filtering'),
			'id_kategori' => $this->input->post('id_kategori'),
			'isi' => $this->input->post('isi'),
			'sumber' => $this->input->post('sumber'),
			'gambar' => $this->input->post('gambar'),
		);
		
		$this->db->update($this->_table, $data, array('id_berita' => $id));
		$this->session->set_flashdata('berhasildiubah', 'Data Berita Berhasil Diupdate');
		redirect(site_url('databerita'));
	}
	
	// Fungsi yang digunakan untuk menghapus Data Berita
	public function delete($id_berita)
	{
		$this->db->delete($this->_table, array('id_berita' => $id_berita));
		$this->session->set_flashdata('berhasildihapus', 'Data Berita Berhasil Dihapus');
		redirect(site_url('databerita'));
	}
}