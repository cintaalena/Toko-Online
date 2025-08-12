<?php if ($this->session->flashdata('pesan_sukses')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo htmlspecialchars($this->session->flashdata('pesan_sukses'), ENT_QUOTES, 'UTF-8'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="p-5 mb-4 bg-light rounded-3 text-center">
    <h1 class="display-4">Selamat Datang di Toko Mama!</h1>
    <p class="lead">Temukan produk terbaik dengan penawaran paling menarik.</p>
</div>

<h2 class="text-center mb-4">Produk Terbaru Kami</h2>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php foreach ($barang as $brg): ?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="<?php echo base_url('assets/' . $brg->FOTO); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($brg->NAMA, ENT_QUOTES, 'UTF-8'); ?>" style="height: 200px; object-fit: cover;">
            
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo htmlspecialchars($brg->NAMA, ENT_QUOTES, 'UTF-8'); ?></h5>
                
                <p class="card-text text-danger fw-bold fs-5 mb-2">
                    Rp <?php echo number_format($brg->HARGA, 0, ',', '.'); ?>
                </p>
                <small class="text-muted">Stok: <?php echo htmlspecialchars($brg->STOK, ENT_QUOTES, 'UTF-8'); ?></small>
                
                <div class="mt-auto pt-3">
                    
                    <?php if ($this->session->userdata('is_logged_in')): ?>
                        <form action="<?php echo site_url('index.php/C_Cart/masukCart'); ?>" method="post">
                            <input type="hidden" name="id_barang" value="<?php echo $brg->ID; ?>">
                            <div class="input-group mb-2">
                                <input type="number" name="jumlah" class="form-control" value="1" min="1" max="<?php echo htmlspecialchars($brg->STOK, ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cart-plus"></i> Beli
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('role') == 'admin'): ?>
                        <a href="<?php echo site_url('index.php/C_Barang/formUpdateStok/' . $brg->ID); ?>" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-pencil-square"></i> Edit Stok
                        </a>

                        <button type="button" class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $brg->ID; ?>">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal<?php echo $brg->ID; ?>" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus barang "<strong><?php echo htmlspecialchars($brg->NAMA, ENT_QUOTES, 'UTF-8'); ?></strong>"?</p>
          </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    
    <?php echo form_open('index.php/C_Barang/hapusBarang'); ?>
        <input type="hidden" name="id_barang" value="<?php echo $brg->ID; ?>">
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    <?php echo form_close(); ?>
</div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
</div>