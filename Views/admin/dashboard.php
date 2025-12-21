<?= $this->include('admin/layouts/header') ?>
<?= $this->include('admin/layouts/sidebar') ?>

<div class="main-content">
    <?= $this->include('admin/layouts/topbar') ?>

    <div class="content">
        <div class="page-header">
            <h1><i class="fas fa-chart-line"></i> Dashboard</h1>
            <p>Selamat datang kembali, <?= esc($adminName) ?>! 👋</p>
        </div>

        <div class="card" style="margin-bottom: 20px;">
            <div class="card-body" style="padding: 15px;">
                <form method="get" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="?filter=all" class="btn <?= $filterType == 'all' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-calendar-alt"></i> Semua Data
                        </a>
                        <a href="?filter=today"
                            class="btn <?= $filterType == 'today' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-calendar-day"></i> Hari Ini
                        </a>
                        <!-- <a href="?filter=week"
                            class="btn <?= $filterType == 'week' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-calendar-week"></i> Minggu Ini
                        </a> -->
                        <a href="?filter=month"
                            class="btn <?= $filterType == 'month' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-calendar"></i> Bulan Ini
                        </a>
                        <!-- <a href="?filter=year"
                            class="btn <?= $filterType == 'year' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-calendar"></i> Tahun Ini
                        </a> -->
                    </div>
                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                        <label style="font-size: 0.875rem; color: #475569;">Dari:</label>
                        <input type="date" name="startDate" value="<?= $startDate ?>"
                            style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.875rem;">
                        <label style="font-size: 0.875rem; color: #475569;">Sampai:</label>
                        <input type="date" name="endDate" value="<?= $endDate ?>"
                            style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.875rem;">
                      
<!-- <label style="font-size: 0.875rem; color: #475569;">Status:</label> -->
<!-- 
<select name="status" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.875rem;">
    
    <?php $s = $status ?? 'all'; ?>
    
    <option value="all" <?= $s === 'all' ? 'selected' : '' ?>>Semua Status</option>
    <option value="Sukses" <?= $s === 'Sukses' ? 'selected' : '' ?>>Sukses</option>
    <option value="Menunggu Pembayaran" <?= $s === 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
    <option value="Menunggu Verifikasi" <?= $s === 'Menunggu Verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
    <option value="Diproses" <?= $s === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
    <option value="Dikirim" <?= $s === 'Dikirim' ? 'selected' : '' ?>>Dikirim</option> <option value="Gagal" <?= $s === 'Gagal' ? 'selected' : '' ?>>Gagal</option>
    <option value="Refund" <?= $s === 'Refund' ? 'selected' : '' ?>>Refund</option>
    <option value="Refund Sebagian" <?= $s === 'Refund Sebagian' ? 'selected' : '' ?>>Refund Sebagian</option>
    <option value="Dibatalkan" <?= $s === 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
</select> -->

                        <button type="submit" name="filter" value="custom"
                            class="btn <?= $filterType == 'custom' ? 'btn-primary' : 'btn-secondary' ?>"
                            style="font-size: 0.875rem; padding: 8px 12px;">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-value"><?= $totalProduk ?></div>
                <div class="stat-label">Total Produk</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <?php 
                        $stokTersedia = 0;
                        foreach ($produk as $p) {
                            $stokTersedia += $p['Stok'];
                        }
                        echo $stokTersedia . ' Stok';
                    ?>
                </div>
            </div>

            <div class="stat-card pink">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value"><?= $totalPesanan ?></div>
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <?php 
                        $pesananProses = 0;
                        foreach ($pesanan as $p) {
                            if ($p['StatusOrder'] !== 'Selesai') {
                                $pesananProses++;
                            }
                        }
                        echo $pesananProses . ' Diproses';
                    ?>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?= $totalPengguna ?></div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> Pengguna Aktif
                </div>
            </div>

            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></div>
                <div class="stat-label">Total Pendapatan <span
                        style="font-size: 0.75rem; color: #64748b;"><?= $filterLabel ?></span></div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> Dari <?= count($pesananTerbaru) ?> Pesanan
                </div>
            </div>
        </div>

        <div class="tables-section" style="margin-top: 25px;">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-receipt"></i> Pesanan <?= $filterLabel ?></h2>
                    <!-- <button class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i> Lihat Semua
                    </button> -->
                </div>
                <div class="card-body">
                    <?php if (!empty($pesananTerbaru)): ?>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">No.
                                        Pesanan</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">
                                        Pelanggan</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">
                                        Tanggal</th>
                                    <th style="padding: 12px; text-align: right; font-weight: 600; color: #334155;">
                                        Total</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 600; color: #334155;">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesananTerbaru as $order): ?>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 12px; color: #475569;">
                                        <strong><?= esc($order['orderID']) ?></strong>
                                    </td>
                                    <td style="padding: 12px; color: #475569;"><?= esc($order['UserName']) ?></td>
                                    <td style="padding: 12px; color: #475569;">
                                        <?= date('d M Y', strtotime($order['TanggalOrder'])) ?></td>
                                    <td style="padding: 12px; text-align: right; color: #475569;"><strong>Rp
                                            <?= number_format($order['TotalHarga'], 0, ',', '.') ?></strong></td>
                                    <td style="padding: 12px; text-align: center;">
                                        <?php 
                                                    $statusColor = match($order['StatusOrder']) {
                                                        'Menunggu Pembayaran' => '#fbbf24',
                                                        'Diproses' => '#60a5fa',
                                                        'Dikirim' => '#34d399',
                                                        'Selesai' => '#10b981',
                                                        'Dibatalkan' => '#ef4444',
                                                        default => '#6b7280'
                                                    };
                                                    $statusBg = match($order['StatusOrder']) {
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
                                            <?= esc($order['StatusOrder']) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                        Belum ada pesanan untuk periode ini
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-star"></i> Produk Terlaris <?= $filterLabel ?></h2>
                    <!-- <button class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i> Lihat Semua
                    </button> -->
                </div>
                <div class="card-body">
                    <?php if (!empty($produkTerlaris)): ?>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Nama
                                        Produk</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #334155;">Merek
                                    </th>
                                    <th style="padding: 12px; text-align: right; font-weight: 600; color: #334155;">
                                        Harga</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 600; color: #334155;">
                                        Terjual</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 600; color: #334155;">
                                        Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produkTerlaris as $prod): ?>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 12px; color: #475569;">
                                        <strong><?= esc($prod['productName']) ?></strong>
                                    </td>
                                    <td style="padding: 12px; color: #475569;"><?= esc($prod['merk']) ?></td>
                                    <td style="padding: 12px; text-align: right; color: #475569;">Rp
                                        <?= number_format($prod['Harga'], 0, ',', '.') ?></td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span
                                            style="background-color: #e0e7ff; color: #4f46e5; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                            <?= $prod['totalTerjual'] ?> pcs
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <?php 
                                                    $stokColor = $prod['Stok'] > 5 ? '#10b981' : ($prod['Stok'] > 0 ? '#f59e0b' : '#ef4444');
                                                    $stokBg = $prod['Stok'] > 5 ? '#d1fae5' : ($prod['Stok'] > 0 ? '#fef3c7' : '#fee2e2');
                                                ?>
                                        <span
                                            style="background-color: <?= $stokBg ?>; color: <?= $stokColor ?>; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                            <?= $prod['Stok'] ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fas fa-box-open" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                        Belum ada penjualan produk untuk periode ini
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/layouts/footer') ?>