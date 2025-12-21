<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fafafa;
    }

    .hero {
      padding: 50px 0;
      text-align: center;
      background: linear-gradient(to bottom, #ffffff, #f3f3f3);
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 300;
    }

    .hero p {
      max-width: 600px;
      margin: 20px auto;
      font-size: 1.1rem;
      color: #5a5a5a;
    }

    .hover-card {
      transition: 0.3s;
    }

    .hover-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .section-title {
      font-size: 2.5rem;
      font-weight: 300;
      margin-bottom: 50px;
      text-align: center;
    }

    .modal-custom {
      animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.97); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
  <title>Nori Kosmetik</title>
</head>
<body>
 <?= $this->include('layouts/navbar') ?>
  <!-- HERO SECTION -->
  <section class="hero">
    <div class="container">
      <h1>Toko Nori Kosmetik</h1>
      <p>Produk kecantikan dengan kualitas terbaik dan pengalaman berbelanja yang nyaman.</p>
     
    </div>
  </section>

  <!-- STORY SECTION -->
  <section class="py-5 bg-white">
    <div class="container">
      <h2 class="section-title">Tentang Kami</h2>
      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="text-secondary" style="font-size:1.1rem; line-height:1.7;">
            Sejak 2019, Nori Kosmetik berkomitmen memberikan produk berkualitas tinggi dengan pelayanan terbaik. Kami percaya bahwa setiap orang berhak untuk tampil percaya diri.
          </p>
        </div>
        <div class="col-md-6">
          <img src="img/toko.png" class="img-fluid rounded hover-card" />
        </div>
      </div>
    </div>
  </section>



  <!-- VALUES SECTION -->
  <section class="py-5 bg-white">
    <div class="container">
      <h2 class="section-title">Nilai Kami</h2>
      <div class="row text-center g-4">

        <div class="col-md-4">
          <div class="p-4 bg-light rounded hover-card">
            <h5>Cepat</h5>
            <p class="text-muted">Selalu menghadirkan produk terbaru dari berbagai merk</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-light rounded hover-card">
            <h5>Kolaborasi</h5>
            <p class="text-muted">Berkembang bersama pelanggan dan tim.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-light rounded hover-card">
            <h5>Terpercaya</h5>
            <p class="text-muted">Produk aman dan pasti original</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="py-4 text-center text-secondary bg-light border-top">
    <small>© 2025 Nori Kosmetik • Semua Hak Dilindungi</small>
  </footer>

  <!-- MODAL -->
  <div class="modal fade" id="teamModal">
    <div class="modal-dialog">
      <div class="modal-content modal-custom p-4">
        <h4 id="modalName"></h4>
        <p class="text-muted" id="modalRole"></p>
        <p id="modalDesc"></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const modalEl = document.getElementById('teamModal')
    modalEl.addEventListener('show.bs.modal', function (event) {
      const card = event.relatedTarget;
      document.getElementById('modalName').innerText = card.getAttribute('data-name');
      document.getElementById('modalRole').innerText = card.getAttribute('data-role');
      document.getElementById('modalDesc').innerText = card.getAttribute('data-desc');
    });
  </script>

</body>
</html>
