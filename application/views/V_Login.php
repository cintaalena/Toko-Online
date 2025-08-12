<div class="row justify-content-center my-5">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body p-4">
                
                <?php if($this->session->flashdata('error_login')): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($this->session->flashdata('error_login'), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('index.php/C_Auth/proses_login'); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                <?php echo form_close(); ?>
                <div class="text-center mt-3">
                <p>Belum punya akun? <a href="<?php echo site_url('index.php/C_Auth/register'); ?>">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>