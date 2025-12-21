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
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-terkirim {
        background-color: #d1e7dd;
        color: #0f5132;
    }

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
                            <i class="fas fa-shipping-fast text-primary"></i> Data Pengiriman
                        </h1>
                        <p class="text-muted">Kelola Data Pengiriman Pesanan</p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card card-stats border-0 shadow-sm" style="border-left-color: #ffc107 !important;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h6 class="text-muted mb-1">Menunggu Pengiriman</h6>
                                    <h3 class="mb-0 fw-bold"><?= $stats['pending'] ?></h3>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; border-radius: 50%;">
                                        <i class="fas fa-clock fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-stats border-0 shadow-sm" style="border-left-color: #28a745 !important;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h6 class="text-muted mb-1">Sudah Terkirim</h6>
                                    <h3 class="mb-0 fw-bold"><?= $stats['terkirim'] ?></h3>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; border-radius: 50%;">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
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
                        <i class="fas fa-list me-2"></i>Daftar Pengiriman
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablePengiriman" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Order ID</th>
                                    <th>Tanggal Order</th>
                                    <th>Customer</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Total</th>
                                    <th>Jasa Pengiriman</th>
                                    <th>Nomor Resi</th>
                                    <th>Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($orders)): ?>
                                <?php $no = 1; foreach($orders as $order): ?>
                                <?php 
                                 
                                    $jasaPengiriman = isset($order['jasaPengiriman']) ? trim($order['jasaPengiriman']) : '';
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= esc($order['orderID']) ?></strong></td>
                                    <td><?= date('d/m/Y', strtotime($order['TanggalOrder'])) ?></td>
                                    <td>
                                        <i class="fas fa-user text-muted me-1"></i>
                                        <?= esc($order['nama_pengguna'] ?? '-') ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <?= esc($order['alamat_lengkap'] ?? '-') ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong>Rp <?= number_format($order['TotalHarga'], 0, ',', '.') ?></strong>
                                    </td>
                                    <td>
                                        <?php if($jasaPengiriman): ?>
                                        <span ">
                                            <i class=" fas fa-truck me-1"></i>
                                            <?= esc($jasaPengiriman) ?>
                                        </span>
                                        <?php else: ?>
                                        <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(!empty($order['NoResi'])): ?>
                                    <span class="badge bg-info"><?= esc($order['NoResi']) ?></span>
                                     <?php else: ?>
                                        <span class="text-muted">-</span>
                                      <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($jasaPengiriman): ?>
                                        <span class="status-badge status-terkirim">
                                            <i class="fas fa-check me-1"></i>Terkirim
                                        </span>
                                        <?php else: ?>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                        <?php endif; ?>
                                    </td>

                                   

                                    <td class="text-center">
                                        <?php if(!$jasaPengiriman): ?>
                                        <button class="btn btn-sm btn-primary btn-action"
                                            onclick="tambahPengiriman('<?= esc($order['orderID']) ?>')">
                                            <i class="fas fa-plus-circle me-1"></i>Tambah
                                        </button>
                                        <?php else: ?>
                                        <button class="btn btn-sm btn-warning btn-action"
                                        onclick="editPengiriman(
    '<?= esc($order['pengirimanID']) ?>',
    '<?= esc($order['orderID']) ?>',
    '<?= esc($jasaPengiriman) ?>'
)">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-action"
                                            onclick="hapusPengiriman('<?= esc($order['pengirimanID']) ?>')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                        <p class="text-muted">Tidak ada data pesanan dengan status Sukses</p>
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

    <!-- Modal Pengiriman -->
    <div class="modal fade" id="modalPengiriman" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-shipping-fast me-2"></i>
                        <span id="modalTitle">Tambah Pengiriman</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formPengiriman" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="pengirimanID" id="pengirimanID">
                        <input type="hidden" name="orderID" id="orderID">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Order ID</label>
                            <input type="text" class="form-control" id="displayOrderID" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Jasa Pengiriman <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="jasaPengiriman" id="jasaPengiriman" required>
                                <option value="">-- Pilih Jasa Pengiriman --</option>
                                <option value="JNE">JNE</option>
                                <option value="J&T">J&T Express</option>
                                <option value="SiCepat">Si Cepat</option>
                                <option value="Anteraja">Anteraja</option>
                                <option value="Ninja">Ninja Express</option>
                                <option value="IDExpress">ID Express</option>
                            </select>
                        </div>
                        <div class="mb-3">
    <label class="form-label fw-bold">
        Nomor Resi <span class="text-danger">*</span>
    </label>
    <input type="text" 
           class="form-control" 
           name="NoResi" 
           id="NoResi"
           placeholder="Masukkan nomor resi pengiriman"
           required>
</div>

                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Pastikan jasa pengiriman yang dipilih sesuai dengan kebutuhan pengiriman</small>
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
        $('#tablePengiriman').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            },
            pageLength: 10,
            order: [
                [2, 'desc']
            ]
        });
    });

    function tambahPengiriman(orderID) {
    $('#modalTitle').text('Tambah Pengiriman');
    $('#formPengiriman').attr('action', '<?= base_url('admin/pengiriman/store') ?>');
    $('#pengirimanID').val('');
    $('#orderID').val(orderID);
    $('#displayOrderID').val(orderID);
    $('#jasaPengiriman').val('');
    $('#NoResi').val('');
    $('#modalPengiriman').modal('show');
}

function editPengiriman(pengirimanID, orderID, jasaPengiriman, NoResi) {
    $('#modalTitle').text('Edit Pengiriman');
    $('#formPengiriman').attr('action', '<?= base_url('admin/pengiriman/update') ?>');
    $('#pengirimanID').val(pengirimanID);
    $('#orderID').val(orderID);
    $('#displayOrderID').val(orderID);
    $('#jasaPengiriman').val(jasaPengiriman);
    $('#NoResi').val(NoResi);
    $('#modalPengiriman').modal('show');
}


    function hapusPengiriman(pengirimanID) {
        Swal.fire({
            title: 'Hapus Pengiriman?',
            text: "Data pengiriman akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('admin/pengiriman/delete/') ?>' + pengirimanID;
            }
        });
    }

    $('#formPengiriman').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
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