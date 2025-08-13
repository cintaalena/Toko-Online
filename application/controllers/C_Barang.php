<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class C_Barang extends CI_Controller {

    function __construct()
{
    parent::__construct();
    $this->load->model('M_Barang');
    $this->load->helper('url');
    
    // Tambahkan pengecekan ini
    if (!$this->session->userdata('is_logged_in')) {
        redirect('C_Auth/login');
    }
}

    /* Untuk menampilkan view dengan menampilkan data barang yang dijual. */
    public function display()
    {
        $data['content_view'] = "V_Barang.php";
        $data['barang'] = $this->M_Barang->ambil();
        $this->load->view('V_Template', $data);
    }

    /* Untuk menampilkan view form input data barang. */
    public function formInputData()
{
    // Pengecekan: Hanya user dengan role 'admin' yang bisa mengakses.
    if ($this->session->userdata('role') != 'admin') {
        show_error('Halaman ini hanya dapat diakses oleh Admin.', 403, 'Akses Dilarang');
    }

    // Jika user adalah admin, muat halaman form.
    $data['content_view'] = "V_Form_InputData.php";
    $this->load->view('V_Template', $data);
}
    /* Untuk melakukan input data dari form data barang ke database model barang. */
    public function inputData()
    {
        // 1. Konfigurasi untuk upload file
        $config['upload_path']   = './assets/'; // Folder untuk menyimpan file
        $config['allowed_types'] = 'gif|jpg|png|jpeg|php'; // Tipe file yang diizinkan
        $config['max_size']      = 2048; // Ukuran maksimum file (2MB)
        
        // Muat library upload dengan konfigurasi
        $this->load->library('upload', $config);

        // 2. Lakukan proses upload
        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, ambil data file
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            // 3. Ambil data dari form menggunakan Input Class
            $data = array(
                'NAMA'  => $this->input->post('nama', TRUE),
                'HARGA' => $this->input->post('harga', TRUE),
                'STOK'  => $this->input->post('stok', TRUE),
                'FOTO'  => $file_name
            );

            // 4. Kirim data ke model untuk disimpan
            $this->M_Barang->input($data, 'barangToko');

            // 5. Buat pesan sukses dan alihkan halaman
            $this->session->set_flashdata('pesan_sukses', 'Barang baru berhasil ditambahkan!');
            redirect('index.php/C_Barang/display');

        } else {
            // Jika upload gagal, kembali ke form dengan pesan error
            $this->session->set_flashdata('pesan_error', $this->upload->display_errors());
            redirect('index.php/C_Barang/formInputData');
        }
    }
    
    public function hapusBarang()
{
    // Menerima ID dari form (POST)
    $id_barang = $this->input->post('id_barang');
    $this->M_Barang->hapusDataBarang($id_barang);

    $this->session->set_flashdata('pesan_sukses', 'Barang berhasil dihapus!');
    redirect('index.php/C_Barang/display');
}

    // -- FUNGSI BARU UNTUK UPDATE STOK --

    // Fungsi untuk menampilkan halaman form update
    public function formUpdateStok($id)
    {
        // Kode ini langsung menggabungkan $id ke dalam query, sangat berbahaya
        $query = $this->db->query("SELECT * FROM barangToko WHERE ID = " . $id);
        $data['barang'] = $query->result_array()[0];
        
        // Tampilkan view form update
        $data['content_view'] = "V_Form_Update_Stok.php";
        $this->load->view('V_Template', $data);
    }

    // Fungsi untuk memproses data dari form update
    public function prosesUpdateStok()
    {
        // Ambil data dari form
        $id_barang = $this->input->post('id_barang');
        $stok_lama = $this->input->post('stok_lama');
        $jumlah_tambahan = $this->input->post('jumlah_tambahan');
        
        // Hitung stok baru
        $stok_baru = $stok_lama + $jumlah_tambahan;
        
        // Panggil model untuk update data di database
        $this->M_Barang->update($id_barang, $stok_baru);
        
        // Buat pesan sukses dan redirect
        $this->session->set_flashdata('pesan_sukses', 'Stok barang berhasil diperbarui!');
        redirect('index.php/C_Barang/display');
    }
}