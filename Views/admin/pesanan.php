<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <?= $this->include('admin/layouts/header') ?>
    <?= $this->include('admin/layouts/sidebar') ?>

    <div class="main-content">
        <?= $this->include('admin/layouts/topbar') ?>

        <div class="content">
            <div class="page-header">
                <div class="header-left">
                    <h1><i class="fas fa-shopping-cart"></i> Data Pesanan</h1>
                    <p class="subtitle">Kelola dan pantau semua pesanan pelanggan</p>
                </div>
            </div>

            <div class="form-card">
                <?php if (!empty($pesanan)): ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Order ID
                                </th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Nama
                                    Pelanggan</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Alamat
                                    Pengiriman</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Tanggal
                                    Order</th>
                                <th style="padding: 12px; text-align: right; font-weight: 600; color: #334155;">Total
                                    Harga</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">
                                    Pembayaran</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #334155;">Status
                                </th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #334155;">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesanan as $row): ?>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px; color: #475569;">
                                    <strong><?= esc($row['orderID']) ?></strong>
                                </td>
                                <td style="padding: 12px; color: #475569;"><?= esc($row['Nama_Pelanggan']) ?></td>
                                <td style="padding: 12px; color: #475569; max-width: 250px;">
                                    <?= esc($row['Alamat_Pengiriman']) ?></td>
                                <td style="padding: 12px; color: #475569;">
                                    <?= date('d M Y', strtotime($row['TanggalOrder'])) ?>
                                </td>
                                <td style="padding: 12px; text-align: right; color: #475569;">
                                    <strong>Rp <?= number_format($row['TotalHarga'], 0, ',', '.') ?></strong>
                                </td>
                                <td style="padding: 12px; color: #475569;">
                                    <?php
                                    $paymentMethod = match($row['metodePembayaran']) {
                                        'qris' => 'QRIS',
                                        'bank_trans' => 'Bank Transfer',
                                        'cstore' => 'Convenience Store',
                                        default => $row['metodePembayaran'] ?? '-'
                                    };
                                    echo esc($paymentMethod);
                                    ?>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <?php 
                                        $statusColor = match($row['StatusOrder']) {
                                            'Menunggu Pembayaran' => '#fbbf24',
                                            'Diproses' => '#60a5fa',
                                            'Dikirim' => '#34d399',
                                            'Selesai' => '#10b981',
                                            'Dibatalkan' => '#ef4444',
                                            default => '#6b7280'
                                        };
                                        $statusBg = match($row['StatusOrder']) {
                                            'Menunggu Pembayaran' => '#fef3c7',
                                            'Diproses' => '#dbeafe',
                                            'Dikirim' => '#d1fae5',
                                            'Selesai' => '#d1fae5',
                                            'Dibatalkan' => '#fee2e2',
                                            default => '#f3f4f6'
                                        };
                                    ?>
                                    <span
                                        style="background-color: <?= $statusBg ?>; color: <?= $statusColor ?>; padding: 6px 12px; border-radius: 6px; font-size: 0.875rem; font-weight: 600;">
                                        <?= esc($row['StatusOrder']) ?>
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <a href="javascript:void(0);" class="btn-detail"
                                        data-order-id="<?= esc($row['orderID']) ?>">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p style="text-align: center; padding: 40px; color: #64748b;">
                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                    Belum ada pesanan
                </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Modal Receipt -->
        <div class="modal fade receipt-modal" id="receiptModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="receipt-header">
                        <div class="receipt-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="receipt-title">Detail Pesanan</div>
                        <div class="receipt-order-id" id="orderIdDisplay">Order #-</div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close" style="position: absolute; top: 15px; right: 15px;"></button>
                    </div>

                    <div class="receipt-body" id="receiptContent">
                        <!-- Loading State -->
                        <div class="loading-spinner" id="loadingState">
                            <div class="spinner"></div>
                            <div class="loading-text">Memuat data pesanan...</div>
                        </div>

                        <!-- Content will be loaded here -->
                        <div id="receiptData" style="display: none;">
                            <div class="receipt-info">
                                <div class="info-row">
                                    <span class="info-label"><i class="fas fa-user"></i> Pelanggan</span>
                                    <span class="info-value" id="customerName">-</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><i class="fas fa-calendar"></i> Tanggal</span>
                                    <span class="info-value" id="orderDate">-</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><i class="fas fa-credit-card"></i> Pembayaran</span>
                                    <span class="info-value" id="paymentMethod">-</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><i class="fas fa-tag"></i> Status</span>
                                    <span class="info-value" id="orderStatus">-</span>
                                </div>
                            </div>

                            <div class="receipt-items">
                                <div class="items-header">
                                    <i class="fas fa-shopping-bag"></i>
                                    Item Pesanan
                                </div>
                                <div id="itemsList">
                                    <!-- Items will be loaded here -->
                                </div>
                            </div>

                            <div class="receipt-summary">
                                <div class="summary-row">
                                    <span class="summary-label">Subtotal</span>
                                    <span class="summary-value" id="subtotalAmount">Rp 0</span>
                                </div>

                                <div class="summary-row">
                                    <span class="summary-label summary-total">Total Pembayaran</span>
                                    <span class="summary-value summary-total" id="totalAmount">Rp 0</span>
                                </div>
                            </div>

                            <div class="receipt-footer">
                                <div class="thank-you">Terima Kasih Atas Pesanan Anda!</div>
                                <div class="footer-note">Pesanan akan diproses secepatnya</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer-custom">
                        <button type="button" class="btn-print" onclick="window.print()">
                            <i class="fas fa-print"></i>
                            Cetak Receipt
                        </button>
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery - WAJIB DIMUAT PERTAMA -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->include('admin/layouts/footer') ?>

    <style>
    .content {
        padding: 24px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .header-left h1 {
        font-size: 1.75rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-left h1 i {
        color: #6366f1;
    }

    .subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin: 0;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        padding: 32px;
        border: 1px solid #e2e8f0;
    }

    table tbody tr {
        transition: background-color 0.2s ease;
    }

    table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .btn-detail {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        border: none;
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        text-decoration: none;
        color: white;
    }

    /* Modal Receipt Styles */
    .receipt-modal .modal-dialog {
        max-width: 600px;
    }

    .receipt-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .receipt-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        text-align: center;
        color: white;
        position: relative;
    }

    .receipt-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        right: 0;
        height: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        clip-path: polygon(0 0, 5% 50%, 10% 0, 15% 50%, 20% 0, 25% 50%, 30% 0, 35% 50%,
                40% 0, 45% 50%, 50% 0, 55% 50%, 60% 0, 65% 50%, 70% 0, 75% 50%,
                80% 0, 85% 50%, 90% 0, 95% 50%, 100% 0, 100% 100%, 0 100%);
    }

    .receipt-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        backdrop-filter: blur(10px);
    }

    .receipt-icon i {
        font-size: 2rem;
    }

    .receipt-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .receipt-order-id {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .receipt-body {
        background: white;
        padding: 30px;
    }

    .receipt-info {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #e2e8f0;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .info-label {
        color: #64748b;
        font-weight: 500;
    }

    .info-value {
        color: #1e293b;
        font-weight: 600;
        text-align: right;
    }

    .receipt-items {
        margin-bottom: 25px;
    }

    .items-header {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: start;
        padding: 15px;
        margin-bottom: 10px;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .item-row:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .item-meta {
        display: flex;
        gap: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .item-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .item-price {
        text-align: right;
    }

    .item-subtotal {
        font-weight: 700;
        color: #667eea;
        font-size: 1rem;
    }

    .receipt-summary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: white;
    }

    .summary-row:last-child {
        margin-bottom: 0;
        padding-top: 12px;
        border-top: 2px solid rgba(255, 255, 255, 0.3);
    }

    .summary-label {
        font-weight: 500;
        opacity: 0.9;
    }

    .summary-value {
        font-weight: 700;
    }

    .summary-total {
        font-size: 1.3rem;
    }

    .receipt-footer {
        text-align: center;
        padding-top: 20px;
        border-top: 2px dashed #e2e8f0;
    }

    .thank-you {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .footer-note {
        font-size: 0.85rem;
        color: #94a3b8;
    }

    .modal-footer-custom {
        border-top: none;
        padding: 20px 30px;
        background: #f8fafc;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-print {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-print:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-close-modal {
        background: #f1f5f9;
        color: #475569;
        border: 2px solid #e2e8f0;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-close-modal:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
    }

    .loading-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        color: #667eea;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #e2e8f0;
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .loading-text {
        margin-top: 20px;
        font-weight: 600;
        color: #64748b;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-pending {
        background: #fef3c7;
        color: #f59e0b;
    }

    .status-processing {
        background: #dbeafe;
        color: #3b82f6;
    }

    .status-shipped {
        background: #d1fae5;
        color: #10b981;
    }

    .status-completed {
        background: #d1fae5;
        color: #059669;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #ef4444;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .receipt-modal .modal-content,
        .receipt-modal .modal-content * {
            visibility: visible;
        }

        .receipt-modal .modal-content {
            position: absolute;
            left: 0;
            top: 0;
        }

        .modal-footer-custom,
        .btn-close {
            display: none !important;
        }
    }

    @media (max-width: 768px) {
        .content {
            padding: 16px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .form-card {
            padding: 20px;
        }
    }
    </style>

    <script>
    // Cek apakah jQuery dan Bootstrap sudah loaded
    console.log('jQuery loaded:', typeof jQuery !== 'undefined' ? 'YES' : 'NO');
    console.log('jQuery version:', typeof jQuery !== 'undefined' ? jQuery.fn.jquery : 'N/A');
    console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined' ? 'YES' : 'NO');

    $(document).ready(function() {
        console.log('Document ready!');
        console.log('Number of .btn-detail buttons:', $('.btn-detail').length);

        // Gunakan event delegation untuk handle dynamic content
        $(document).on('click', '.btn-detail', function(e) {
            e.preventDefault();
            var orderID = $(this).data('order-id');
            console.log('Detail button clicked! Order ID:', orderID);

            if (!orderID) {
                alert('Order ID tidak ditemukan!');
                return;
            }

            viewDetail(orderID);
        });
    });

    function viewDetail(orderID) {
        console.log('viewDetail called with orderID:', orderID);

        // Cek apakah modal element ada
        const modalElement = document.getElementById('receiptModal');
        console.log('Modal element found:', modalElement !== null);

        if (!modalElement) {
            alert('Modal element tidak ditemukan! Pastikan ID modal adalah "receiptModal"');
            return;
        }

        // Cek apakah Bootstrap tersedia
        if (typeof bootstrap === 'undefined') {
            alert('Bootstrap JS belum dimuat! Pastikan Bootstrap JS sudah di-include.');
            return;
        }

        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        console.log('Modal should be visible now');

        document.getElementById('loadingState').style.display = 'flex';
        document.getElementById('receiptData').style.display = 'none';

        const url = '<?= base_url('admin/pesanan/getDetail') ?>/' + orderID;
        console.log('Fetching from URL:', url);

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('AJAX Success! Response:', response);

                if (!response.orderInfo || !response.items) {
                    console.error('Invalid response format:', response);
                    alert('Format response tidak valid!');
                    return;
                }

                const orderInfo = response.orderInfo;
                const items = response.items;

                const receiptData = {
                    orderID: orderInfo.orderID,
                    customer: orderInfo.Nama_Pelanggan,
                    date: new Date(orderInfo.TanggalOrder).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }),
                    payment: getPaymentMethodName(orderInfo.metodePembayaran),
                    status: orderInfo.StatusOrder,
                    items: items
                };

                console.log('Receipt data prepared:', receiptData);
                loadReceiptData(receiptData);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error!');
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response Status Code:', xhr.status);
                console.error('Response Text:', xhr.responseText);

                let errorMessage = 'Gagal memuat data pesanan';

                if (xhr.status === 404) {
                    errorMessage = 'URL tidak ditemukan (404). Periksa routing!';
                } else if (xhr.status === 500) {
                    errorMessage = 'Server error (500). Periksa controller/model!';
                } else if (xhr.status === 0) {
                    errorMessage = 'Tidak dapat menghubungi server. Periksa koneksi!';
                }

                document.getElementById('loadingState').innerHTML = `
                <div style="text-align: center; color: #ef4444;">
                    <i class="fas fa-exclamation-circle" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <div style="font-weight: 600; margin-bottom: 10px;">${errorMessage}</div>
                    <div style="font-size: 0.85rem; color: #94a3b8;">Status: ${xhr.status}</div>
                    <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 5px; max-width: 400px; margin-left: auto; margin-right: auto; word-break: break-all;">${xhr.responseText.substring(0, 200)}</div>
                </div>
            `;
            }
        });
    }

    function loadReceiptData(data) {
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('receiptData').style.display = 'block';

        document.getElementById('orderIdDisplay').textContent = 'Order #' + data.orderID;
        document.getElementById('customerName').textContent = data.customer;
        document.getElementById('orderDate').textContent = data.date;
        document.getElementById('paymentMethod').textContent = data.payment;

        const statusBadge = getStatusBadge(data.status);
        document.getElementById('orderStatus').innerHTML = statusBadge;

        let itemsHTML = '';
        let total = 0;

        data.items.forEach(function(item) {
            total += parseFloat(item.Subtotal);
            itemsHTML += `
            <div class="item-row">
                <div class="item-details">
                    <div class="item-name">${item.productName}</div>
                    <div class="item-meta">
                        <span><i class="fas fa-box"></i> ${item.jumlahItem} pcs</span>
                        <span><i class="fas fa-tag"></i> Rp ${formatNumber(item.Harga)}/pcs</span>
                    </div>
                </div>
                <div class="item-price">
                    <div class="item-subtotal">Rp ${formatNumber(item.Subtotal)}</div>
                </div>
            </div>
        `;
        });

        document.getElementById('itemsList').innerHTML = itemsHTML;
        document.getElementById('subtotalAmount').textContent = 'Rp ' + formatNumber(total);
        document.getElementById('totalAmount').textContent = 'Rp ' + formatNumber(total);
    }

    function getStatusBadge(status) {
        const statusMap = {
            'Menunggu Pembayaran': 'status-pending',
            'Diproses': 'status-processing',
            'Dikirim': 'status-shipped',
            'Selesai': 'status-completed',
            'Dibatalkan': 'status-cancelled'
        };

        const className = statusMap[status] || 'status-pending';
        return `<span class="status-badge ${className}">${status}</span>`;
    }

    function getPaymentMethodName(method) {
        const methods = {
            'qris': 'QRIS',
            'bank_trans': 'Bank Transfer',
            'cstore': 'Convenience Store'
        };
        return methods[method] || method || '-';
    }

    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }
    </script>