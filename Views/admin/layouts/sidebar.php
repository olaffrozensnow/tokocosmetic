<!-- SIDEBAR -->
<?php $uri = service('uri'); ?>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-sparkles"></i>
            <span>Toko</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('admin/product') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'product') ? 'active' : '' ?>">
                <i class="fas fa-box"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('admin/pesanan') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'pesanan') ? 'active' : '' ?>">
                <i class="fas fa-shopping-cart"></i>
                <span>Pesanan</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('admin/users') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'users') ? 'active' : '' ?>">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('admin/pengiriman') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'pengiriman') ? 'active' : '' ?>">
                <i class="fas fa-truck"></i>
                <span>Pengiriman</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="<?= base_url('admin/categories') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'categories') ? 'active' : '' ?>">
                <i class="fas fa-tags"></i>
                <span>Kategori</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="<?= base_url('admin/feedback') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'feedback') ? 'active' : '' ?>">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a>
        </li>

        <li class="nav-item" style="margin-top: 30px; border-top: 2px solid var(--border-color); padding-top: 20px;">
            <a href="<?= base_url('admin/logout') ?>"
                class="nav-link <?= ($uri->getSegment(2) == 'logout') ? 'active' : '' ?>">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </nav>
</aside>