<?= $this->include('admin/layouts/header') ?>
<?= $this->include('admin/layouts/sidebar') ?>

<div class="main-content">
    <?= $this->include('admin/layouts/topbar') ?>

    <div class="content">
        <div class="page-header">
            <div class="header-left">
                <h1><i class="fas fa-boxes"></i> Data Product</h1>
                <p class="subtitle">Kelola semua produk Anda di sini</p>
            </div>
            <a href="<?= base_url('admin/product/create') ?>" class="btn btn-primary btn-add">
                <i class="fas fa-plus"></i> Tambah Product
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?= session()->getFlashdata('success') ?></span>
            <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span><?= session()->getFlashdata('error') ?></span>
            <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?php endif; ?>

        <?php if (!empty($products)): ?>
        <div class="search-container">
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Cari produk.">
                <button class="search-clear" id="clearSearch" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="search-results-info" id="searchInfo" style="display: none;">
                Menampilkan <span id="resultCount">0</span> dari <?= count($products) ?> produk
            </div>
        </div>

        <div class="product-grid" id="productGrid">
            <?php foreach ($products as $product): ?>
            <div class="product-card" data-name="<?= strtolower(esc($product['productName'])) ?>"
                data-merk="<?= strtolower(esc($product['merk'])) ?>"
                data-category="<?= strtolower(esc($product['categoryName'])) ?>"
                data-id="<?= strtolower(esc($product['productID'])) ?>">
                <div class="product-image-wrapper">
                    <?php if (!empty($product['GambarProduct'])): ?>
                    <img src="data:image/jpeg;base64,<?= $product['GambarProduct'] ?>" class="product-image"
                        alt="<?= esc($product['productName']) ?>">
                    <?php else: ?>
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                    </div>
                    <?php endif; ?>

                    <div
                        class="stock-badge <?= $product['Stok'] > 10 ? 'success' : ($product['Stok'] > 0 ? 'warning' : 'danger') ?>">
                        Stok: <?= $product['Stok'] ?>
                    </div>
                </div>

                <div class="product-body">
                    <span class="category-badge">
                        <i class="fas fa-tag"></i> <?= esc($product['categoryName']) ?>
                    </span>

                    <h3 class="product-name" title="<?= esc($product['productName']) ?>">
                        <?= esc($product['productName']) ?>
                    </h3>

                    <p class="product-brand">
                        <i class="fas fa-trademark"></i> <?= esc($product['merk']) ?>
                    </p>

                    <p class="product-desc">
                        <?= esc($product['Deskripsi'] ?? 'Tidak ada deskripsi') ?>
                    </p>

                    <div class="product-footer">
                        <div class="price-section">
                            <span class="price-label">Harga</span>
                            <h4 class="product-price">Rp <?= number_format($product['Harga'], 0, ',', '.') ?></h4>
                        </div>
                        <div class="id-section">
                            <span class="id-label">ID</span>
                            <span class="product-id"><?= esc($product['productID']) ?></span>
                        </div>
                    </div>

                    <div class="product-actions">
                        <a href="<?= base_url('admin/product/edit/' . $product['productID']) ?>" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button
                            onclick="deleteProduct('<?= $product['productID'] ?>', '<?= esc($product['productName']) ?>')"
                            class="btn btn-delete">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="empty-search" id="emptySearch" style="display: none;">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3>Tidak ada hasil ditemukan</h3>
            <p>Coba gunakan kata kunci yang berbeda</p>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3>Belum ada produk</h3>
            <p>Mulai tambahkan produk pertama Anda</p>
            <a href="<?= base_url('admin/product/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Product
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->include('admin/layouts/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteProduct(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `Apakah Anda yakin ingin menghapus produk<br><strong>${name}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal',
        reverseButtons: true,
        customClass: {
            popup: 'swal-custom',
            confirmButton: 'swal-btn-confirm',
            cancelButton: 'swal-btn-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('admin/product/delete/') ?>' + id;
        }
    });
}

setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);

const searchInput = document.getElementById('searchInput');
const clearButton = document.getElementById('clearSearch');
const productCards = document.querySelectorAll('.product-card');
const productGrid = document.getElementById('productGrid');
const emptySearch = document.getElementById('emptySearch');
const searchInfo = document.getElementById('searchInfo');
const resultCount = document.getElementById('resultCount');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        if (searchTerm === '') {
            clearButton.style.display = 'none';
            searchInfo.style.display = 'none';
        } else {
            clearButton.style.display = 'flex';
            searchInfo.style.display = 'block';
        }

        productCards.forEach(function(card) {
            const name = card.getAttribute('data-name');
            const merk = card.getAttribute('data-merk');
            const category = card.getAttribute('data-category');
            const id = card.getAttribute('data-id');

            const searchableText = name + ' ' + merk + ' ' + category + ' ' + id;

            if (searchableText.includes(searchTerm)) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        resultCount.textContent = visibleCount;

        if (visibleCount === 0 && searchTerm !== '') {
            productGrid.style.display = 'none';
            emptySearch.style.display = 'block';
        } else {
            productGrid.style.display = 'grid';
            emptySearch.style.display = 'none';
        }
    });

    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        }
    });
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.content {
    padding: 20px;
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

.btn-add {
    padding: 12px 24px;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
}

.alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.alert i:first-child {
    font-size: 1.25rem;
}

.alert span {
    flex: 1;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
    border: 1px solid #10b981;
}

.alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
    border: 1px solid #ef4444;
}

.btn-close {
    background: transparent;
    border: none;
    color: inherit;
    cursor: pointer;
    font-size: 1.1rem;
    opacity: 0.6;
    transition: opacity 0.2s;
    padding: 4px 8px;
}

.btn-close:hover {
    opacity: 1;
}

.search-container {
    margin-bottom: 24px;
}

.search-wrapper {
    position: relative;
    max-width: 600px;
    margin-bottom: 12px;
}

.search-input {
    width: 100%;
    padding: 14px 48px 14px 48px;
    font-size: 0.95rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    background: white;
    transition: all 0.3s ease;
    outline: none;
}

.search-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
}

.search-clear {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: #f1f5f9;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #64748b;
    transition: all 0.2s ease;
}

.search-clear:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.search-results-info {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

.search-results-info span {
    color: #6366f1;
    font-weight: 700;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
}

.product-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    border-color: #cbd5e1;
}

.product-image-wrapper {
    position: relative;
    width: 100%;
    height: 220px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #cbd5e1;
    font-size: 3.5rem;
}

.stock-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    color: white;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stock-badge.success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.stock-badge.warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.stock-badge.danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.product-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1e40af;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 12px;
    align-self: flex-start;
    border: 1px solid #93c5fd;
}

.product-name {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 10px 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 1.4;
    min-height: 2.8em;
}

.product-brand {
    color: #64748b;
    font-size: 0.9rem;
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
}

.product-brand i {
    font-size: 0.8rem;
    color: #94a3b8;
}

.product-desc {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0 0 16px 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    flex: 1;
}

.product-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding: 16px 0;
    margin-bottom: 16px;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
}

.price-label,
.id-label {
    font-size: 0.75rem;
    color: #94a3b8;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
    display: block;
}

.product-price {
    font-size: 1.35rem;
    font-weight: 800;
    color: #6366f1;
    margin: 0;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.id-section {
    text-align: right;
}

.product-id {
    font-size: 0.9rem;
    font-weight: 700;
    color: #475569;
    font-family: 'Courier New', monospace;
}

.product-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.product-actions .btn {
    padding: 11px 16px;
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-edit {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
}

.btn-edit:hover {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(251, 191, 36, 0.4);
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
}

.empty-state,
.empty-search {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.empty-icon {
    font-size: 5rem;
    color: #cbd5e1;
    margin-bottom: 24px;
}

.empty-state h3,
.empty-search h3 {
    color: #475569;
    font-size: 1.5rem;
    margin-bottom: 12px;
    font-weight: 700;
}

.empty-state p,
.empty-search p {
    color: #94a3b8;
    font-size: 1rem;
    margin-bottom: 28px;
}

.empty-state .btn {
    padding: 14px 32px;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
}

@media (max-width: 1200px) {
    .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .btn-add {
        width: 100%;
        justify-content: center;
    }

    .search-wrapper {
        max-width: 100%;
    }

    .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 16px;
    }

    .product-image-wrapper {
        height: 200px;
    }
}

@media (max-width: 480px) {
    .content {
        padding: 15px;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .header-left h1 {
        font-size: 1.5rem;
    }

    .product-actions {
        grid-template-columns: 1fr;
    }
}

.swal-custom {
    border-radius: 16px;
    padding: 20px;
}

.swal-btn-confirm,
.swal-btn-cancel {
    border-radius: 8px !important;
    padding: 10px 24px !important;
    font-weight: 600 !important;
}
</style>