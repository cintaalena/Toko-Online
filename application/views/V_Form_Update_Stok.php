<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Update Stok Barang</h4>
            </div>
            <div class="card-body">
                <h5><?php echo htmlspecialchars($barang->NAMA, ENT_QUOTES, 'UTF-8'); ?></h5>
                <hr>

                <?php echo form_open('index.php/C_Barang/prosesUpdateStok'); ?>
                    
                    <input type="hidden" name="id_barang" value="<?php echo $barang->ID; ?>">
                    <input type="hidden" name="stok_lama" value="<?php echo $barang->STOK; ?>">

                    <div class="mb-3">
                        <label class="form-label">Stok Saat Ini</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($barang->STOK, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_tambahan" class="form-label">Jumlah Stok yang Ditambahkan</label>
                        <input type="number" class="form-control" name="jumlah_tambahan" id="jumlah_tambahan" value="<?php echo set_value('jumlah_tambahan'); ?>" min="1" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>