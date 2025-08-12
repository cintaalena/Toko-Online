<?php 
	class M_Barang extends CI_Model
	{
		/* Untuk mengambil semua data pada tabel barangToko. */
		public function ambil()
        {
            // HANYA TAMPILKAN BARANG YANG STATUSNYA AKTIF
            $this->db->where('status', 'aktif');
            $query = $this->db->get('barangToko');
            return $query->result();
        }

		/* Untuk melakukan input data terhadap tabel. */
		public function input($data, $table)
		{
			$this->db->insert($table,$data);
		}

		/* Untuk melakukan pencarian barang dengan menggunakan kode barang dan mendapatkan datanya. */
		public function cariBarang($kode)
{
    return $this->db->get_where('barangToko', array('ID' => $kode))->result();
}

		/* Untuk melakukan update terhadap stok barang. */
		public function update($id_barang, $kapasitasBaru)
{
    $data = array(
        'STOK' => $kapasitasBaru
    );
    $this->db->where('ID', $id_barang);
    $this->db->update('barangToko', $data);
}

		public function hapusDataBarang($id)
{
    $this->db->where('ID', $id);
        
        // Sesuaikan 'tabel_barang' dengan nama tabel produk Anda
        $this->db->delete('barangToko');
    }

}
