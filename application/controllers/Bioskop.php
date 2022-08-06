<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bioskop extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_bioskop', 'bioskop');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $param['title'] = 'Film';
        $param['film'] = $this->bioskop->get_film();
        $this->load->view('film', $param);
    }

    public function create_film()
    {
        $param['title'] = 'Add Film';
        $this->load->view('create_film', $param);
    }

    public function save_film()
    {
        $this->form_validation->set_rules('judul_film', 'judul film', 'required|trim', ['required' => 'judul film tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_launc', 'tgl launc', 'required|trim', ['required' => 'tanggal launcing tidak boleh kosong']);
        $this->form_validation->set_rules('synopys', 'synopys', 'required|trim', ['required' => 'sinopsis tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $this->create_film();
        } else {
            $this->proses_save_film();
        }
    }

    // private function proses_save_film()
    // {
    //     $judul_film = strtoupper($this->input->post('judul_film'));
    //     $vokal = ['A', 'I', 'U', 'E', 'O'];
    //     $konsonan = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];
    //     // $len = strlen($judul_film);
    //     $huruf_konsonan1 = "";
    //     $huruf_konsonan2 = "";
    //     $array_added = array();
    //     $array_nothing = array();


    //     if (str_word_count($judul_film) == 2) {
    //         $kata1 = (explode(" ", $judul_film)[0]);
    //         $kata2 = (explode(" ", $judul_film)[1]);
    //         $explode_word = str_split($kata2);
    //         for ($i = 0; $i < count($explode_word); $i++) {
    //             for ($j = 0; $j < count($konsonan); $j++)
    //                 if ($explode_word[$i] == $konsonan[$j]) {
    //                     array_push($array_added, $explode_word[$i]);
    //                 } else {
    //                     array_push($array_nothing, $explode_word[$i]);
    //                 }
    //         }
    //     }
    //     var_dump($array_added[0]);
    // }

    private function proses_save_film()
    {
        $judul_film = [strtoupper($this->input->post('judul_film'))];
        $vokal = ['A', 'I', 'U', 'E', 'O'];
        $konsonan = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];
        // $len = strlen($judul_film);
        $huruf_konsonan1 = "";
        $huruf_konsonan2 = "";
        $array_added = array();
        $array_added2 = array();
        $array_nothing = array();
        $array_nothing2 = array();

        $pecahan_judul = explode(" ", $judul_film[0]);
        $jml = count($pecahan_judul);
        for ($a = 0; $a < count($pecahan_judul); $a++) {
            $kata1 = (explode(" ", $judul_film[0])[0]);
            $kata2 = (explode(" ", $judul_film[0])[$a]);
        }
        if ($jml > 1) {
            $explode_word1 = str_split($kata1);
            for ($i = 0; $i < count($explode_word1); $i++) {
                for ($j = 0; $j < count($konsonan); $j++)
                    if ($explode_word1[$i] == $konsonan[$j]) {
                        array_push($array_added, $explode_word1[$i]);
                    } else {
                        array_push($array_nothing, $explode_word1[$i]);
                    }
            }
            $explode_word2 = str_split($kata2);
            for ($i = 0; $i < count($explode_word2); $i++) {
                for ($j = 0; $j < count($konsonan); $j++)
                    if ($explode_word2[$i] == $konsonan[$j]) {
                        array_push($array_added2, $explode_word2[$i]);
                    } else {
                        array_push($array_nothing, $explode_word2[$i]);
                    }
            }
        } else if ($jml = 1) {
            $explode_word3 = str_split($kata1);
            for ($i = 0; $i < count($explode_word3); $i++) {
                for ($j = 0; $j < count($konsonan); $j++)
                    if ($explode_word3[$i] == $konsonan[$j]) {
                        array_push($array_added, $explode_word3[$i]);
                    } else {
                        for ($k = 0; $k < count($vokal); $k++)
                            if ($explode_word3[$i] == $vokal[$k]) {
                                array_push($array_added, $explode_word3[$i][0]);
                            }
                    }
            }
        }
        $max_kode = $this->bioskop->max_kode();
        $urutan = (int) substr($max_kode->kodenya, 3, 3);
        $urutan++;
        // var_dump($array_added[0]);
        $nama_film = $this->input->post('judul_film');
        if (str_word_count($nama_film) > 1) {
            $kode = $array_added[0] . $array_added2[0] . sprintf("%03s", $urutan);
        }
        $tgl_launc = $this->input->post('tgl_launc');
        $synopys = $this->input->post('synopys');

        $film = array(
            'kd_film' => $kode,
            'judul_film' => $nama_film,
            'tgl_launc' => $tgl_launc,
            'synopys' => $synopys
        );
        // var_dump($film);
        $this->db->insert('film', $film);
        $this->session->set_flashdata('success_create', true);
        redirect('Bioskop');
    }

    public function edit_film($id)
    {
        $param['title'] = 'Edit Film';
        $param['view'] = $this->db->get_where('film', ['kd_film' => $id])->row();
        $this->load->view('edit_film', $param);
    }

    public function update_film()
    {
        $this->form_validation->set_rules('tgl_launc', 'tgl launc', 'required|trim', ['required' => 'tanggal launcing tidak boleh kosong']);
        $this->form_validation->set_rules('synopys', 'synopys', 'required|trim', ['required' => 'sinopsis tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $this->create_film();
        } else {
            $this->proses_update_film();
        }
    }

    private function proses_update_film()
    {
        $this->bioskop->update_film();
        $this->session->set_flashdata('success_update', true);
        redirect('Bioskop');
    }

    public function delete_film($id)
    {
        $this->db->delete('film', ['kd_film' => $id]);
        $this->session->set_flashdata('success_delete', true);
        redirect('Bioskop');
    }

    public function bioskop()
    {
        $param['title'] = 'Bioskop';
        $param['bioskop'] = $this->bioskop->get_bioskop();
        $this->load->view('bioskop', $param);
    }

    public function create_bioskop()
    {
        $param['title'] = 'Add Bioskop';
        $this->load->view('create_bioskop', $param);
    }


    public function save_bioskop()
    {
        $this->form_validation->set_rules('kd_bioskop', 'kode bioskop', 'required|trim|exact_length[3]|alpha', ['exact_length' => 'kode haru 3 karakter', 'alpha' => 'inputan berupa huruf / alphabet', 'required' => 'judul film tidak boleh kosong']);
        $this->form_validation->set_rules('nama_bioskop', 'nama bioskop', 'required|trim', ['required' => 'nama bioskop tidak boleh kosong']);
        $this->form_validation->set_rules('alamat_bioskop', 'alamat', 'required|trim', ['required' => 'alamat bioskop tidak boleh kosong']);
        $this->form_validation->set_rules('kota', 'kota', 'required|trim', ['required' => 'kota tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $this->create_bioskop();
        } else {
            $this->proses_save_bioskop();
        }
    }

    private function proses_save_bioskop()
    {
        $this->bioskop->save_bioskop();
        $this->session->set_flashdata('success_create', true);
        redirect('Bioskop/bioskop');
    }

    public function edit_bioskop($id)
    {
        $param['title'] = 'Add Bioskop';
        $param['view'] = $this->db->get_where('bioskop', ['kd_bioskop' => $id])->row();
        $this->load->view('edit_bioskop', $param);
    }


    public function update_bioskop()
    {
        $id = $this->input->post('kd_bioskop');
        $this->form_validation->set_rules('nama_bioskop', 'nama bioskop', 'required|trim', ['required' => 'nama bioskop tidak boleh kosong']);
        $this->form_validation->set_rules('alamat_bioskop', 'alamat', 'required|trim', ['required' => 'alamat bioskop tidak boleh kosong']);
        $this->form_validation->set_rules('kota', 'kota', 'required|trim', ['required' => 'kota tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $this->edit_bioskop($id);
        } else {
            $this->proses_update_bioskop();
        }
    }

    private function proses_update_bioskop()
    {
        $this->bioskop->update_bioskop();
        $this->session->set_flashdata('success_update', true);
        redirect('Bioskop/bioskop');
    }

    public function delete_bioskop($id)
    {
        $this->db->delete('bioskop', ['kd_bioskop' => $id]);
        $this->session->set_flashdata('success_delete', true);
        redirect('Bioskop/bioskop');
    }

    public function tiket()
    {
        $param['title'] = 'Tiket';
        $param['tiket'] = $this->bioskop->get_tiket();
        $this->load->view('tiket', $param);
    }

    public function create_tiket()
    {
        
    }
}
