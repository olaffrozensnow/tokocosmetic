<?= $this->include('admin/layouts/header') ?>
<?= $this->include('admin/layouts/sidebar') ?>

<div class="main-content">
    <?= $this->include('admin/layouts/topbar') ?>

    <div class="content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <h1><i class="fas fa-plus-circle"></i> Tambah Product</h1>
                <p class="subtitle">Lengkapi form di bawah untuk menambah produk baru</p>
            </div>
            <a href="<?= base_url('admin/product') ?>" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Alert Messages -->
        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <strong>Terdapat kesalahan:</strong>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="form-card">
            <form action="<?= base_url('admin/product/store') ?>" method="post" enctype="multipart/form-data"
                id="productForm">
                <?= csrf_field() ?>

                <div class="form-layout">
                    <!-- Left Section - Image Upload -->
                    <div class="upload-section">
                        <div class="section-header">
                            <h3><i class="fas fa-image"></i> Gambar Product</h3>
                            <span class="badge-required">Wajib</span>
                        </div>

                        <input type="file" class="file-input" id="GambarProduct" name="GambarProduct"
                            accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)" required>

                        <div class="upload-area" onclick="document.getElementById('GambarProduct').click()">
                            <div id="uploadPlaceholder" class="upload-placeholder">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h4>Klik untuk upload gambar</h4>
                                <p>atau drag & drop file di sini</p>
                                <span class="upload-hint">JPG, PNG, JPEG (Maks. 2MB)</span>
                            </div>

                            <div id="imagePreview" class="image-preview">
                                <img id="previewImg" src="" alt="Preview">
                                <div class="preview-overlay">
                                    <button type="button" class="btn-change">
                                        <i class="fas fa-sync-alt"></i> Ganti Gambar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php if ($validation->hasError('GambarProduct')): ?>
                        <div class="error-text">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= $validation->getError('GambarProduct') ?>
                        </div>
                        <?php endif; ?>


                    </div>

                    <!-- Right Section - Form Fields -->
                    <div class="fields-section">
                        <!-- Product ID & Category -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-barcode"></i> Product ID
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                    class="form-input <?= $validation->hasError('productID') ? 'error' : '' ?>"
                                    name="productID" id="productID" value="<?= old('productID') ?>"
                                    placeholder="Contoh: PR001" maxlength="5" required>
                                <span class="input-hint">Maksimal 5 karakter</span>
                                <?php if ($validation->hasError('productID')): ?>
                                <div class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?= $validation->getError('productID') ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-tags"></i> Kategori
                                    <span class="required">*</span>
                                </label>
                                <div class="select-wrapper">
                                    <select class="form-input <?= $validation->hasError('categoryID') ? 'error' : '' ?>"
                                        name="categoryID" id="categoryID" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['categoryID'] ?>"
                                            <?= old('categoryID') == $category['categoryID'] ? 'selected' : '' ?>>
                                            <?= esc($category['categoryName']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="fas fa-chevron-down select-icon"></i>
                                </div>
                                <?php if ($validation->hasError('categoryID')): ?>
                                <div class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?= $validation->getError('categoryID') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Product Name -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-box"></i> Nama Product
                                <span class="required">*</span>
                            </label>
                            <input type="text"
                                class="form-input <?= $validation->hasError('productName') ? 'error' : '' ?>"
                                name="productName" id="productName" value="<?= old('productName') ?>"
                                placeholder="Masukkan nama product" maxlength="50" required>
                            <span class="input-hint">Maksimal 50 karakter</span>
                            <?php if ($validation->hasError('productName')): ?>
                            <div class="error-text">
                                <i class="fas fa-exclamation-circle"></i>
                                <?= $validation->getError('productName') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Brand & Stock -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-trademark"></i> Merk
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                    class="form-input <?= $validation->hasError('merk') ? 'error' : '' ?>" name="merk"
                                    id="merk" value="<?= old('merk') ?>" placeholder="Masukkan merk" maxlength="20"
                                    required>
                                <span class="input-hint">Maksimal 20 karakter</span>
                                <?php if ($validation->hasError('merk')): ?>
                                <div class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?= $validation->getError('merk') ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-cubes"></i> Stok
                                    <span class="required">*</span>
                                </label>
                                <input type="number"
                                    class="form-input <?= $validation->hasError('Stok') ? 'error' : '' ?>" name="Stok"
                                    id="Stok" value="<?= old('Stok') ?>" placeholder="0" min="0" max="99" required>
                                <span class="input-hint">Maksimal 99 unit</span>
                                <?php if ($validation->hasError('Stok')): ?>
                                <div class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?= $validation->getError('Stok') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-money-bill-wave"></i> Harga
                                <span class="required">*</span>
                            </label>
                            <div class="price-input-wrapper">
                                <span class="currency">Rp</span>
                                <input type="text"
                                    class="form-input price-input <?= $validation->hasError('Harga') ? 'error' : '' ?>"
                                    name="Harga" id="Harga" value="<?= old('Harga') ?>" placeholder="0" required>
                            </div>
                            <span class="input-hint">Format otomatis: 1.000.000</span>
                            <?php if ($validation->hasError('Harga')): ?>
                            <div class="error-text">
                                <i class="fas fa-exclamation-circle"></i>
                                <?= $validation->getError('Harga') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i> Deskripsi
                                <span class="required">*</span>
                            </label>
                            <textarea class="form-input <?= $validation->hasError('Deskripsi') ? 'error' : '' ?>"
                                name="Deskripsi" id="Deskripsi" rows="5"
                                placeholder="Masukkan deskripsi lengkap tentang product..." maxlength="100"
                                required><?= old('Deskripsi') ?></textarea>
                            <div class="char-counter">
                                <span id="charCount">0</span> / 100 karakter
                            </div>
                            <?php if ($validation->hasError('Deskripsi')): ?>
                            <div class="error-text">
                                <i class="fas fa-exclamation-circle"></i>
                                <?= $validation->getError('Deskripsi') ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?= base_url('admin/product') ?>" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Simpan Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('admin/layouts/footer') ?>

<script>
// Image Preview
function previewImage(event) {
    const file = event.target.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if (file) {
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('uploadPlaceholder').style.display = 'none';
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Character Counter
const textarea = document.getElementById('Deskripsi');
const charCount = document.getElementById('charCount');

function updateCharCount() {
    charCount.textContent = textarea.value.length;
    if (textarea.value.length >= 90) {
        charCount.style.color = '#ef4444';
    } else {
        charCount.style.color = '#6366f1';
    }
}

updateCharCount();
textarea.addEventListener('input', updateCharCount);

// Price Formatter
const hargaInput = document.getElementById('Harga');

hargaInput.addEventListener('input', function(e) {
    let value = this.value.replace(/[^0-9]/g, '');
    if (value) {
        this.value = new Intl.NumberFormat('id-ID').format(value);
    }
});

// Remove formatting before submit
document.getElementById('productForm').addEventListener('submit', function(e) {
    const hargaValue = hargaInput.value.replace(/\./g, '');
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'Harga';
    hiddenInput.value = hargaValue;
    this.appendChild(hiddenInput);
    hargaInput.removeAttribute('name');
});

// Auto-hide alerts
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);
</script>

<style>
/* ===== GLOBAL ===== */
.content {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* ===== PAGE HEADER ===== */
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

.btn-back {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 12px rgba(100, 116, 139, 0.2);
}

.btn-back:hover {
    background: linear-gradient(135deg, #475569 0%, #334155 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(100, 116, 139, 0.3);
}

/* ===== ALERT ===== */
.alert {
    padding: 18px 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    gap: 16px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border: 2px solid #ef4444;
}

.alert-icon {
    font-size: 1.5rem;
    color: #dc2626;
    margin-top: 2px;
}

.alert-content {
    flex: 1;
    color: #991b1b;
}

.alert-content strong {
    display: block;
    margin-bottom: 8px;
    font-size: 1rem;
}

.alert-content ul {
    margin: 0;
    padding-left: 20px;
}

.alert-content li {
    margin-bottom: 4px;
}

.btn-close {
    background: transparent;
    border: none;
    color: #dc2626;
    cursor: pointer;
    font-size: 1.2rem;
    opacity: 0.6;
    transition: opacity 0.2s;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-close:hover {
    opacity: 1;
}

/* ===== FORM CARD ===== */
.form-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    padding: 32px;
    border: 1px solid #e2e8f0;
}

/* ===== FORM LAYOUT ===== */
.form-layout {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 40px;
    margin-bottom: 32px;
}

/* ===== UPLOAD SECTION ===== */
.upload-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.section-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.section-header h3 i {
    color: #6366f1;
}

.badge-required {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
}

.file-input {
    display: none;
}

.upload-area {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 3px dashed #cbd5e1;
    border-radius: 16px;
    padding: 40px 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-area:hover {
    border-color: #6366f1;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(99, 102, 241, 0.15);
}

.upload-placeholder {
    text-align: center;
    color: #64748b;
}

.upload-icon {
    font-size: 4.5rem;
    color: #cbd5e1;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-10px);
    }
}

.upload-placeholder h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #475569;
    margin: 0 0 8px 0;
}

.upload-placeholder p {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0 0 16px 0;
}

.upload-hint {
    display: inline-block;
    background: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    color: #64748b;
    font-weight: 600;
    border: 1px solid #e2e8f0;
}

.image-preview {
    display: none;
    position: relative;
    width: 100%;
}

.image-preview img {
    width: 100%;
    height: auto;
    max-height: 320px;
    object-fit: contain;
    border-radius: 12px;
}

.preview-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    padding: 20px;
    border-radius: 0 0 12px 12px;
    opacity: 0;
    transition: opacity 0.3s;
}

.image-preview:hover .preview-overlay {
    opacity: 1;
}

.btn-change {
    background: white;
    color: #6366f1;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0 auto;
    transition: all 0.3s;
}

.btn-change:hover {
    background: #6366f1;
    color: white;
    transform: scale(1.05);
}

/* Upload Tips */
.upload-tips {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    padding: 16px 20px;
    border-radius: 12px;
    border: 1px solid #fbbf24;
}

.upload-tips h4 {
    font-size: 0.95rem;
    font-weight: 700;
    color: #92400e;
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.upload-tips h4 i {
    color: #f59e0b;
}

.upload-tips ul {
    margin: 0;
    padding-left: 20px;
    color: #78350f;
}

.upload-tips li {
    font-size: 0.85rem;
    margin-bottom: 6px;
    line-height: 1.5;
}

/* ===== FIELDS SECTION ===== */
.fields-section {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.form-label i {
    color: #6366f1;
    font-size: 0.9rem;
}

.required {
    color: #ef4444;
    font-weight: 700;
}

.form-input {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s;
    background: white;
    color: #1e293b;
    font-weight: 500;
}

.form-input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    background: #fefefe;
}

.form-input.error {
    border-color: #ef4444;
    background: #fef2f2;
}

.form-input::placeholder {
    color: #94a3b8;
}

.input-hint {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 6px;
    display: block;
}

.error-text {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
}

/* Select Wrapper */
.select-wrapper {
    position: relative;
}

.select-wrapper select {
    appearance: none;
    padding-right: 40px;
}

.select-icon {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    pointer-events: none;
}

/* Price Input */
.price-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.currency {
    position: absolute;
    left: 16px;
    font-weight: 700;
    color: white;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 0.9rem;
}

.price-input {
    padding-left: 70px !important;
}

/* Character Counter */
.char-counter {
    text-align: right;
    font-size: 0.85rem;
    margin-top: 6px;
}

.char-counter span {
    font-weight: 700;
    color: #6366f1;
}

textarea.form-input {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
    line-height: 1.6;
}


.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 24px;
    border-top: 2px solid #e2e8f0;
}

.form-actions .btn {
    padding: 14px 32px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.btn-cancel {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: #475569;
    border: 2px solid #cbd5e1;
}

.btn-cancel:hover {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.btn-submit {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.btn-submit:hover {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .form-layout {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .upload-section {
        max-width: 500px;
        margin: 0 auto;
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

    .btn-back {
        width: 100%;
        justify-content: center;
    }

    .form-card {
        padding: 24px 20px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}