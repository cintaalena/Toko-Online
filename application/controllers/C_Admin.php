<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class C_Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'admin') {
            redirect('C_Auth/login');
        }
        // Load model admin
        $this->load->model('M_Admin');
    }

    public function dashboard()
    {
        $data['content_view'] = "V_Admin_Dashboard.php";
        $this->load->view('V_Template', $data);
    }

    // FUNGSI BARU
    public function kelola_pengguna()
    {
        $data['log_transaksi'] = $this->M_Admin->get_transaction_log();
        $data['content_view'] = "V_Kelola_Pengguna.php";
        $this->load->view('V_Template', $data);
    }
}