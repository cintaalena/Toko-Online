<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Admin Dashboard</h4>
        </div>
        <div class="card-body">
            
            <h5 class="card-title">Selamat Datang, <?php echo htmlspecialchars($this->session->userdata('username'), ENT_QUOTES, 'UTF-8'); ?>!</h5>

            <p class="card-text">Anda telah login sebagai administrator. Dari sini Anda dapat mengelola produk, melihat transaksi, dan mengatur pengguna.</p>
            <hr>

            <a href="<?php echo site_url('index.php/C_Barang/formInputData'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Produk Baru
            </a>

            <a href="<?php echo site_url('index.php/C_Admin/kelola_pengguna'); ?>" class="btn btn-secondary">
                <i class="bi bi-people-fill"></i> Kelola Pengguna
            </a>

        </div>
    </div>
</div>