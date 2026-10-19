<div class="brand">stokmart</div>
<nav class="sidebar-nav">
    <a class="<?= $page === 'dashboard' ? 'active' : '' ?>" href="index.php?page=dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a class="<?= $page === 'orders' ? 'active' : '' ?>" href="index.php?page=orders"><i class="bi bi-receipt"></i> Orders</a>
    <a class="<?= $page === 'produk' ? 'active' : '' ?>" href="index.php?page=produk"><i class="bi bi-box-seam"></i> Products</a>
    <a class="<?= $page === 'customers' ? 'active' : '' ?>" href="index.php?page=customers"><i class="bi bi-people"></i> Customers</a>
</nav>
<a class="signout" href="#signout"><i class="bi bi-box-arrow-right"></i> Sign out</a>
