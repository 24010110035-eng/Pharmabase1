<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            exit;
        }

        $this->user = array(
            'id'       => $this->session->userdata('user_id'),
            'nama'     => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'role'     => $this->session->userdata('role'),
        );

        $this->data['user'] = $this->user;
    }

    protected function require_role($allowed_roles)
    {
        if (!in_array($this->user['role'], (array) $allowed_roles, true)) {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        }
    }
}

class Public_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->router->fetch_method() === 'logout') {
            return;
        }

        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
            exit;
        }
    }
}