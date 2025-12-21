<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Buat Feedback' ?> - Toko Skincare</title>
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
        max-width: 700px;
        margin: 50px auto;
        padding: 20px;
    }

    .feedback-form-container {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h1 {
        color: #e91e63;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1rem;
    }

    .form-group label span {
        color: #e91e63;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #e91e63;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .char-counter {
        text-align: right;
        color: #999;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .rating-input {
        display: flex;
        gap: 10px;
        flex-direction: row-reverse;
        justify-content: flex-end;
        font-size: 2rem;
    }

    .rating-input input[type="radio"] {
        display: none;
    }

    .rating-input label {
        cursor: pointer;
        color: #999;
        /* ⭐ PERBAIKAN DITERAPKAN DI SINI (Sebelumnya #ddd) */
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .rating-input label:hover,
    .rating-input label:hover~label,
    .rating-input input[type="radio"]:checked~label {
        color: #ffc107;
    }

    .rating-input label:hover {
        transform: scale(1.2);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 50px;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: inline-block;
    }

    .btn-primary {
        background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
    }

    .btn-secondary {
        background: #f0f0f0;
        color: #666;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
    }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <main>
        <div class="container">
            <div class="feedback-form-container">
                <div class="form-header">
                    <h1><i class="fas fa-edit"></i> Tulis Feedback</h1>
                    <p>Bagikan pengalaman Anda dengan produk kami</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul style="margin: 10px 0 0 20px;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('feedback/store') ?>" method="post" id="feedbackForm">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="rating">
                            Rating <span>*</span>
                        </label>
                        <div class="rating-input">
                            <input type="radio" name="rating" id="star5" value="5">
                            <label for="star5"><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                        <div class="error-message" id="ratingError"></div>
                    </div>

                    <div class="form-group">
                        <label for="isiFeedback">
                            Isi Feedback <span>*</span>
                        </label>
                        <textarea name="isiFeedback" id="isiFeedback" class="form-control"
                            placeholder="Ceritakan pengalaman Anda menggunakan produk kami..." maxlength="200"
                            required><?= old('isiFeedback') ?></textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span>/200 karakter
                        </div>
                        <div class="error-message" id="feedbackError"></div>
                    </div>

                    <div class="form-actions">
                        <a href="<?= base_url('feedback') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
    const textarea = document.getElementById('isiFeedback');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;

        if (count > 200) {
            charCount.style.color = '#dc3545';
        } else {
            charCount.style.color = '#999';
        }
    });

    if (textarea.value) {
        charCount.textContent = textarea.value.length;
    }

    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        let isValid = true;

        document.getElementById('ratingError').textContent = '';
        document.getElementById('feedbackError').textContent = '';


        const rating = document.querySelector('input[name="rating"]:checked');
        if (!rating) {
            document.getElementById('ratingError').textContent = 'Silakan pilih rating';
            isValid = false;
        }


        const feedback = textarea.value.trim();
        if (feedback.length < 10) {
            document.getElementById('feedbackError').textContent = 'Feedback minimal 10 karakter';
            isValid = false;
        } else if (feedback.length > 200) {
            document.getElementById('feedbackError').textContent = 'Feedback maksimal 200 karakter';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
    </script>
</body>

</html>