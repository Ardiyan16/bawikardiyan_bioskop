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

    public function get_tayangan()
    {
        $this->db->select('*');
        $this->db->from('tayang');
        $this->db->join('film', 'tayang.kode_film = film.kd_film');
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

    public function max_kode_tiket()
    {
        return $this->db->query("SELECT max(kd_tiket) as kodenya FROM reservasi_tiket")->row();
    }

    public function max_kode_tiket2($tanggal, $kode_film)
    {
        return $this->db->query("SELECT max(kd_tiket) as kodenya FROM reservasi_tiket WHERE kode_film = '$kode_film' AND tanggal = '$tanggal'")->row();
    }

    public function max_kode_tayang()
    {
        return $this->db->query("SELECT max(kd_tayang) as kodenya FROM tayang")->row();
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

    var $kolom_film = array('a.kd_film', 'a.judul_film', 'a.tgl_launc', 'a.synopys', null); //set column field database for datatable orderable
    var $kolom_search = array('a.kd_film', 'a.judul_film', 'a.tgl_launc', 'a.synopys'); //set column field database for datatable searchable just title , author , category are searchable
    var $filmkd = array('a.kd' => 'asc'); // default order

    public function get_data_film()
    {
        $this->get_query_film();

        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function get_query_film()
    {
        $this->db->select('*');
        $this->db->from("film a");
        $this->db->order_by('a.kd_film', 'asc');
        $i = 0;


        foreach ($this->kolom_search as $item) {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    // $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->kolom_search) - 1 == $i); //last loop
                // $this->db->group_end(); //close bracket


            }

            $i++;
        }

        if (isset($_REQUEST['order'])) {
            $this->db->order_by($this->kolom_film[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->filmkd)) {
            $order = $this->filmkd;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function jml_filteredid()
    {
        $this->get_query_film();
        //$this->db->where('orde_sungai',$id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function jml_allid()
    {
        $this->db->from("film a");
        return $this->db->count_all_results();
    }

}
