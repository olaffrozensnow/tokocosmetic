<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>

</head>

<body>
    <div class="navmain navbar">
        <div class="nav-links">
            <a href="<?= base_url('/') ?>">Home</a>
            <a href="<?= base_url('pengguna/AboutUs') ?>">About Us</a>
            <a href="<?= base_url('products') ?>">Products</a>
            <a href="<?= base_url('orders') ?>">Orders</a>
            <a href="<?= base_url('quiz') ?>">Quiz</a>
            <a href="<?= base_url('feedback') ?>">Feedback</a>
        </div>
        <div class="login">
            <a href="<?= base_url('login') ?>" style="text-decoration: none; color: black;">LOGIN/REGISTER</a>
        </div>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/landing1.jpg" class="d-block w-100" alt="..." style="border-radius: 3%;">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- BAGIAN 2 -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Shop With Us</h2>
            <div class="features-grid">
                <div class="feature-card animate-on-scroll">
                    <!-- <div class="feature-img"></div> -->
                    <img src="img/makeup.jpeg" class="feature-img" alt="..." style="margin-right: 50px;">
                    <h3>Lightning Fast</h3>
                    <!-- <p>Experience blazing-fast performance with our optimized infrastructure and cutting-edge technology.</p> -->
                </div>
                <div class="feature-card animate-on-scroll">

                    <img src="img/makeup.jpeg" class="feature-img" alt="..." style="margin-right: 50px;">
                    <h3>Secure & Reliable</h3>
                    <!-- <p>Enterprise-grade security protocols ensure your data is always protected and accessible.</p> -->
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">🎯</div>
                    <h3>Precision Tools</h3>
                    <!-- <p>Advanced analytics and intuitive tools to help you make data-driven decisions with confidence.</p> -->
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>