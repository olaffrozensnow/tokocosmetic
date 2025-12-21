<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Toko Skincare</title>
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 30px;
        text-align: center;
        color: white;
    }

    .header i {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .header h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .header p {
        font-size: 14px;
        opacity: 0.9;
    }

    .form-container {
        padding: 40px 30px;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .rating-group {
        margin-bottom: 25px;
    }

    .rating-group label {
        display: block;
        margin-bottom: 15px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .stars {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .stars i {
        font-size: 35px;
        color: #e0e0e0;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .stars i:hover,
    .stars i.active {
        color: #ffd700;
        transform: scale(1.1);
    }

    .form-group textarea {
        width: 100%;
        padding: 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        resize: vertical;
        min-height: 150px;
        transition: all 0.3s ease;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .char-count {
        text-align: right;
        font-size: 12px;
        color: #999;
        margin-top: 5px;
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .feedback-list {
        padding: 30px;
        background: #f8f9fa;
    }

    .feedback-list h2 {
        font-size: 22px;
        margin-bottom: 20px;
        color: #333;
    }

    .feedback-item {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .feedback-item .user-info {
        font-size: 12px;
        color: #999;
        margin-bottom: 10px;
    }

    .feedback-item .feedback-text {
        color: #333;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .container {
            margin: 20px auto;
        }

        .header {
            padding: 30px 20px;
        }

        .form-container {
            padding: 30px 20px;
        }

        .stars i {
            font-size: 30px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-comments"></i>
            <h1>Berikan Feedback Anda</h1>
            <p>Masukan Anda sangat berarti untuk kami</p>
        </div>

        <div class="form-container">
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

            <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> Mohon perbaiki kesalahan input:
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('feedback/store') ?>" method="POST" id="feedbackForm">
                <?= csrf_field() ?>

                <div class="rating-group">
                    <label>Rating Kepuasan Anda</label>
                    <div class="stars" id="starRating">
                        <i class="far fa-star" data-rating="1"></i>
                        <i class="far fa-star" data-rating="2"></i>
                        <i class="far fa-star" data-rating="3"></i>
                        <i class="far fa-star" data-rating="4"></i>
                        <i class="far fa-star" data-rating="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingValue" value="0">
                </div>

                <div class="form-group">
                    <label for="feedback">
                        <i class="fas fa-pen"></i> Tuliskan Feedback Anda
                    </label>
                    <textarea name="isiFeedback" id="feedback"
                        placeholder="Ceritakan pengalaman Anda menggunakan produk kami..." maxlength="200"
                        required><?= old('isiFeedback') ?></textarea>
                    <div class="char-count">
                        <span id="charCount">0</span>/200 karakter
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Kirim Feedback
                </button>
            </form>
        </div>

        <?php if (!empty($feedbacks)): ?>
        <div class="feedback-list">
            <h2><i class="fas fa-list"></i> Feedback Terbaru</h2>
            <?php foreach ($feedbacks as $fb): ?>
            <div class="feedback-item">
                <div class="user-info">
                    <i class="fas fa-user"></i> User ID: <?= esc($fb['UserName']) ?> |
                    <i class="fas fa-clock"></i> <?= date('d M Y', strtotime($fb['created_at'] ?? 'now')) ?>
                </div>
                <div class="feedback-text">
                    <?= esc($fb['isiFeedback']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    const stars = document.querySelectorAll('#starRating i');
    const ratingValue = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingValue.value = rating;

            stars.forEach(s => {
                s.classList.remove('active');
                s.classList.remove('fas');
                s.classList.add('far');
            });

            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('active');
                stars[i].classList.remove('far');
                stars[i].classList.add('fas');
            }
        });
    });

    const textarea = document.getElementById('feedback');
    const charCount = document.getElementById('charCount');


    charCount.textContent = textarea.value.length;

    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });


    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        if (ratingValue.value == 0) {
            e.preventDefault();
            alert('Silakan berikan rating terlebih dahulu!');
        }
    });
    </script>
</body>

</html>