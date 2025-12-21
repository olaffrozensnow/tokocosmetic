<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
    .btn-action {
        padding: 5px 10px;
        font-size: 0.85rem;
        margin: 2px;
    }

    .card-stats {
        border-left: 4px solid;
        transition: transform 0.2s;
    }

    .card-stats:hover {
        transform: translateY(-5px);
    }

    .table-responsive {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    </style>
</head>

<body>
    <?= $this->include('admin/layouts/header') ?>
    <?= $this->include('admin/layouts/sidebar') ?>

    <div class="main-content">
        <?= $this->include('admin/layouts/topbar') ?>

        <div class="content">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="mb-2">
                            <i class="fas fa-tags text-primary"></i> Data Kategori
                        </h1>
                        <p class="text-muted">Kelola Data Kategori Produk</p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-primary" onclick="tambahKategori()">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Kategori
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card card-stats border-0 shadow-sm" style="border-left-color: #0d6efd !important;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h6 class="text-muted mb-1">Total Kategori</h6>
                                    <h3 class="mb-0 fw-bold"><?= count($categories) ?></h3>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; border-radius: 50%;">
                                        <i class="fas fa-tags fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableCategories" class="table table-hover align-middle" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">ID Kategori</th>
                                    <th width="50%">Nama Kategori</th>
                                    <th width="20%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($categories)): ?>
                                <?php $no = 1; foreach($categories as $category): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <i class="fas fa-tag text-primary me-2"></i>
                                        <strong><?= esc($category['categoryID']) ?></strong>
                                    </td>
                                    <td>
                                        <i class="fas fa-folder text-muted me-2"></i>
                                        <?= esc($category['categoryName']) ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-action"
                                            onclick="editKategori('<?= esc($category['categoryID']) ?>', '<?= esc($category['categoryName']) ?>')">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-action"
                                            onclick="hapusKategori('<?= esc($category['categoryID']) ?>', '<?= esc($category['categoryName']) ?>')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                        <p class="text-muted">Tidak ada data kategori</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('admin/layouts/footer') ?>
    </div>

    <!-- Modal Kategori -->
    <div class="modal fade" id="modalKategori" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-tags me-2"></i>
                        <span id="modalTitle">Tambah Kategori</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formKategori" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="categoryID" id="categoryID">

                        <div class="mb-3" id="displayIDGroup" style="display: none;">
                            <label class="form-label fw-bold">ID Kategori</label>
                            <input type="text" class="form-control" id="displayCategoryID" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="categoryName" id="categoryName"
                                placeholder="Masukkan nama kategori" maxlength="10" required>
                            <small class="text-muted">Maksimal 10 karakter</small>
                        </div>

                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Pastikan nama kategori sesuai dengan jenis produk</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $('#tableCategories').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            },
            pageLength: 10,
            order: [
                [1, 'asc']
            ],
            responsive: true,
            autoWidth: false
        });
    });

    function tambahKategori() {
        $('#modalTitle').text('Tambah Kategori');
        $('#formKategori').attr('action', '<?= base_url('admin/categories/create') ?>');
        $('#categoryID').val('');
        $('#displayCategoryID').val('');
        $('#categoryName').val('');
        $('#displayIDGroup').hide();
        $('#modalKategori').modal('show');
    }

    function editKategori(categoryID, categoryName) {
        $('#modalTitle').text('Edit Kategori');
        $('#formKategori').attr('action', '<?= base_url('admin/categories/update') ?>');
        $('#categoryID').val(categoryID);
        $('#displayCategoryID').val(categoryID);
        $('#categoryName').val(categoryName);
        $('#displayIDGroup').show();
        $('#modalKategori').modal('show');
    }

    function hapusKategori(categoryID, categoryName) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: `Kategori "${categoryName}" akan dihapus!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('admin/categories/delete/') ?>' + categoryID;
            }
        });
    }

    $('#formKategori').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem'
                });
            }
        });
    });
    </script>
</body>

</html>