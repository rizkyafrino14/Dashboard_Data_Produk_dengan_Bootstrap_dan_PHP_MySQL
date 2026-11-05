<?php
require_once("koneksi.php");

$pesan = "";
$jenisPesan = "success";

// Proses tambah atau hapus data produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aksi'])) {
        $aksi = $_POST['aksi'];
    } else {
        $aksi = "";
    }

    if ($aksi === "tambah") {
        if (isset($_POST['nama_barang'])) {
            $namaBarang = trim($_POST['nama_barang']);
        } else {
            $namaBarang = "";
        }

        if (isset($_POST['harga'])) {
            $harga = (int) $_POST['harga'];
        } else {
            $harga = 0;
        }

        if (isset($_POST['stok'])) {
            $stok = (int) $_POST['stok'];
        } else {
            $stok = 0;
        }

        if ($namaBarang == "" || $harga < 1 || $stok < 0) {
            $pesan = "Mohon isi data produk dengan benar.";
            $jenisPesan = "danger";
        } else {
            $queryTambah = mysqli_prepare(
                $koneksi,
                "INSERT INTO produk (nama_barang, harga, stok) VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param($queryTambah, 'sii', $namaBarang, $harga, $stok);
            mysqli_stmt_execute($queryTambah);
            mysqli_stmt_close($queryTambah);

            $pesan = "Produk berhasil ditambahkan.";
        }
    }

    if ($aksi === "hapus") {
        if (isset($_POST['id'])) {
            $idProduk = (int) $_POST['id'];
        } else {
            $idProduk = 0;
        }

        $queryHapus = mysqli_prepare($koneksi, "DELETE FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($queryHapus, 'i', $idProduk);
        mysqli_stmt_execute($queryHapus);
        mysqli_stmt_close($queryHapus);

        $pesan = "Produk berhasil dihapus.";
    }
}

function e($teks)
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

function rupiah($jumlah)
{
    return 'Rp ' . number_format($jumlah, 0, ',', '.');
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "dashboard";
}

$judulHalaman = array(
    "dashboard" => "Dashboard",
    "produk" => "Products",
    "orders" => "Orders",
    "customers" => "Customers"
);

if (isset($judulHalaman[$page])) {
    $judulTopbar = $judulHalaman[$page];
} else {
    $judulTopbar = "Dashboard";
}

$hasilProduk = mysqli_query(
    $koneksi,
    "SELECT id, nama_barang, harga, stok FROM produk ORDER BY id DESC"
);
$jumlahProduk = mysqli_num_rows($hasilProduk);
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar">
            <?php require 'menu.php'; ?>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <strong><?php echo e($judulTopbar); ?></strong>
                <div class="user-menu">
                    <i class="bi bi-bell"></i>
                    <span class="avatar">AR</span>
                </div>
            </header>

            <div class="content-wrap">
                <?php require 'content.php'; ?>
            </div>
        </main>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="nama_barang">Nama Barang</label>
                            <input class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <label class="form-label" for="harga">Harga</label>
                                <input class="form-control" id="harga" name="harga" type="number" min="1" required>
                            </div>
                            <div class="col-5">
                                <label class="form-label" for="stok">Stok</label>
                                <input class="form-control" id="stok" name="stok" type="number" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
