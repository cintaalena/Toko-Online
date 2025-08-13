<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class C_Transaksi extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang');
        $this->load->model('M_Transaksi');
        $this->load->model('M_Jual');
        $this->load->helper('url');
    }

    /* Untuk mengambil input data pembeli, memproses transaksi, dan update stok. */
   public function transaksiPenjualan()
{
    // 1. Ambil data customer dari form checkout
   $data_pembeli = array(
        'user_id'   => $this->session->userdata('user_id'),
        // BARIS RENTAN - Mematikan filter XSS bawaan CodeIgniter
        'NAMA'      => $this->input->post('nama'),
        'ALAMAT'    => $this->input->post('alamat'),
        'KECAMATAN' => $this->input->post('kecamatan'),
        'KOTA'      => $this->input->post('kota'),
        'TANGGAL'   => date('Y-m-d H:i:s')
    );

    // 2. Simpan data customer ke tabel 'transaksi_penjualan'
    $this->db->insert('transaksi_penjualan', $data_pembeli);

    // 3. Ambil ID dari transaksi yang baru saja dibuat
    $id_transaksi_baru = $this->db->insert_id();

    // 4. Siapkan data untuk dikirim ke view SEBELUM cart dihancurkan
    $data_untuk_view = array(
        'id_transaksi'      => $id_transaksi_baru,
        'tanggal_transaksi' => $data_pembeli['TANGGAL'],
        'detail_pembeli'    => $data_pembeli,
        'item_dibeli'       => $this->cart->contents() // <-- Ini bagian penting
    );

    // 5. Looping isi keranjang untuk disimpan ke tabel 'jual' dan update stok
    foreach ($this->cart->contents() as $item) {
        $data_jual = array(
            'ID_TRANSAKSI' => $id_transaksi_baru,
            'ID_BARANG'    => $item['id'],
            'STOK'         => $item['qty'],
            'HARGA'        => $item['price']
        );
        $this->db->insert('jual', $data_jual);

        // Logika Update Stok
        $barang_saat_ini = $this->M_Barang->cariBarang($item['id'])[0];
        $stok_baru = $barang_saat_ini->STOK - $item['qty'];
        $this->M_Barang->update($item['id'], $stok_baru);
    }

    // 6. Hancurkan session cart karena transaksi sudah selesai
    $this->cart->destroy();

    // 7. Tampilkan view struk dengan data yang sudah disiapkan
    $data_untuk_view['content_view'] = "V_Transaksi.php";
    $this->load->view('V_Template', $data_untuk_view);
}

    /* Untuk menampilkan struk pembelian terakhir. */
   public function lastStrukDisplay()
{
    // Panggil fungsi model untuk mengambil transaksi terakhir
    $transaksi_terakhir = $this->M_Transaksi->ambilTransaksiTerakhir();

    // Siapkan array data untuk dikirim ke view
    $data = array();

    if ($transaksi_terakhir) {
        // Jika transaksi ditemukan, ambil detail barangnya
        $item_dibeli = $this->M_Transaksi->ambilDetailJual($transaksi_terakhir->ID);
        
        $data['transaksi'] = $transaksi_terakhir;
        $data['item_dibeli'] = $item_dibeli;
    }

    $data['content_view'] = "V_Struk.php";
    $this->load->view('V_Template', $data);
}
}