<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title><?= $title ?? 'Order Management' ?></title>
    <style>
    body {
        background-color: #f8f9fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-content {
        padding: 2rem;
    }

    .page-header {
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        margin-bottom: 2rem;
        border-left: 4px solid #64748b;
    }

    .page-header h1 {
        color: #1f2937;
        font-size: 1.875rem;
        font-weight: 600;
        margin: 0;
    }

    .page-header p {
        color: #6b7280;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }

    .search-section {
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        margin-bottom: 2rem;
    }

    .search-input {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #64748b;
        box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.1);
    }

    .btn-search {
        background-color: #64748b;
        border: 1px solid #64748b;
        color: white;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-search:hover {
        background-color: #475569;
        border-color: #475569;
        color: white;
    }

    .filter-tabs {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .filter-tabs .nav-tabs {
        border-bottom: none;
        margin: 0;
    }

    .filter-tabs .nav-link {
        border: none;
        border-radius: 0;
        color: #6b7280;
        font-weight: 500;
        padding: 1rem 1.5rem;
        background: none;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
    }

    .filter-tabs .nav-link:hover {
        background-color: #f9fafb;
        color: #64748b;
    }

    .filter-tabs .nav-link.active {
        background: #f9fafb;
        color: #64748b;
        border-bottom-color: #64748b;
    }

    .orders-table-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .table-header {
        background-color: #f9fafb;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .table-header h3 {
        margin: 0;
        color: #1f2937;
        font-size: 1.125rem;
        font-weight: 600;
    }

    .custom-table {
        margin: 0;
    }

    .custom-table th {
        background-color: #f9fafb;
        border: none;
        color: #374151;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .custom-table td {
        border: none;
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s;
    }

    .custom-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: capitalize;
        letter-spacing: 0.025em;
    }

    .bg-warning {
        background-color: #fef08a !important;
        color: #a16207 !important;
    }

    .bg-info {
        background-color: #bfdbfe !important;
        color: #1e40af !important;
    }

    .bg-primary {
        background-color: #c7d2fe !important;
        color: #4338ca !important;
    }

    .bg-success {
        background-color: #d1fae5 !important;
        color: #065f46 !important;
    }

    .bg-danger {
        background-color: #fee2e2 !important;
        color: #b91c1c !important;
    }

    .bg-secondary {
        background-color: #e5e7eb !important;
        color: #374151 !important;
    }


    .btn-view {
        background-color: #64748b;
        border: 1px solid #64748b;
        color: white;
        border-radius: 9999px;
        padding: 0.6rem 1.2rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-view:hover {
        background-color: #475569;
        border-color: #475569;
        color: white;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        color: #374151;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .price-text {
        font-weight: 600;
        color: #059669;
    }

    .order-id {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #64748b;
    }

    .customer-name {
        font-weight: 500;
        color: #374151;
    }

    .product-info {
        font-size: 0.875rem;
        color: #6b7280;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .address-text {
        font-size: 0.875rem;
        color: #6b7280;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .note-text {
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }

        .page-header,
        .search-section,
        .orders-table-section {
            padding: 1rem;
        }

        .table-responsive {
            border-radius: 8px;
        }

        .custom-table th,
        .custom-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }
    }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <div class="main-content">


        <div class="search-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" placeholder="Search by Order ID..."
                            id="searchInput">
                        <button class="btn btn-search" type="button">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="orders-table-section">
            <div class="table-header">
                <h3>Pesanan Saya</h3>
            </div>

            <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Tanggal Order</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Order</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr class="order-row">
                            <td>
                                <span class="order-id">#<?= $order['orderID'] ?></span>
                            </td>
                            <td>
                                <div class="text-muted">
                                    <?= date('d F Y, H:i', strtotime($order['TanggalOrder'])) ?>
                                </div>
                            </td>
                            <td>
                                <div class="price-text">Rp <?= number_format($order['TotalHarga'], 0, ',', '.') ?></div>
                            </td>
                            <td>
                                <div class="small">
                                    <?= $order['metodePembayaran'] ?? 'Belum dipilih' ?>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge <?= $orderModel->getStatusBadge($order['StatusOrder']) ?>">
                                    <?= $orderModel->getStatusText($order['StatusOrder']) ?>
                                </span>
                            </td>
                            <!-- <td>
                                <a href="<?= base_url('orders/detail/' . $order['orderID']) ?>"
                                    class="btn btn-view btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <h4>Belum Ada Pesanan</h4>
                <p>Anda belum memiliki pesanan apapun. Mulai berbelanja sekarang!</p>
                <a href="<?= base_url('products') ?>" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="toast show" role="alert">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
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
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.order-row').forEach(row => {
            const orderId = row.querySelector('.order-id').textContent.toLowerCase();
            const shouldShow = orderId.includes(searchTerm);
            row.style.display = shouldShow ? 'table-row' : 'none';
        });
    });


    setTimeout(function() {
        document.querySelectorAll('.toast').forEach(toast => {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
        });
    }, 5000);
    </script>
</body>

</html>