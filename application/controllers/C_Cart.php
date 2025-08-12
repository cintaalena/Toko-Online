<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class C_Cart extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang');
        $this->load->helper('url');
        // Pastikan Anda sudah autoload 'cart' library di application/config/autoload.php
    }

    /* Untuk memasukkan barang yang akan dibeli ke keranjang. */
public function masukCart()
{
    // Ambil data dari form
    $id_barang = $this->input->post('id_barang');
    $jumlah_baru = $this->input->post('jumlah');

    // Ambil detail barang dari model
    $barang = $this->M_Barang->cariBarang($id_barang)[0];

    // Cek apakah barang sudah ada di keranjang
    $item_sudah_ada = false;
    foreach ($this->cart->contents() as $item) {
        if ($item['id'] == $id_barang) {
            // Jika barang sudah ada, siapkan data untuk update
            $data = array(
                'rowid' => $item['rowid'],
                'qty'   => $item['qty'] + $jumlah_baru
            );
            $this->cart->update($data);
            $item_sudah_ada = true;
            break;
        }
    }

    // Jika barang belum ada di keranjang, masukkan sebagai item baru
    if (!$item_sudah_ada) {
        $data = array(
            'id'      => $barang->ID,
            'qty'     => $jumlah_baru,
            'price'   => $barang->HARGA,
            'name'    => $barang->NAMA,
            'foto'    => $barang->FOTO
        );
        $this->cart->insert($data);
    }
    
    // Alihkan ke halaman keranjang
    redirect('index.php/C_Cart/displayCart');
}

    /* Untuk menampilkan view keranjang belanja. */
    public function displayCart()
    {
        $data['content_view'] = "V_Cart_Display.php";
        $this->load->view('V_Template', $data);
    }

    /* Untuk menghapus semua barang pada keranjang belanja. */
    public function deleteCart()
    {
        // Gunakan fungsi dari Cart Library untuk menghapus semua isi keranjang
        $this->cart->destroy();
        redirect('index.php/C_Barang/display');
    }

    /* Untuk melakukan check out terhadap seluruh barang yang ada di keranjang. */
   public function checkOutCart()
{
    // Siapkan data untuk dikirim ke view
    $data['total_belanja'] = $this->cart->total(); // Ambil total dari Cart Library
    $data['content_view'] = "V_Form_CheckOut.php";

    // Muat view dengan data yang sudah disiapkan
    $this->load->view('V_Template', $data);
}

	public function hapusItem($rowid)
{
    $this->cart->remove($rowid);
    redirect('index.php/C_Cart/displayCart');
}
}