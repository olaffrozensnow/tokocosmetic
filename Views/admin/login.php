<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    /* CSS DARI FORM PERTAMA (TERMASUK BACKGROUND IMAGE) */
    body {
        /* Fallback background jika gambar tidak ada */

        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* BACKGROUND IMAGE DENGAN BLUR */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* Perhatikan: Pastikan path gambar 'img/landing1.jpg' benar di lingkungan Anda */
        background-image: url('<?= base_url('img/landing1.jpg') ?>');
        background-size: cover;
        background-position: center;
        filter: blur(8px);
        z-index: -2;
        /* Di bawah form dan overlay */
        width: 100vw;
        height: 100vh;
    }

    /* OVERLAY GELAP */
    body::after {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: -1;
        /* Di atas gambar, di bawah form */
        width: 100vw;
        height: 100vh;
    }

    /* AKHIR BAGIAN BACKGROUND IMAGE */

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        padding: 2rem;
        max-width: 400px;
        width: 100%;
        margin: 20px;
        animation: fadeIn 0.5s ease-in;
        z-index: 10;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .input-field {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .input-field:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .input-field.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        padding: 5px;
        font-size: 18px;
    }

    /* PENTING: Tombol Login dengan gradasi dan hover yang sama */
    .login-btn {
        width: 100%;
        padding: 12px;
        /* Gradasi warna yang sama persis */
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* AKHIR STYLE TOMBOL LOGIN */

    /* Styling Flash Data (menggunakan simulasi kelas Tailwind) */
    .bg-red-100 {
        background-color: #fee2e2;
    }

    .text-red-600 {
        color: #dc2626;
    }

    .p-3 {
        padding: 0.75rem;
    }

    .rounded {
        border-radius: 0.25rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .bg-green-100 {
        background-color: #d1fae5;
    }

    .text-green-600 {
        color: #059669;
    }

    /* Styling Teks */
    .text-gray-700 {
        color: #4b5563;
    }

    .font-bold {
        font-weight: 700;
    }

    .text-2xl {
        font-size: 1.5rem;
    }

    .text-center {
        text-align: center;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .block {
        display: block;
    }

    .font-medium {
        font-weight: 500;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .relative {
        position: relative;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .text-gray-600 {
        color: #525252;
    }

    .text-sm {
        font-size: 0.875rem;
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Login Admin Account</h2>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-600 p-3 rounded mb-4">
            <i class="fas fa-check-circle" style="margin-right: 5px;"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <form id="loginForm" action="<?= base_url('admin/attemptLogin') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="adminID" class="block text-gray-700 font-medium mb-2">Admin ID</label>
                <input type="text" id="adminID"
                    class="input-field <?= isset($validation) && $validation->hasError('adminID') ? 'is-invalid' : '' ?>"
                    placeholder="Masukkan Admin ID" name="adminID" value="<?= old('adminID') ?>" required>
                <?php if (isset($validation) && $validation->hasError('adminID')): ?>
                <span class="invalid-feedback"><?= $validation->getError('adminID') ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-4 relative">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password"
                    class="input-field <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>"
                    placeholder="Masukkan Password" name="password" required>
                <span class="password-toggle" onclick="togglePassword('password')">
                </span>
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                <span class="invalid-feedback"><?= $validation->getError('password') ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="login-btn">LOG IN</button>
        </form>

        <p class="text-center mt-4 text-gray-600 text-sm">
            &copy; <?= date('Y') ?> Toko Kosmetik. All rights reserved.
        </p>
    </div>

    <script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const toggleIcon = input.parentNode.querySelector('.password-toggle i');

        if (input.type === "password") {
            input.type = "text";
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = "password";
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    }
    </script>
</body>

</html>