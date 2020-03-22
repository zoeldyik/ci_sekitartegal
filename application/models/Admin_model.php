<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validasi()
    {
        $username =  htmlspecialchars($this->input->post('username', TRUE));
        $password = htmlspecialchars($this->input->post('password', TRUE));

        $this->db->where('user', $username);
        $user = $this->db->get('admin')->row_array();

        if ($user === []) {
            // jika user salah
            return FALSE;
        } else {
            // jika user benar cek password
            // generate password from database
            $hash = $user['password'];

            // bandingkan password
            // jika benar create session dan return TRUE
            if (password_verify($password, $hash)) {
                $this->session->set_userdata('dahLogin', $user['user']);
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}