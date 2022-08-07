<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('M_biosk', 'blog');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('auth');
	}

	public function action_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'username tidak boleh kosong']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'password tidak boleh kosong']);
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$this->proses_login();
		}
	}

	private function proses_login()
	{
		$username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

		$user = $this->db->get_where('auth', ['username' => $username])->row_array();
		$cekpass = $this->db->get_where('auth', array('password' => $password));

		if ($username == $user['username']) {
			if ($password == $user['password']) {
				$data = [
					'username' => $user['username'],
					'status' => $user['status'],
				];
				$this->session->set_userdata($data);
				redirect('Bioskop');
			} else {
				$this->session->unset_userdata('username');
				$this->session->unset_userdata('status');
				$this->session->set_flashdata('password_salah', true);
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('username_salah', true);
			redirect('Auth');
		}
	}

	public function logout()
    {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
        $this->session->set_flashdata('logout', true);
        redirect('Auth');
    }


}
