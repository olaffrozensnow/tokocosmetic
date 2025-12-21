<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('img/landing1.jpg'); /* Pastikan path gambar benar */
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -2;
        }
        body::after {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }
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
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-group {
            margin-bottom: 1.5rem;
            position: relative; /* Penting untuk posisi absolute anak element */
        }
        .input-field {
            width: 100%;
            padding: 12px;
            padding-right: 40px; /* Memberi ruang agar teks tidak tertutup ikon mata */
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
        /* PERBAIKAN: Penulisan class harus konsisten (kecil semua) */
        .password-toggle {
            position: absolute;
            right: 15px; /* Sedikit digeser agar rapi */
            top: 42px; /* Disesuaikan dengan tinggi label + padding input */
            cursor: pointer;
            color: #666;
            font-size: 1.2rem;
            user-select: none; /* Agar ikon tidak ter-blok saat diklik */
        }
        .register-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Create Your Account</h2>
        <form id="registrationForm" action="/register" method="post">
            
            <!-- <div class="form-group">
                <label for="UserName" class="block text-gray-700 font-medium mb-2">User Name</label>
                <input type="text" id="UserName" name="UserName" class="input-field" placeholder="Enter your full name" required autofocus>
                <div class="error" id="fullNameError">Full name is required</div>
            </div>
             -->

             <div class="form-group">
    <label for="UserName" class="block text-gray-700 font-medium mb-2">User Name</label>
    
    <input type="text" id="UserName" name="UserName" class="input-field" 
           placeholder="Enter your full name" 
           value="<?= old('UserName') ?>" required autofocus>
    
    <div class="error" id="fullNameError">Full name is required</div>

    <?php if(session('errors.UserName')) : ?>
        <div style="color: #e74c3c; font-size: 14px; margin-top: 5px; display: block;">
            <?= session('errors.UserName') ?>
        </div>
    <?php endif ?>
</div>




            <div class="form-group">
                <label for="TanggalLahir" class="block text-gray-700 font-medium mb-2">Tanggal Lahir</label>
                <input type="date" id="TanggalLahir" class="input-field" name="TanggalLahir" required />
                <div class="error" id="dobError">Please enter your date of birth</div>
            </div>

            <!-- <div class="form-group">
                <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="Email" class="input-field" placeholder="Enter your email" name="Email" required>
                <div class="error" id="emailError">Please enter a valid email</div>
            </div> -->

<div class="form-group">
    <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
    
    <input type="email" id="Email" class="input-field" 
           placeholder="Enter your email" name="Email" 
           value="<?= old('Email') ?>" required>
           
    <div class="error" id="emailError">Please enter a valid email</div>

    <?php if(session('errors.Email')) : ?>
        <div style="color: #e74c3c; font-size: 14px; margin-top: 5px; display: block;">
            <?= session('errors.Email') ?>
        </div>
    <?php endif ?>
</div>

             <div class="form-group">
                <label for="noHP" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                <input type="text" id="noHP" class="input-field" placeholder="Enter your phone number" name="noHP">
            </div>

            <div class="form-group relative">
                <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="Password" class="input-field" placeholder="Enter your password" name="Password" required>
                <span class="password-toggle" onclick="togglePassword('Password')">👁️</span>
                <div class="error" id="PasswordError">Password must be at least 6 characters</div>
            </div>

            <button type="submit" class="register-btn">Register</button>
        </form>

        <p class="text-center mt-4 text-gray-600 text-sm">Already have an account? 
            <a href="<?= base_url('login') ?>" class="text-blue-500 underline">Sign in</a>
        </p>
    </div>
<script>
        // --- BAGIAN 1: CEK ERROR DARI SERVER (PHP/CI4) ---
        // Kode ini akan tetap valid meski tidak ada error (karena PHP hanya mencetak isinya jika ada)
        <?php if (session()->getFlashdata('errors')) : ?>
            let messages = [];
            <?php foreach (session()->getFlashdata('errors') as $field => $error) : ?>
                messages.push("<?= esc($error) ?>");
            <?php endforeach ?>
            
            // Munculkan Pop Up Alert jika ada error dari server
            alert("Gagal Register:\n\n" + messages.join("\n"));
        <?php endif; ?>

        // --- BAGIAN 2: FUNGSI JAVASCRIPT STANDAR (SELALU JALAN) ---

        // Fungsi Toggle Password
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }

        function showError(id) {
            document.getElementById(id).style.display = 'block';
        }

        function hideError(id) {
            document.getElementById(id).style.display = 'none';
        }

        // --- BAGIAN 3: VALIDASI CLIENT SIDE ---
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            // Mencegah form submit otomatis dulu
            event.preventDefault(); 
            
            let isValid = true;

            // Full Name
            const fullName = document.getElementById('UserName').value;
            if (fullName.trim() === '') {
                showError('fullNameError');
                isValid = false;
            } else {
                hideError('fullNameError');
            }

            // Email
            const email = document.getElementById('Email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showError('emailError');
                isValid = false;
            } else {
                hideError('emailError');
            }

            // Password
            const password = document.getElementById('Password').value;
            if (password.length < 6) {
                showError('PasswordError');
                isValid = false;
            } else {
                hideError('PasswordError');
            }

            // --- Cek Hasil Validasi ---
            // Jika semua validasi JS lolos, baru submit form ke server
            if (isValid) {
                this.submit();
            }
        });
    </script>
</body>
</html>
