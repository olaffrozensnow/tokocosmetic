<?= $this->include('admin/layouts/header') ?>
<?= $this->include('admin/layouts/sidebar') ?>

<div class="main-content">
    <?= $this->include('admin/layouts/topbar') ?>

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Product</h1>
            <a href="<?= base_url('admin/product/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Product
            </a>
        </div>


        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Product Table -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">ID</th>
                                <th width="10%">Gambar</th>
                                <th>Nama Product</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                            <?php $no = 1; foreach ($products as $product): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($product['productID']) ?></td>
                                <td>
                                    <?php if (!empty($product['GambarProduct'])): ?>
                                    <img src="data:image/jpeg;base64,<?= $product['GambarProduct'] ?>"
                                        alt="<?= esc($product['productName']) ?>" class="img-thumbnail"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($product['productName']) ?></td>
                                <td><?= esc($product['merk']) ?></td>
                                <td>Rp <?= number_format($product['Harga'], 0, ',', '.') ?></td>
                                <td>
                                    <span
                                        class="badge bg-<?= $product['Stok'] > 10 ? 'success' : ($product['Stok'] > 0 ? 'warning' : 'danger') ?>">
                                        <?= $product['Stok'] ?>
                                    </span>
                                </td>
                                <td><?= esc($product['categoryName']) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/product/edit/' . $product['productID']) ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteProduct('<?= $product['productID'] ?>')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/layouts/footer') ?>

<script>
function deleteProduct(id) {
    if (confirm('Apakah Anda yakin ingin menghapus product ini?')) {
        window.location.href = '<?= base_url('admin/product/delete/') ?>' + id;
    }
}

setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 3000);
</script>