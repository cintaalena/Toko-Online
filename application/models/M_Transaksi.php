<?php 
    class M_Transaksi extends CI_Model
    {
        /* Untuk melakukan input data pada tabel. */
        public function input($data, $table)
        {
            $this->db->insert($table,$data);
        }

        /* Untuk mengambil semua data yang ada pada tabel transaksi_penjualan. */
        public function ambil()
        {
            $data = $this->db->query('SELECT * FROM transaksi_penjualan');
            return $data->result();
        }

        // FUNGSI BARU: untuk mengambil satu transaksi paling akhir
        public function ambilTransaksiTerakhir()
        {
            $this->db->order_by('ID', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('transaksi_penjualan');
            return $query->row(); // Mengembalikan satu baris data
        }

        // FUNGSI BARU: untuk mengambil detail barang dari satu transaksi
        public function ambilDetailJual($id_transaksi)
        {
            $this->db->select('jual.*, barangToko.NAMA as nama_barang');
            $this->db->from('jual');
            $this->db->join('barangToko', 'jual.ID_BARANG = barangToko.ID');
            $this->db->where('jual.ID_TRANSAKSI', $id_transaksi);
            $query = $this->db->get();
            return $query->result();
        }
    }