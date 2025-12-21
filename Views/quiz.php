<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Sederhana</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        min-height: 100vh;
    }

    /* Navbar Styles */
    .navbar {
        background-color: white;
        padding: 15px 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .navbar-greeting {
        font-size: 16px;
        color: #333;
    }

    .navbar-menu {
        display: flex;
        gap: 30px;
        list-style: none;
    }

    .navbar-menu a {
        text-decoration: none;
        color: #666;
        font-size: 15px;
        transition: color 0.3s;
    }

    .navbar-menu a:hover {
        color: #333;
    }

    .navbar-logout {
        padding: 8px 20px;
        border: 2px solid #e74c3c;
        background-color: white;
        color: #e74c3c;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar-logout:hover {
        background-color: #e74c3c;
        color: white;
    }

    .main-wrapper {
        width: 100%;
        padding: 20px;
    }

    .quiz-container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 24px;
    }

    .question {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fafafa;
    }

    .question h3 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #555;
        font-size: 16px;
        line-height: 1.5;
    }

    label {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    label:hover {
        background-color: #f0f0f0;
    }

    input[type="radio"] {
        margin-right: 10px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        margin-top: 20px;
    }

    button:hover {
        background-color: #45a049;
    }

    .result-display {
        margin-top: 20px;
        padding: 20px;
        background: #e3f2fd;
        border-radius: 8px;
        border-left: 4px solid #2196F3;
    }

    .result-display h3 {
        color: #1976D2;
        margin-bottom: 10px;
    }

    .result-display p {
        font-size: 18px;
        color: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-wrapper {
            padding: 15px;
        }

        .quiz-container {
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .question {
            padding: 12px;
        }

        .question h3 {
            font-size: 15px;
        }

        label {
            padding: 6px;
            font-size: 14px;
        }

        button {
            padding: 10px 20px;
            font-size: 15px;
        }

        .result-display p {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .main-wrapper {
            padding: 10px;
        }

        .quiz-container {
            padding: 15px;
        }

        h1 {
            font-size: 18px;
        }

        .question h3 {
            font-size: 14px;
        }

        label {
            font-size: 13px;
        }

        button {
            font-size: 14px;
        }

        .result-display {
            padding: 15px;
        }

        .result-display p {
            font-size: 15px;
        }
    }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?= $this->include('layouts/navbar') ?>

        <div class="quiz-container">
            <h1>Ketahui Jenis Kulit Anda</h1>
            <form method="post" action="<?= base_url('kuis') ?>">
                <div class="question">
                    <h3>1. Bagaimana kondisi kulit wajah Anda setelah bangun tidur di pagi hari?</h3>
                    <label><input type="radio" name="q1" value="oily"> a. Berminyak di seluruh wajah</label>
                    <label><input type="radio" name="q1" value="dry"> b. Kering atau terasa kencang</label>
                    <label><input type="radio" name="q1" value="combo"> c. Berminyak di T-Zone (dahi, hidung, dagu)
                        saja</label>
                    <label><input type="radio" name="q1" value="normal"> d. Normal, tidak terlalu berminyak atau
                        kering</label>
                </div>

                <div class="question">
                    <h3>2. Bagaimana kulit Anda terasa setelah mencuci wajah tanpa menggunakan pelembap?</h3>
                    <label><input type="radio" name="q2" value="dry"> a. Segera terasa kering atau tertarik</label>
                    <label><input type="radio" name="q2" value="oily"> b. Masih terasa lembap dan nyaman</label>
                    <label><input type="radio" name="q2" value="normal"> c. Cepat berminyak kembali</label>
                </div>

                <div class="question">
                    <h3>3. Apakah Anda sering mengalami jerawat atau komedo?</h3>
                    <label><input type="radio" name="q3" value="oily"> a. Sering di seluruh wajah</label>
                    <label><input type="radio" name="q3" value="combo"> b. Jarang sekali</label>
                    <label><input type="radio" name="q3" value="normal"> c. Hanya di area tertentu (misalnya dahi atau
                        hidung)</label>
                </div>

                <div class="question">
                    <h3>4. Bagaimana kulit Anda bereaksi ketika cuaca panas?</h3>
                    <label><input type="radio" name="q4" value="oily"> a. Mudah berminyak dan mengilap</label>
                    <label><input type="radio" name="q4" value="dry"> b. Terasa kering dan kusam</label>
                    <label><input type="radio" name="q4" value="normal"> c. Normal, tidak terlalu berminyak atau
                        kering</label>
                </div>

                <div class="question">
                    <h3>5. Saat menggunakan produk baru (seperti skincare atau kosmetik), kulit Anda biasanya:</h3>
                    <label><input type="radio" name="q5" value="sensitive"> a. Mudah iritasi, kemerahan, atau
                        gatal</label>
                    <label><input type="radio" name="q5" value="normal"> b. Tidak mengalami reaksi apa pun</label>
                    <label><input type="radio" name="q5" value="combo"> c. Hanya kadang-kadang bereaksi</label>
                </div>

                <div class="question">
                    <h3>6. Bagaimana tekstur kulit Anda jika diraba?</h3>
                    <label><input type="radio" name="q6" value="normal"> a. Halus dan lembut</label>
                    <label><input type="radio" name="q6" value="dry"> b. Kasar atau bersisik</label>
                    <label><input type="radio" name="q6" value="oily"> c. Licin dan berminyak di beberapa bagian</label>
                </div>

                <div class="question">
                    <h3>7. Apakah pori-pori Anda terlihat besar dan jelas?</h3>
                    <label><input type="radio" name="q7" value="oily"> a. Ya, terutama di area hidung dan pipi</label>
                    <label><input type="radio" name="q7" value="dry"> b. Tidak, pori-pori hampir tidak terlihat</label>
                    <label><input type="radio" name="q7" value="combo"> c. Sedikit terlihat di area tertentu</label>
                </div>

                <div class="question">
                    <h3>8. Apakah Anda sering mengalami jerawat atau komedo?</h3>
                    <label><input type="radio" name="q8" value="oily"> a. Ya, kalau tidak kulit terasa kering</label>
                    <label><input type="radio" name="q8" value="normal"> b. Tidak terlalu perlu </label>
                    <label><input type="radio" name="q8" value="combo"> c. Hanya di area tertentu</label>
                </div>

                <button type="submit">Lihat Hasil</button>
            </form>

            <?php if (isset($hasil)): ?>
            <div class="result-display">
                <h3>Hasil Tes Kulit Kamu:</h3>
                <p>
                    <?php
                    switch ($hasil) {
                        case 'oily':
                            echo "✨ Jenis kulit kamu adalah <b>BERMINYAK</b>.";
                            break;
                        case 'dry':
                            echo "💧 Jenis kulit kamu adalah <b>KERING</b>.";
                            break;
                        case 'combo':
                            echo "🌗 Jenis kulit kamu adalah <b>KOMBINASI</b>.";
                            break;
                        case 'normal':
                            echo "🌸 Jenis kulit kamu adalah <b>NORMAL</b>.";
                            break;
                        case 'sensitive':
                            echo "⚠️ Jenis kulit kamu adalah <b>SENSITIF</b>.";
                            break;
                    }
                ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>