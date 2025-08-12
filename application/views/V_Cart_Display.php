<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-cart3"></i> Keranjang Belanja Anda</h2>

    <?php if ($this->cart->total_items() > 0): ?>
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Harga Satuan</th>
                    <th class="text-end">Subtotal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->cart->contents() as $items): ?>
                <tr>
                    <td><?php echo htmlspecialchars($items['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center"><?php echo $items['qty']; ?></td>
                    <td class="text-end">Rp <?php echo number_format($items['price'], 0, ',', '.'); ?></td>
                    <td class="text-end">Rp <?php echo number_format($items['subtotal'], 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <form action="<?php echo site_url('index.php/C_Cart/hapusItem'); ?>" method="post" class="d-inline">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="rowid" value="<?php echo $items['rowid']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus item ini">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end"><h4>Total</h4></th>
                    <th class="text-end"><h4>Rp <?php echo number_format($this->cart->total(), 0, ',', '.'); ?></h4></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="<?php echo site_url('index.php/C_Barang/display'); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Lanjut Belanja</a>
            <div>
                <form action="<?php echo site_url('index.php/C_Cart/deleteCart'); ?>" method="post" class="d-inline">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                     <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Kosongkan Keranjang</button>
                </form>

                <a href="<?php echo site_url('index.php/C_Cart/checkOutCart'); ?>" class="btn btn-success"><i class="bi bi-box-arrow-right"></i> Lanjut ke Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Keranjang belanja Anda masih kosong.</div>
        <div class="text-center">
             <a href="<?php echo site_url('index.php/C_Barang/display'); ?>" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Mulai Belanja</a>
        </div>
    <?php endif; ?>
</div>