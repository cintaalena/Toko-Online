<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {

    public function cek_login($username)
    {
        return $this->db->get_where('users', array('username' => $username))->row();
    }
    public function tambah_user($data)
{
    return $this->db->insert('users', $data);
}
}