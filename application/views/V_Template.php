<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOKO MAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo site_url('index.php/C_Barang/display'); ?>">
                <i class="bi bi-shop"></i> <strong>TOKO MAMA</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                <?php if ($this->session->userdata('is_logged_in')): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Barang/display'); ?>"><i class="bi bi-house-door"></i> Home</a></li>
                    
                    <?php if ($this->session->userdata('role') == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Admin/dashboard'); ?>"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('role') == 'pembeli'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Cart/displayCart'); ?>"><i class="bi bi-cart"></i> Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Transaksi/lastStrukDisplay'); ?>"><i class="bi bi-receipt"></i> Struk Terakhir</a></li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <form action="<?php echo site_url('index.php/C_Auth/logout'); ?>" method="post" class="d-inline">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>

                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Barang/display'); ?>"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('index.php/C_Auth/login'); ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container my-5">
            <?php $this->load->view($content_view); ?>
        </div>
    </main>
    
    <footer class="bg-dark text-white text-center p-4 mt-auto">
        <div class="container"><p class="mb-0">© <?php echo date('Y'); ?> TOKO MAMA - All Rights Reserved.</p></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>