<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Formulir Checkout</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info">
                    <h5 class="alert-heading">Total Pembayaran</h5>
                    <hr>
                    <p class="mb-0 fs-4 fw-bold">
                        Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?>
                    </p>
                </div>
                
                <h5 class="mt-4">Alamat Pengiriman</h5>
                
                <?php echo form_open('index.php/C_Transaksi/transaksiPenjualan'); ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" name="kota" id="kota" required>
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                        <button type="submit" name="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-credit-card-fill"></i> Bayar Sekarang
                        </button>
                    </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>