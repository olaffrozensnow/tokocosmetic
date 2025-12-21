<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Feedback' ?> - Toko Skincare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #ffeef8 0%, #fff5f7 100%);
        min-height: 100vh;
        padding-bottom: 50px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .feedback-header {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        text-align: center;
    }

    .feedback-header h1 {
        color: #e91e63;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .feedback-header p {
        color: #666;
        font-size: 1.1rem;
    }

    .btn-create {
        display: inline-block;
        background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .feedback-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
    }

    .feedback-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .feedback-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .feedback-user {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        margin-right: 15px;
    }

    .user-info h3 {
        color: #333;
        font-size: 1.1rem;
        margin-bottom: 3px;
    }

    .user-info .date {
        color: #999;
        font-size: 0.85rem;
    }

    .rating {
        display: flex;
        gap: 5px;
        margin-bottom: 15px;
    }

    .rating i {
        color: #ffc107;
        font-size: 1.2rem;
    }

    .rating i.empty {
        color: #b0b0b0;
        /* Warna lebih gelap agar bintang kosong terlihat */
    }

    .feedback-content {
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .feedback-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background 0.3s ease;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 5rem;
        color: #e91e63;
        margin-bottom: 20px;
    }

    .empty-state h2 {
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <main>
        <section class="products">
            <div class="container">
                <div class="feedback-header">
                    <h1><i class="fas fa-comments"></i> Feedback Pelanggan</h1>
                    <p>Bagikan pengalaman Anda dengan produk kami</p>
                    <a href="<?= base_url('feedback/create') ?>" class="btn-create">
                        <i class="fas fa-plus"></i> Tulis Feedback
                    </a>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($feedbacks)): ?>
                <div class="feedback-grid">
                    <?php foreach ($feedbacks as $feedback): ?>
                    <div class="feedback-card">
                        <div class="feedback-user">
                            <div class="user-avatar">
                                <?= strtoupper(substr($feedback['UserName'] ?? 'U', 0, 1)) ?>
                            </div>
                            <div class="user-info">
                                <h3><?= esc($feedback['UserName'] ?? 'User ID: ' . $feedback['userID']) ?></h3>
                                <span class="date">
                                    <i class="far fa-clock"></i>
                                    <?= date('d M Y, H:i', strtotime($feedback['created_at'])) ?>
                                </span>
                            </div>
                        </div>

                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?= $i <= ($feedback['rating'] ?? 0) ? '' : 'empty' ?>"></i>
                            <?php endfor; ?>
                        </div>

                        <div class="feedback-content">
                            <?= esc($feedback['isiFeedback']) ?>
                        </div>

                        <?php if (session()->get('userID') == $feedback['userID'] || session()->get('role') == 'admin'): ?>
                        <div class="feedback-actions">
                            <form action="<?= base_url('feedback/delete/' . $feedback['FeedbackID']) ?>" method="post"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <i class="far fa-comments"></i>
                    <h2>Belum Ada Feedback</h2>
                    <p>Jadilah yang pertama memberikan feedback tentang produk kami!</p>
                    <a href="<?= base_url('feedback/create') ?>" class="btn-create">
                        <i class="fas fa-plus"></i> Tulis Feedback Pertama
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>

</html>