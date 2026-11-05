<?php
// Ambil nama produk dan stok untuk ditampilkan sebagai grafik.
$hasilGrafik = mysqli_query(
    $koneksi,
    "SELECT nama_barang, stok FROM produk ORDER BY stok DESC"
);

$dataGrafik = array();
$totalStok = 0;
$stokTerbanyak = 0;

while ($produkGrafik = mysqli_fetch_assoc($hasilGrafik)) {
    $dataGrafik[] = $produkGrafik;
    $totalStok = $totalStok + $produkGrafik['stok'];

    if ($produkGrafik['stok'] > $stokTerbanyak) {
        $stokTerbanyak = $produkGrafik['stok'];
    }
}
?>

<h1>Dashboard</h1>
<p>Selamat datang di XSATA-STORE.</p>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h2 class="h6 text-muted">Jumlah Produk</h2>
                <p class="display-6 mb-0"><?php echo $jumlahProduk; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h2 class="h6 text-muted">Jumlah Stok</h2>
                <p class="display-6 mb-0"><?php echo $totalStok; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Grafik Stok Produk</h2>
        <p class="text-muted small">Perbandingan jumlah stok setiap produk.</p>

        <?php if (count($dataGrafik) == 0): ?>
            <p class="text-muted mb-0">Belum ada data produk untuk ditampilkan.</p>
        <?php else: ?>
            <?php foreach ($dataGrafik as $produkGrafik): ?>
                <?php
                $persentaseStok = 0;

                if ($stokTerbanyak > 0) {
                    $persentaseStok = ($produkGrafik['stok'] / $stokTerbanyak) * 100;
                }
                ?>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><?php echo e($produkGrafik['nama_barang']); ?></span>
                        <span><?php echo $produkGrafik['stok']; ?> unit</span>
                    </div>
                    <div class="progress" role="progressbar"
                        aria-label="Stok <?php echo e($produkGrafik['nama_barang']); ?>"
                        aria-valuenow="<?php echo $persentaseStok; ?>"
                        aria-valuemin="0"
                        aria-valuemax="100">
                        <div class="progress-bar bg-primary" style="width: <?php echo $persentaseStok; ?>%"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
