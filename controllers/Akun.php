<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	public function profil()
	{
		$this->require_role(array('admin', 'apoteker'));

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

			$password_baru = $this->input->post('password');
			if (!empty($password_baru)) {
				$this->form_validation->set_rules('password', 'Password Baru', 'min_length[6]');
				$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password]');
			}

			if ($this->form_validation->run()) {
				$update = array(
					'nama_lengkap' => $this->input->post('nama_lengkap'),
				);

				if (!empty($password_baru)) {
					$update['password'] = $password_baru; // di-hash otomatis di User_model::update()
				}

				$this->User_model->update($this->user['id'], $update);

				// Perbarui session supaya nama di navbar langsung berubah tanpa perlu login ulang.
				$this->session->set_userdata('nama', $update['nama_lengkap']);

				$this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
				redirect('profil');
				return;
			}
		}

		$data['akun'] = $this->User_model->get_by_id($this->user['id']);

		$this->load->view('layout/header', array('title' => 'Profil Saya'));
		$this->load->view('akun/profil', $data);
		$this->load->view('layout/footer');
	}
}