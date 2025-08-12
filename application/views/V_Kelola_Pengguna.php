<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Log Transaksi Pengguna</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Username</th>
                        <th>Nama Pembeli</th>
                        <th>Barang Dibeli</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($log_transaksi)): ?>
                        <?php foreach($log_transaksi as $log): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($log->ID, ENT_QUOTES, 'UTF-8'); ?></td>
                            
                            <td><?php echo date('d M Y, H:i', strtotime($log->TANGGAL)); ?></td>
                            
                            <td><?php echo $log->username ? htmlspecialchars($log->username, ENT_QUOTES, 'UTF-8') : 'N/A'; ?></td>
                            
                            <td><?php echo htmlspecialchars($log->nama_pembeli, ENT_QUOTES, 'UTF-8'); ?></td>
                            
                            <td><?php echo htmlspecialchars($log->nama_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            
                            <td><?php echo htmlspecialchars($log->jumlah_beli, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>