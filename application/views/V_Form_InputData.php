<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle-fill"></i> Formulir Input Data Barang</h4>
            </div>
            <div class="card-body">
                
                <?php echo form_open_multipart('index.php/C_Barang/inputData'); ?>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo set_value('nama'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control" name="harga" id="harga" value="<?php echo set_value('harga'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok" value="<?php echo set_value('stok'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" name="foto" id="foto" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success w-100">
                        <i class="bi bi-check-circle"></i> Simpan Produk
                    </button>
                    
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>