<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Struk Transaksi Terakhir</h4>
                </div>
                
                <?php if (isset($transaksi)): ?>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-6">
                            <strong>No. Transaksi:</strong> <?php echo htmlspecialchars($transaksi->ID, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="col-6 text-end">
                            <strong>Tanggal:</strong> <?php echo date('d M Y, H:i', strtotime($transaksi->TANGGAL)); ?>
                        </div>
                    </div>

                    <h6>Detail Pembeli:</h6>
                    <p class="mb-0"><?php echo htmlspecialchars($transaksi->NAMA, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="mb-0"><?php echo htmlspecialchars($transaksi->ALAMAT, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><?php echo htmlspecialchars($transaksi->KECAMATAN, ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars($transaksi->KOTA, ENT_QUOTES, 'UTF-8'); ?></p>

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
                                $subtotal = $item->HARGA * $item->STOK;
                                $total_semua += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item->nama_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($item->STOK, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-end">Rp <?php echo number_format($item->HARGA); ?></td>
                                <td class="text-end">Rp <?php echo number_format($subtotal); ?></td>
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
                </div>
                <?php else: ?>
                <div class="card-body text-center p-5">
                    <p class="mb-0">Belum ada riwayat transaksi.</p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>