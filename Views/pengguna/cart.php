<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-aZWcn9TpthugVNd1"></script>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
        min-height: 100vh;
    }

    .cart-container {
        padding: 120px 20px 50px;
        min-height: 100vh;
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .cart-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .cart-header h2 {
        font-size: clamp(2rem, 6vw, 3rem);
        font-weight: 700;
        color: #212529;
    }

    .empty-cart {
        text-align: center;
        background: #fff;
        border-radius: 15px;
        padding: 80px 40px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
    }

    .empty-cart i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 30px;
        display: block;
    }

    .empty-cart p {
        color: #888;
        font-size: 1.1em;
        margin-bottom: 30px;
    }

    .continue-shopping {
        display: inline-block;
        padding: 12px 25px;
        background-color: #4a76a8;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 118, 168, 0.2);
    }

    .continue-shopping:hover {
        transform: translateY(-2px);
        background-color: #3b608a;
    }

    .cart-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
        align-items: start;
    }

    .cart-items {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
    }

    .select-all {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
    }

    .select-all input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #4a76a8;
    }

    .select-all label {
        font-weight: 600;
        cursor: pointer;
    }

    .selected-count {
        background-color: #e9ecef;
        color: #4a76a8;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-left: auto;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border: 1px solid #f0f0f0;
        border-radius: 15px;
        position: relative;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }

    .cart-item:last-child {
        margin-bottom: 0;
    }

    .cart-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border-color: #4a76a8;
    }

    .item-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #4a76a8;
        cursor: pointer;
    }

    .product-details {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-grow: 1;
    }

    .product-details img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        background: #f8f9fa;
        padding: 5px;
    }

    .product-info h4 {
        margin: 0 0 5px;
        font-size: 1rem;
        font-weight: 600;
    }

    .product-info .price {
        color: #4a76a8;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .item-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f1f3f5;
        border-radius: 50px;
        padding: 5px;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border: none;
        background-color: #4a76a8;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background-color: #3b608a;
    }

    .qty-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .qty-input {
        width: 40px;
        text-align: center;
        border: none;
        background: transparent;
        font-size: 1rem;
        font-weight: 600;
    }

    .item-subtotal {
        font-size: 1.1rem;
        font-weight: 700;
        min-width: 100px;
        text-align: right;
    }

    .remove-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 25px;
        height: 25px;
        border: none;
        background: #e74c3c;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .cart-item:hover .remove-btn {
        opacity: 1;
    }

    .remove-btn:hover {
        background: #c0392b;
        transform: scale(1.1);
    }

    .cart-summary {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 120px;
    }

    .summary-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
    }

    .alamat-section {
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .alamat-section h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-tambah-alamat {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-tambah-alamat:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    .alamat-dropdown {
        position: relative;
        margin-bottom: 20px;
    }

    .selected-alamat {
        border: 2px solid #4a76a8;
        border-radius: 10px;
        padding: 15px;
        cursor: pointer;
        background-color: #fff;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .selected-alamat:hover {
        background-color: #f8f9fa;
        box-shadow: 0 2px 8px rgba(74, 118, 168, 0.1);
    }

    .selected-alamat .alamat-info {
        flex: 1;
    }

    .selected-alamat .alamat-info h5 {
        margin: 0 0 8px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
    }

    .selected-alamat .alamat-info p {
        margin: 0;
        font-size: 0.85rem;
        color: #666;
        line-height: 1.5;
    }

    .selected-alamat .dropdown-icon {
        font-size: 1.2rem;
        color: #4a76a8;
        transition: transform 0.3s ease;
    }

    .selected-alamat.open .dropdown-icon {
        transform: rotate(180deg);
    }

    .alamat-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 2px solid #4a76a8;
        border-radius: 10px;
        max-height: 300px;
        overflow-y: auto;
        margin-top: 5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: none;
    }

    .alamat-list.show {
        display: block;
    }

    .alamat-item {
        border-bottom: 1px solid #e9ecef;
        padding: 15px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .alamat-item:last-child {
        border-bottom: none;
    }

    .alamat-item:hover {
        background-color: #f8f9fa;
    }

    .alamat-item.active {
        background-color: #e7f3ff;
    }

    .alamat-item .alamat-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #4a76a8;
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .alamat-item h5 {
        margin: 0 0 8px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        padding-right: 80px;
    }

    .alamat-item p {
        margin: 0;
        font-size: 0.85rem;
        color: #666;
        line-height: 1.5;
    }

    .no-alamat {
        padding: 20px;
        text-align: center;
        color: #888;
        font-size: 0.9rem;
    }

    .manage-alamat-section {
        margin-top: 20px;
    }

    .manage-alamat-section h5 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #666;
    }

    .manage-alamat-section .alamat-item {
        margin-bottom: 10px;
        border: 1px solid #e9ecef;
        border-radius: 10px;
    }

    .alamat-actions {
        margin-top: 10px;
        display: flex;
        gap: 8px;
    }

    .btn-edit-alamat,
    .btn-hapus-alamat {
        padding: 5px 12px;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-edit-alamat {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-edit-alamat:hover {
        background-color: #e0a800;
    }

    .btn-hapus-alamat {
        background-color: #dc3545;
        color: white;
    }

    .btn-hapus-alamat:hover {
        background-color: #c82333;
    }

    .alamat-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .alamat-form .form-group {
        margin-bottom: 15px;
    }

    .alamat-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .alamat-form input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .alamat-form input:focus {
        outline: none;
        border-color: #4a76a8;
    }

    .alamat-form .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .alamat-form button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-save-alamat {
        background-color: #28a745;
        color: white;
    }

    .btn-save-alamat:hover {
        background-color: #218838;
    }

    .btn-cancel-alamat {
        background-color: #6c757d;
        color: white;
    }

    .btn-cancel-alamat:hover {
        background-color: #5a6268;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .summary-row.total {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.25em;
        padding-top: 20px;
        color: #4a76a8;
    }

    .summary-label {
        color: #666;
    }

    .summary-value {
        font-weight: 600;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 15px;
        text-align: center;
        background-color: #4a76a8;
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 1.1em;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 25px;
    }

    .checkout-btn.loading,
    .checkout-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .checkout-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        background-color: #3b608a;
    }

    .hidden {
        display: none !important;
    }

    @media (max-width: 992px) {
        .cart-content {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .cart-item {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .item-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .item-subtotal {
            text-align: left;
        }
    }
    </style>
</head>

<body>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?= $this->include('layouts/navbar') ?>

    <div class="cart-container">
        <div class="container">
            <div class="cart-header">
                <h2>Keranjang Belanja Anda</h2>
            </div>

            <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <p>Keranjang Anda masih kosong. Mari temukan sesuatu yang menarik!</p>
                <a href="<?= base_url('/pengguna/menuapp') ?>" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                </a>
            </div>

            <?php else: ?>
            <div class="cart-content">
                <div class="cart-items">
                    <div class="select-all">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll">Pilih Semua</label>
                        <span class="selected-count" id="selectedCount">0 item dipilih</span>
                    </div>

                    <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item" data-id="<?= esc($item['cartitemID']); ?>"
                        data-price="<?= esc($item['Harga']); ?>" data-quantity="<?= esc($item['Quantity']); ?>">
                        <input type="checkbox" class="item-checkbox" checked>

                        <div class="product-details">
                            <?php 
                                $imageBase64Data = $item['GambarProduct'] ?? null;
                                $imageSrc = !empty($imageBase64Data) ? "data:image/jpeg;base64," . $imageBase64Data : base_url('img/default.png');
                            ?>
                            <img src="<?= $imageSrc ?>" alt="<?= esc($item['productName']); ?>">
                            <div class="product-info">
                                <h4><?= esc($item['productName']); ?></h4>
                                <p class="price">Rp. <?= number_format($item['Harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>

                        <div class="item-actions">
                            <div class="quantity-controls">
                                <button class="qty-btn"
                                    onclick="updateQuantity('<?= esc($item['cartitemID']); ?>', -1)">−</button>
                                <input type="number" class="qty-input" value="<?= esc($item['Quantity']); ?>" min="1"
                                    readonly>
                                <button class="qty-btn"
                                    onclick="updateQuantity('<?= esc($item['cartitemID']); ?>', 1)">+</button>
                            </div>
                            <div class="item-subtotal">
                                Rp. <span
                                    class="subtotal-value"><?= number_format($item['Harga'] * $item['Quantity'], 0, ',', '.'); ?></span>
                            </div>
                        </div>

                        <button class="remove-btn" onclick="removeItem('<?= esc($item['cartitemID']); ?>')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>

                    <div class="alamat-section">
                        <h4>
                            Alamat Pengiriman
                            <button class="btn-tambah-alamat" onclick="showAlamatForm()">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </h4>

                        <?php if (!empty($alamatList)): ?>
                        <div class="alamat-dropdown">
                            <div class="selected-alamat" id="selected-alamat" onclick="toggleDropdown()">
                                <?php if ($alamat): ?>
                                <div class="alamat-info">
                                    <h5><?= esc($alamat['Label']); ?></h5>
                                    <p>
                                        <?= esc($alamat['Jalan']); ?><br>
                                        <?= esc($alamat['Kota']); ?>, <?= esc($alamat['Provinsi']); ?><br>
                                        <?= esc($alamat['KodePos']); ?>
                                    </p>
                                </div>
                                <?php else: ?>
                                <div class="alamat-info">
                                    <p style="color: #888;">Pilih alamat pengiriman</p>
                                </div>
                                <?php endif; ?>
                                <i class="fas fa-chevron-down dropdown-icon"></i>
                            </div>

                            <div class="alamat-list" id="alamat-list">
                                <?php foreach ($alamatList as $addr): ?>
                                <div class="alamat-item <?= ($alamat && $addr['alamatID'] == $alamat['alamatID']) ? 'active' : '' ?>"
                                    data-id="<?= esc($addr['alamatID']); ?>"
                                    onclick="selectAlamatFromDropdown('<?= esc($addr['alamatID']); ?>', event)">
                                    <?php if ($addr['IsPrimary'] == 1): ?>
                                    <span class="alamat-badge">Utama</span>
                                    <?php endif; ?>
                                    <h5><?= esc($addr['Label']); ?></h5>
                                    <p>
                                        <?= esc($addr['Jalan']); ?><br>
                                        <?= esc($addr['Kota']); ?>, <?= esc($addr['Provinsi']); ?><br>
                                        <?= esc($addr['KodePos']); ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="manage-alamat-section">
                            <h5>Kelola Alamat:</h5>
                            <?php foreach ($alamatList as $addr): ?>
                            <div class="alamat-item">
                                <?php if ($addr['IsPrimary'] == 1): ?>
                                <span class="alamat-badge">Utama</span>
                                <?php endif; ?>
                                <h5><?= esc($addr['Label']); ?></h5>
                                <p>
                                    <?= esc($addr['Jalan']); ?><br>
                                    <?= esc($addr['Kota']); ?>, <?= esc($addr['Provinsi']); ?><br>
                                    <?= esc($addr['KodePos']); ?>
                                </p>
                                <div class="alamat-actions" onclick="event.stopPropagation()">
                                    <button class="btn-edit-alamat"
                                        onclick="editAlamat('<?= esc($addr['alamatID']); ?>', '<?= esc($addr['Label']); ?>', '<?= esc($addr['Jalan']); ?>', '<?= esc($addr['Kota']); ?>', '<?= esc($addr['Provinsi']); ?>', '<?= esc($addr['KodePos']); ?>')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-hapus-alamat"
                                        onclick="deleteAlamat('<?= esc($addr['alamatID']); ?>')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <p class="no-alamat">
                            Belum ada alamat pengiriman. Silakan tambah alamat terlebih dahulu.
                        </p>
                        <?php endif; ?>

                        <div class="alamat-form hidden" id="alamat-form">
                            <form id="form-alamat" onsubmit="saveAlamat(event)">
                                <input type="hidden" id="alamat-id" name="alamatID">
                                <div class="form-group">
                                    <label for="label">Label Alamat</label>
                                    <input type="text" id="label" name="label" placeholder="Contoh: Rumah, Kantor"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="street">Jalan</label>
                                    <input type="text" id="street" name="street" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">Kota</label>
                                    <input type="text" id="city" name="city" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">Provinsi</label>
                                    <input type="text" id="province" name="province" required>
                                </div>
                                <div class="form-group">
                                    <label for="postalCode">Kode Pos</label>
                                    <input type="text" id="postalCode" name="postalCode" required>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-save-alamat">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn-cancel-alamat" onclick="hideAlamatForm()">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Total Item:</span>
                        <span class="summary-value" id="totalItems">0</span>
                    </div>

                    <div class="summary-row total">
                        <span class="summary-label">Total Bayar:</span>
                        <span class="summary-value" id="grandTotal">Rp. 0</span>
                    </div>

                    <button class="checkout-btn" id="pay-button" disabled>
                        <i class="fas fa-lock"></i> Lanjutkan ke Pembayaran
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
    const updateQuantityUrl = '<?= base_url('cart/updateQuantity'); ?>';
    const removeItemUrl = '<?= base_url('cart/removeItem'); ?>';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function toggleDropdown() {
        const dropdown = document.getElementById('alamat-list');
        const selectedAlamat = document.getElementById('selected-alamat');

        dropdown.classList.toggle('show');
        selectedAlamat.classList.toggle('open');
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('alamat-list');
        const selectedAlamat = document.getElementById('selected-alamat');

        if (dropdown && selectedAlamat) {
            if (!selectedAlamat.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
                selectedAlamat.classList.remove('open');
            }
        }
    });

    async function selectAlamatFromDropdown(alamatID, event) {
        event.stopPropagation();

        const data = new FormData();
        data.append('alamatID', alamatID);
        data.append('<?= csrf_token() ?>', csrfToken);

        try {
            const response = await fetch('<?= base_url('alamat/setPrimary'); ?>', {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok) {
                window.location.reload();
            } else {
                alert(result.message || 'Gagal mengubah alamat utama.');
            }
        } catch (e) {
            console.error('Select alamat error:', e);
            alert('Terjadi kesalahan jaringan.');
        }
    }

    function showAlamatForm() {
        document.getElementById('alamat-form').classList.remove('hidden');
        document.getElementById('form-alamat').reset();
        document.getElementById('alamat-id').value = '';
        document.querySelector('.btn-save-alamat').innerHTML = '<i class="fas fa-save"></i> Simpan';
    }

    function hideAlamatForm() {
        document.getElementById('alamat-form').classList.add('hidden');
        document.getElementById('form-alamat').reset();
    }

    function editAlamat(id, label, jalan, kota, provinsi, kodePos) {
        document.getElementById('alamat-form').classList.remove('hidden');
        document.getElementById('alamat-id').value = id;
        document.getElementById('label').value = label;
        document.getElementById('street').value = jalan;
        document.getElementById('city').value = kota;
        document.getElementById('province').value = provinsi;
        document.getElementById('postalCode').value = kodePos;
        document.querySelector('.btn-save-alamat').innerHTML = '<i class="fas fa-save"></i> Update';
    }

    async function saveAlamat(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const alamatID = document.getElementById('alamat-id').value;

        let url = '<?= base_url('alamat/save'); ?>';
        let method = 'POST';

        if (alamatID) {
            url = '<?= base_url('alamat/update'); ?>';
            formData.append('alamatID', alamatID);
        }

        formData.append('<?= csrf_token() ?>', csrfToken);

        try {
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (alamatID) {
                const result = await response.json();
                if (response.ok) {
                    alert(result.message);
                    window.location.reload();
                } else {
                    alert(result.message || 'Gagal menyimpan alamat.');
                }
            } else {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Gagal menambahkan alamat.');
                }
            }
        } catch (e) {
            console.error('Save alamat error:', e);
            alert('Terjadi kesalahan jaringan.');
        }
    }

    async function deleteAlamat(alamatID) {
        if (!confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
            return;
        }

        const data = new FormData();
        data.append('alamatID', alamatID);
        data.append('<?= csrf_token() ?>', csrfToken);

        try {
            const response = await fetch('<?= base_url('alamat/delete'); ?>', {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message);
                window.location.reload();
            } else {
                alert(result.message || 'Gagal menghapus alamat.');
            }
        } catch (e) {
            console.error('Delete alamat error:', e);
            alert('Terjadi kesalahan jaringan.');
        }
    }

    async function updateQuantity(cartItemID, change) {
        const cartItem = document.querySelector(`.cart-item[data-id="${cartItemID}"]`);
        if (!cartItem) return;

        const qtyInput = cartItem.querySelector('.qty-input');
        const newQuantity = parseInt(qtyInput.value) + change;

        if (newQuantity < 1) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                removeItem(cartItemID);
            }
            return;
        }

        const data = new FormData();
        data.append('cartItemID', cartItemID);
        data.append('newQuantity', newQuantity);

        try {
            const response = await fetch(updateQuantityUrl, {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const result = await response.json();

            if (response.ok) {
                qtyInput.value = newQuantity;
                cartItem.dataset.quantity = newQuantity;

                const price = parseInt(cartItem.dataset.price);
                const subtotalEl = cartItem.querySelector('.subtotal-value');
                subtotalEl.textContent = (price * newQuantity).toLocaleString('id-ID');

                updateCartSummary();
            } else {
                alert(result.message || 'Gagal memperbarui kuantitas.');
            }
        } catch (e) {
            console.error('Update quantity error:', e);
            alert('Terjadi kesalahan jaringan.');
        }
    }

    async function removeItem(cartItemID) {
        const cartItem = document.querySelector(`.cart-item[data-id="${cartItemID}"]`);
        if (!cartItem) return;

        const data = new FormData();
        data.append('cartItemID', cartItemID);

        try {
            const response = await fetch(removeItemUrl, {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const result = await response.json();

            if (response.ok) {
                cartItem.style.transition = 'opacity 0.5s, transform 0.5s';
                cartItem.style.opacity = '0';
                cartItem.style.transform = 'translateX(-50px)';
                setTimeout(() => {
                    cartItem.remove();
                    updateCartSummary();
                    updateSelectAllStatus();
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        window.location.reload();
                    }
                }, 500);
            } else {
                alert(result.message || 'Gagal menghapus item.');
            }
        } catch (e) {
            console.error('Remove item error:', e);
            alert('Terjadi kesalahan jaringan.');
        }
    }

    function updateCartSummary() {
        const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        let grandTotal = 0;
        let totalItems = 0;

        selectedCheckboxes.forEach(checkbox => {
            const cartItem = checkbox.closest('.cart-item');
            const quantity = parseInt(cartItem.dataset.quantity);
            const price = parseInt(cartItem.dataset.price);
            grandTotal += price * quantity;
            totalItems += quantity;
        });

        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('grandTotal').textContent = `Rp. ${grandTotal.toLocaleString('id-ID')}`;
        document.getElementById('selectedCount').textContent = `${selectedCheckboxes.length} item dipilih`;

        updateCheckoutButton();
    }

    function updateSelectAllStatus() {
        const selectAllCheckbox = document.getElementById('selectAll');
        if (!selectAllCheckbox) return;

        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;

        if (itemCheckboxes.length === 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedCount === itemCheckboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedCount > 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        }
    }

    function updateCheckoutButton() {
        const checkoutBtn = document.getElementById('pay-button');
        const hasSelectedItems = document.querySelectorAll('.item-checkbox:checked').length > 0;
        const hasActiveAddress = document.querySelector('.alamat-item.active') !== null;

        checkoutBtn.disabled = !(hasSelectedItems && hasActiveAddress);
    }

    document.getElementById('pay-button').onclick = async function() {
        const checkoutBtn = this;
        if (checkoutBtn.classList.contains('loading')) return;

        const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            alert('Pilih setidaknya satu item untuk melanjutkan pembayaran.');
            return;
        }
        const selectedCartItemIDs = Array.from(selectedCheckboxes).map(cb => {
            return cb.closest('.cart-item').dataset.id;
        });

        checkoutBtn.disabled = true;
        checkoutBtn.classList.add('loading');
        checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

        try {
            const response = await fetch('<?= base_url('payment/checkout'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    cart_item_ids: selectedCartItemIDs
                })
            });

            const result = await response.json();

            if (response.ok) {
                snap.pay(result.snapToken, {
                    onSuccess: function(paymentResult) {
                        alert('Pembayaran berhasil!');
                        handlePaymentSuccess(paymentResult);
                    },
                    onPending: function(paymentResult) {
                        alert('Menunggu pembayaran Anda!');
                        handlePaymentSuccess(paymentResult);
                    },
                    onError: function(paymentResult) {
                        alert('Pembayaran gagal!');
                        console.error('Payment Error:', paymentResult);
                    },
                    onClose: function() {
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                    }
                });
            } else {
                alert(result.error || 'Terjadi kesalahan. Silakan coba lagi.');
            }
        } catch (e) {
            alert('Terjadi kesalahan jaringan. Silakan periksa koneksi internet Anda.');
            console.error('Fetch Snap Token Error:', e);
        } finally {
            checkoutBtn.classList.remove('loading');
            checkoutBtn.innerHTML = '<i class="fas fa-lock"></i> Lanjutkan ke Pembayaran';
            updateCheckoutButton();
        }
    };

    async function handlePaymentSuccess(paymentResult) {
        try {
            const response = await fetch('<?= base_url('payment/saveOrder'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(paymentResult)
            });

            const saveResult = await response.json();

            if (saveResult.status === 'success') {
                window.location.href = '<?= base_url('/orders'); ?>';
            } else {
                alert('Gagal menyimpan pesanan: ' + (saveResult.message || 'Error tidak diketahui'));
            }
        } catch (e) {
            console.error('Error saving order:', e);
            alert('Terjadi kesalahan fatal saat menyimpan pesanan Anda.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
                updateCartSummary();
            });
        }

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllStatus();
                updateCartSummary();
            });
        });

        updateSelectAllStatus();
        updateCartSummary();
    });
    </script>
</body>

</html>