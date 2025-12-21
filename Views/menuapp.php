<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>

    <!-- Carousel -->
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
                <img src="<?= base_url('img/landing2.png') ?>" class="d-block w-100" alt="Landing"
                    style="border-radius: 3%;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('img/landing11.jpeg') ?>" class="d-block w-100" alt="Landing"
                    style="border-radius: 3%;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('img/landing3.png') ?>" class="d-block w-100" alt="Landing"
                    style="border-radius: 3%;">
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
                    <img src="<?= base_url('img/makeup.jpeg') ?>" alt="makeup" class="feature-img"
                        style="margin-right: 50px;">
                    <h3>Make Up</h3>
                </div>
                <div class="feature-card animate-on-scroll">
                    <img src="<?= base_url('img/skincare.jpeg') ?>" alt="makeup" class="feature-img"
                        style="margin-right: 50px;">
                    <h3>Secure & Reliable</h3>
                </div>
                <div class="feature-card animate-on-scroll">
                    <img src="<?= base_url('img/bodycare.jpeg') ?>" alt="makeup" class="feature-img"
                        style="margin-right: 50px;">
                    <h3>Body Care</h3>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>