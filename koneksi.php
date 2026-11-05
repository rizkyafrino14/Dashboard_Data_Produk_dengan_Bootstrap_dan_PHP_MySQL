<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_produk";

$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// kode untuk memeriksa koneksi, tampilkan pesan kesalahan jika gagal
if (!$koneksi) {
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() .
        " - " . mysqli_connect_error());
}
?>
