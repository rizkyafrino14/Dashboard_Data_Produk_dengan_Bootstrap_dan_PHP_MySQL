<?php
$daftarHalaman = [
    'dashboard' => 'pages/dashboard.php',
    'produk' => 'pages/produk.php',
    'orders' => 'pages/orders.php',
    'customers' => 'pages/customers.php',
];

if (isset($daftarHalaman[$page])) {
    require __DIR__ . '/' . $daftarHalaman[$page];
} else {
    echo '<h2>Halaman tidak ditemukan</h2>';
}
?>
