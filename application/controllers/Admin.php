<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('admin/login');
            $this->load->view('templates/footer');
        } else {
            // cek username dan password
            $cek = $this->Admin_model->validasi();

            if ($cek) {
                // redirect ke halaman home/index
                redirect('home');
            } else {
                // jika username / password salah rediirect ke halaman ini lagi
                $this->session->set_flashdata('error', 'username / password salah');
                redirect('admin');
            }
        }
    }


    public function logout()
    {
        if (!$this->session->dahLogin) {
            redirect('home');
        }

        $this->session->unset_userdata('dahLogin');
        redirect("home");
    }
}