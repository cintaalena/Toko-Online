<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class C_Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('index.php/C_Barang/display');
        }
        
        $data['content_view'] = "V_Login.php";
        $this->load->view('V_Template', $data);
    }

    public function proses_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');
            
            $user = $this->M_User->cek_login($username);

            if ($user && password_verify($password, $user->password)) {
                
                $session_data = array(
                    'user_id'       => $user->id,
                    'username'      => $user->username,
                    'role'          => $user->role,
                    'is_logged_in'  => TRUE
                );
                $this->session->set_userdata($session_data);
                
                if ($user->role == 'admin') {
                    redirect('index.php/C_Admin/dashboard');
                } else {
                    redirect('index.php/C_Barang/display');
                }

            } else {
                $this->session->set_flashdata('error_login', 'Username atau Password salah!');
                redirect('index.php/C_Auth/login');
            }
        }
    }
    public function register()
{
    $data['content_view'] = "V_Register.php";
    $this->load->view('V_Template', $data);
}

// Fungsi untuk memproses data registrasi
public function proses_register()
{
    // Aturan validasi form
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
    $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');

     if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                // BARIS RENTAN - Menggunakan MD5 yang sangat tidak aman untuk password
                'password' => md5($this->input->post('password')),
                'role'     => 'pembeli'
            );

            $this->M_User->tambah_user($data);

            $this->session->set_flashdata('sukses_register', 'Registrasi berhasil! Silakan login.');
            redirect('index.php/C_Auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('index.php/C_Auth/login');
    }
}