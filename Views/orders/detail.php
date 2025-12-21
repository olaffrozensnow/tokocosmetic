<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title><?= $title ?? 'Order Detail' ?></title>
    <style>
    .order-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
    }

    .detail-card {
        border: none;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
    }

    .product-item {
        padding: 1.5rem;
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s;
    }

    .product-item:hover {
        background-color: #f8f9fa;
    }

    .product-item:last-child {
        border-bottom: none;
        border-radius: 0 0 15px 15px;
    }

    .price-highlight {
        font-size: 1.2rem;
        font-weight: bold;
        color: #28a745;
    }

    .info-section {
        background: linear-gradient(45deg, #f8f9fa, #ffffff);
        border-radius: 10px;
        padding: 1.5rem;
        border-left: 4px solid #667eea;
    }

    .status-badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 25px;
    }

    .breadcrumb-custom {
        background: none;
        padding: 0;
        margin-bottom: 2rem;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #6c757d;
    }

    .summary-card {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-radius: 15px;
    }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>

    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('orders') ?>">
                        <i class="fas fa-shopping-bag me-1"></i>Pesanan Saya
                    </a>
                </li>
                <li class="breadcrumb-item active">Detail Pesanan #<?= $orderID ?></li>
            </ol>
        </nav>

        <?php if (!empty($orderDetails)): ?>
        <?php 
            $firstOrder = $orderDetails[0];
            $statusClass = match($firstOrder['StatusOrder']) {
                'pending' => 'bg-warning',
                'processing' => 'bg-info',
                'shipped' => 'bg-primary',
                'delivered', 'received' => 'bg-success',
                'cancelled' => 'bg-danger',
                default => 'bg-secondary'
            };
            $statusText = match($firstOrder['StatusOrder']) {
                'pending' => 'Menunggu Konfirmasi',
                'processing' => 'Sedang Diproses',
                'shipped' => 'Sedang Dikirim',
                'delivered' => 'Terkirim',
                'received' => 'Diterima',
                'cancelled' => 'Dibatalkan',
                default => 'Status Tidak Dikenal'
            };
            ?>

        <!-- Order Header -->
        <div class="order-header p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-receipt me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h3 class="mb-2 fw-bold">Order #<?= $orderID ?></h3>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-calendar me-2"></i>
                                Dipesan pada <?= date('d F Y, H:i', strtotime($firstOrder['TanggalOrder'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge <?= $statusClass ?> status-badge">
                        <i class="fas fa-info-circle me-1"></i>
                        <?= $statusText ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Product Details -->
            <div class="col-lg-8 mb-4">
                <div class="detail-card">
                    <div class="card-header bg-white border-0 p-4">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-box me-2 text-primary"></i>
                            Detail Produk
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php foreach ($orderDetails as $index => $item): ?>
                        <div class="product-item">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="mb-2 fw-bold"><?= esc($item['productName']) ?></h6>
                                    <div class="text-muted">
                                        <small>
                                            <i class="fas fa-tag me-1"></i>
                                            Harga Satuan: Rp <?= number_format($item['Harga'], 0, ',', '.') ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-cubes text-muted me-2"></i>
                                        <span class="fw-semibold">
                                            <?= $item['Kuantitas'] ?? 1 ?> pcs
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 text-end">
                                    <div class="price-highlight">
                                        Rp <?= number_format($item['SubTotal'] ?? $item['Harga'], 0, ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Order Summary & Info -->
            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="summary-card p-4 mb-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-calculator me-2"></i>
                        Ringkasan Pesanan
                    </h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah Item:</span>
                        <span class="fw-semibold"><?= count($orderDetails) ?> produk</span>
                    </div>

                    <?php 
                        $subtotal = 0;
                        foreach($orderDetails as $item) {
                            $subtotal += $item['SubTotal'] ?? $item['Harga'];
                        }
                        ?>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,0.3);">

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-5">
                            Rp <?= number_format($firstOrder['TotalHarga'], 0, ',', '.') ?>
                        </span>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="detail-card mb-4">
                    <div class="info-section">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-credit-card me-2 text-primary"></i>
                            Informasi Pembayaran
                        </h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-money-bill-wave text-success me-2"></i>
                                    <span class="text-muted me-2">Metode:</span>
                                    <span class="fw-semibold">
                                        <?= $firstOrder['metodePembayaran'] ?? 'Belum dipilih' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid">
                    <a href="<?= base_url('orders') ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-search" style="font-size: 4rem; color: #e9ecef;"></i>
            <h4 class="mt-3 text-muted">Pesanan Tidak Ditemukan</h4>
            <p class="text-muted">Pesanan yang Anda cari tidak ditemukan atau tidak dapat diakses.</p>
            <a href="<?= base_url('orders') ?>" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Daftar Pesanan
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Success/Error Messages -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="toast show" role="alert">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Berhasil</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="toast show" role="alert">
            <div class="toast-header bg-danger text-white">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
    setTimeout(function() {
        document.querySelectorAll('.toast').forEach(toast => {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
        });
    }, 5000);

    document.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    </script>
</body>

</html>