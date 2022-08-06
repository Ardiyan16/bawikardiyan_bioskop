<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bioskop extends CI_Model
{

    public function get_film()
    {
        return $this->db->get('film')->result();
    }

    public function get_bioskop()
    {
        return $this->db->get('bioskop')->result();
    }

    public function get_tiket()
    {
        $this->db->select('*');
        $this->db->from('reservasi_tiket rt');
        $this->db->join('film', 'rt.kode_film = film.kd_film');
        $this->db->join('bioskop', 'rt.kode_bioskop = bioskop.kd_bioskop');
        return $this->db->get()->result();
    }

    public function save_bioskop()
    {
        $post = $this->input->post();
        $this->kd_bioskop = strtoupper($post['kd_bioskop']);
        $this->nama_bioskop = $post['nama_bioskop'];
        $this->alamat_bioskop = $post['alamat_bioskop'];
        $this->kota = $post['kota'];
        $this->db->insert('bioskop', $this);
    }

    public function update_bioskop()
    {
        $post = $this->input->post();
        $this->kd_bioskop = $post['kd_bioskop'];
        $this->nama_bioskop = $post['nama_bioskop'];
        $this->alamat_bioskop = $post['alamat_bioskop'];
        $this->kota = $post['kota'];
        $this->db->update('bioskop', $this, ['kd_bioskop' => $post['kd_bioskop']]);
    }

    public function max_kode()
    {
        return $this->db->query("SELECT max(kd_film) as kodenya FROM film")->row();
    }

    public function update_film()
    {
        $post = $this->input->post();
        $this->kd_film = $post['kd_film'];
        $this->judul_film = $post['judul_film'];
        $this->tgl_launc = $post['tgl_launc'];
        $this->synopys = $post['synopys'];
        $this->db->update('film', $this, ['kd_film' => $post['kd_film']]);
    }

}