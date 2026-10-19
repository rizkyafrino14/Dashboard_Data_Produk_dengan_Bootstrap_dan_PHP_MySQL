<h1>Products</h1>

<section class="panel" id="products">
    <div class="panel-header">
        <h2>Data Produk</h2>
        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Add Product
        </button>
    </div>

    <?php if ($pesan !== ''): ?>
        <div class="alert alert-<?= $jenisPesan ?> py-2 px-3 small mx-3 mb-3">
            <?= e($pesan) ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-sm mb-0 product-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($jumlahProduk === 0): ?>
                    <tr>
                        <td colspan="5" class="empty">Belum ada data produk. Klik Add Product untuk menambahkan.</td>
                    </tr>
                <?php endif; ?>

                <?php mysqli_data_seek($hasilProduk, 0); ?>
                <?php while ($produk = mysqli_fetch_assoc($hasilProduk)): ?>
                    <tr>
                        <td><?= (int) $produk['id'] ?></td>
                        <td><?= e($produk['nama_barang']) ?></td>
                        <td><?= rupiah((int) $produk['harga']) ?></td>
                        <td><?= (int) $produk['stok'] ?></td>
                        <td>
                            <a class="action-link" href="#edit">Edit</a>
                            <form method="post" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                                <input type="hidden" name="aksi" value="hapus">
                                <input type="hidden" name="id" value="<?= (int) $produk['id'] ?>">
                                <button type="submit" class="action-link delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
