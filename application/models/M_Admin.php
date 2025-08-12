<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {

    public function get_transaction_log()
    {
        $this->db->select('tp.ID, tp.TANGGAL, tp.NAMA as nama_pembeli, u.username, bt.NAMA as nama_barang, j.STOK as jumlah_beli');
        $this->db->from('transaksi_penjualan as tp');
        $this->db->join('users as u', 'tp.user_id = u.id', 'left');
        $this->db->join('jual as j', 'tp.ID = j.ID_TRANSAKSI');
        $this->db->join('barangToko as bt', 'j.ID_BARANG = bt.ID');
        $this->db->order_by('tp.ID', 'DESC');
        return $this->db->get()->result();
    }
}