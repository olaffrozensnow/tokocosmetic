<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .quiz-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .question h3 {
            margin-top: 0;
            color: #555;
        }
        label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
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
        #result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            display: none;
        }
        .correct { background-color: #d4edda; color: #155724; }
        .incorrect { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Ketahui Jenis Kulit anda</h1>
              <form method="post" action="<?= base_url('Kuis') ?>">
            <div class="question">
                <h3>1. Bagaimana kondisi kulit wajah Anda setelah bangun tidur di pagi hari?</h3>
                <label><input type="radio" name="q1" value="oily"> a. Berminyak di seluruh wajah</label>
                <label><input type="radio" name="q1" value="dry"> b. Kering atau terasa kencang</label>
                <label><input type="radio" name="q1" value="combo"> c. Berminyak di T-Zone (dahi, hidung, dagu) saja</label>
                <label><input type="radio" name="q1" value="normal">d. Normal, tidak terlalu berminyak atau kering</label>
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
                <label><input type="radio" name="q3" value="normal"> c. Hanya di area tertentu (misalnya dahi atau hidung)</label>
            </div>

             <div class="question">
                <h3>4. Bagaimana kulit Anda bereaksi ketika cuaca panas?</h3>
                <label><input type="radio" name="q4" value="oily"> a. Mudah berminyak dan mengilap</label>
                <label><input type="radio" name="q4" value="dry"> b. Terasa kering dan kusam</label>
                <label><input type="radio" name="q4" value="normal"> c. Normal, tidak terlalu berminyak atau kering</label>
            </div>

             <div class="question">
                <h3>5. Saat menggunakan produk baru (seperti skincare atau kosmetik), kulit Anda biasanya:</h3>
                <label><input type="radio" name="q5" value="sensitive"> a. Mudah iritasi, kemerahan, atau gatal</label>
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
                <label><input type="radio" name="q7" value="oily">  a. Ya, terutama di area hidung dan pipi</label>
                <label><input type="radio" name="q7" value="dry">  b. Tidak, pori-pori hampir tidak terlihat</label>
                <label><input type="radio" name="q7" value="combo">  c. Sedikit terlihat di area tertentu</label>
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
    <div id="result" style="margin-top: 20px; padding: 10px; background: #eef;">
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
<!-- 
  <div id="result"></div> -->

  <!-- <script>
function checkSkinType() {
  const answers = {
    q1: document.querySelector('input[name="q1"]:checked'),
    q2: document.querySelector('input[name="q2"]:checked'),
    q3: document.querySelector('input[name="q3"]:checked'),
    q4: document.querySelector('input[name="q4"]:checked'),
    q5: document.querySelector('input[name="q5"]:checked'),
    q6: document.querySelector('input[name="q6"]:checked'),
    q7: document.querySelector('input[name="q7"]:checked'),
    q8: document.querySelector('input[name="q8"]:checked')
  };

  // pastikan semua pertanyaan dijawab
  if (!answers.q1 || !answers.q2 || !answers.q3 || !answers.q4 || !answers.q5 || !answers.q6 || !answers.q7 || !answers.q8) {
    document.getElementById("result").innerHTML = "❗ Harap jawab semua pertanyaan dulu.";
    return;
  }

  // hitung hasil
  let oily = 0, dry = 0, combo = 0, normal = 0;
  Object.values(answers).forEach(a => {
    if (a.value === 'oily') oily++;
    else if (a.value === 'dry') dry++;
    else if (a.value === 'combo') combo++;
    else if (a.value === 'normal') normal++;
  });

  let result = '';
  const max = Math.max(oily, dry, combo, normal);
  if (max === oily) result = "Jenis kulit Anda: **Berminyak** 💧";
  else if (max === dry) result = "Jenis kulit Anda: **Kering** 🧴";
  else if (max === combo) result = "Jenis kulit Anda: **Kombinasi** 🌗";
  else result = "Jenis kulit Anda: **Normal** 🌿";

  document.getElementById("result").innerHTML = result;
}
</script> -->

</body>
</html>


