<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Transaksi Berhasil!</h4>
                </div>
                
                <?php if (isset($transaksi)): // Asumsi $transaksi adalah variabel yang dilewatkan, bukan dari URL ?>
                <div class="card-body p-4">
                    <h5 class="text-center">Struk Pembelian</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6">
                            <strong>No. Transaksi:</strong> <?php echo htmlspecialchars($id_transaksi, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="col-6 text-end">
                            <strong>Tanggal:</strong> <?php echo date('d M Y, H:i', strtotime($tanggal_transaksi)); ?>
                        </div>
                    </div>

                    <h6>Detail Pembeli:</h6>
                    <p class="mb-0"><?php echo htmlspecialchars($detail_pembeli['NAMA'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="mb-0"><?php echo htmlspecialchars($detail_pembeli['ALAMAT'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><?php echo htmlspecialchars($detail_pembeli['KECAMATAN'], ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars($detail_pembeli['KOTA'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <h6>Barang yang Dibeli:</h6>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total_semua = 0;
                                foreach ($item_dibeli as $item): 
                                $total_semua += $item['subtotal'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($item['qty'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-end">Rp <?php echo number_format($item['price']); ?></td>
                                <td class="text-end">Rp <?php echo number_format($item['subtotal']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total Pembayaran</td>
                                <td class="text-end">Rp <?php echo number_format($total_semua); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="text-center mt-4">
                        <p>Terima kasih telah berbelanja di Toko Mama!</p>
                        <a href="<?php echo site_url('index.php/C_Barang/display'); ?>" class="btn btn-primary">Kembali ke Home</a>
                    </div>
                </div>
                <?php endif; // Penutup if (isset($transaksi)) ?>

            </div>
        </div>
    </div>
</div>