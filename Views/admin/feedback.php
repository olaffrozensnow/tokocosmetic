<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    .main-content {
        margin-left: 250px;
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .page-header {
        background: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .page-header h1 {
        font-size: 28px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .page-header h1 i {
        color: #16a085;
        margin-right: 10px;
    }

    .subtitle {
        color: #7f8c8d;
        margin: 5px 0 0 0;
        font-size: 14px;
    }

    .stats-card {
        background: linear-gradient(135deg, #16a085 0%, #1abc9c 100%);
        border-radius: 15px;
        padding: 25px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(22, 160, 133, 0.2);
    }

    .stats-row {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
        padding: 10px;
    }

    .stat-value {
        font-size: 42px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        opacity: 0.95;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .rating-bars {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .rating-bars h5 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .rating-stars {
        width: 100px;
        color: #f39c12;
        font-size: 14px;
    }

    .rating-bar {
        flex: 1;
        height: 8px;
        background: #ecf0f1;
        border-radius: 10px;
        margin: 0 15px;
        overflow: hidden;
    }

    .rating-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #16a085, #1abc9c);
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    .rating-count {
        min-width: 50px;
        text-align: right;
        color: #7f8c8d;
        font-size: 14px;
    }

    .feedback-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .feedback-card:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transform: translateY(-1px);
    }

    .feedback-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #16a085 0%, #1abc9c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .user-details h6 {
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
        font-size: 15px;
    }

    .user-email {
        font-size: 12px;
        color: #7f8c8d;
        margin: 2px 0 0 0;
    }

    .feedback-rating {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stars {
        color: #f39c12;
        font-size: 16px;
    }

    .rating-number {
        background: #16a085;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 500;
    }

    .feedback-content {
        color: #495057;
        line-height: 1.6;
        font-size: 14px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #16a085;
    }

    .feedback-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .feedback-date {
        color: #95a5a6;
        font-size: 13px;
    }

    .feedback-date i {
        margin-right: 5px;
    }

    .feedback-id {
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 12px;
        color: #6c757d;
        font-family: monospace;
    }

    .search-box {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .search-input {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #16a085;
        box-shadow: 0 0 0 3px rgba(22, 160, 133, 0.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 10px;
    }

    .empty-state i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #6c757d;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 15px;
        }

        .stats-row {
            flex-direction: column;
        }

        .stat-item {
            width: 100%;
            padding: 15px;
        }

        .feedback-header {
            flex-direction: column;
        }

        .rating-stars {
            width: 80px;
            font-size: 12px;
        }
    }
    </style>
</head>

<body>

    <?= $this->include('admin/layouts/header') ?>
    <?= $this->include('admin/layouts/sidebar') ?>

    <div class="main-content">
        <?= $this->include('admin/layouts/topbar') ?>

        <div class="content">

            <div class="page-header">
                <div class="header-left">
                    <h1><i class="fas fa-comments"></i>Feedback User</h1>
                    <p class="subtitle">Lihat dan kelola ulasan dari pelanggan toko kosmetik</p>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-row">
                    <div class="stat-item">
                        <div class="stat-value"><?= number_format($averageRating, 1) ?></div>
                        <div class="stat-label">Rating Rata-rata</div>
                        <div style="font-size: 20px; margin-top: 5px;">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star"
                                style="opacity: <?= $i <= round($averageRating) ? '1' : '0.3' ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?= $totalFeedback ?></div>
                        <div class="stat-label">Total Feedback</div>
                    </div>
                </div>
            </div>

            <div class="rating-bars">
                <h5><i class="fas fa-chart-bar me-2"></i>Distribusi Rating</h5>
                <?php 
                $ratingCounts = array_fill(1, 5, 0);
                foreach($ratingDistribution as $rating) {
                    $ratingCounts[$rating['rating']] = $rating['count'];
                }
                
                for($i = 5; $i >= 1; $i--): 
                    $count = $ratingCounts[$i];
                    $percentage = $totalFeedback > 0 ? ($count / $totalFeedback) * 100 : 0;
                ?>
                <div class="rating-row">
                    <div class="rating-stars">
                        <?php for($j = 0; $j < $i; $j++): ?>
                        <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-bar-fill" style="width: <?= $percentage ?>%"></div>
                    </div>
                    <div class="rating-count"><?= $count ?></div>
                </div>
                <?php endfor; ?>
            </div>

            <div class="search-box">
                <input type="text" class="form-control search-input" id="searchFeedback"
                    placeholder="Cari feedback berdasarkan nama, email, atau isi feedback...">
            </div>

            <div id="feedbackContainer">
                <?php if(empty($feedbacks)): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h5>Belum ada feedback</h5>
                    <p class="text-muted">Feedback dari pelanggan akan muncul di sini</p>
                </div>
                <?php else: ?>
                <?php foreach($feedbacks as $feedback): ?>
                <div class="feedback-card"
                    data-search="<?= strtolower($feedback['UserName'] . ' ' . $feedback['Email'] . ' ' . $feedback['isiFeedback']) ?>">
                    <div class="feedback-header">
                        <div class="user-info">
                            <div class="user-avatar">
                                <?= strtoupper(substr($feedback['UserName'], 0, 1)) ?>
                            </div>
                            <div class="user-details">
                                <h6><?= esc($feedback['UserName']) ?></h6>
                                <p class="user-email"><?= esc($feedback['Email']) ?></p>
                            </div>
                        </div>
                        <div class="feedback-rating">
                            <div class="stars">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star"
                                    style="opacity: <?= $i <= $feedback['rating'] ? '1' : '0.2' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-number"><?= $feedback['rating'] ?>/5</span>
                        </div>
                    </div>
                    <div class="feedback-content">
                        <?= esc($feedback['isiFeedback']) ?>
                    </div>
                    <div class="feedback-footer">
                        <span class="feedback-date">
                            <i class="far fa-clock"></i>
                            <?= date('d M Y, H:i', strtotime($feedback['created_at'])) ?>
                        </span>

                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

        <?= $this->include('admin/layouts/footer') ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#searchFeedback').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();

            $('.feedback-card').each(function() {
                const searchData = $(this).data('search');
                if (searchData.includes(searchValue)) {
                    $(this).fadeIn(200);
                } else {
                    $(this).fadeOut(200);
                }
            });
        });
    });
    </script>

</body>

</html>