<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('img/landing1.jpg');
        background-size: cover;
        background-position: center;
        filter: blur(8px);
        z-index: -2;
        width: 100vw;
        height: 100vh;
    }

    body::after {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: -1;
        width: 100vw;
        height: 100vh;
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

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }

    .login-btn {
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

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Login Your Account</h2>

        <!-- tampilkan flash error kalau ada -->
        <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <form id="loginForm" action="<?= base_url('pengguna/login') ?>" method="post">
            <div class="mb-4">
                <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="Email" class="input-field" placeholder="Enter your email" name="Email" required>
            </div>

            <div class="mb-4 relative">
                <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="Password" class="input-field" placeholder="Enter your password"
                    name="Password" required>
                <span class="password-toggle" onclick="togglePassword('Password')">👁️</span>
            </div>

            <button type="submit" class="login-btn">LOG IN</button>
        </form>

        <p class="text-center mt-4 text-gray-600 text-sm">
            Don’t have an account?
            <a href="<?= base_url('register') ?>" class="text-blue-500 underline">Register</a>
        </p>
    </div>

    <script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        input.type = (input.type === "password") ? "text" : "password";
    }
    </script>
</body>

</html>