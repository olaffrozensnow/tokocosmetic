<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Navbar</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">


            <div class="navbar-brand">
                <?php if (session()->get('logged_in')): ?>
                <span>Halo, <?= esc(session()->get('UserName')) ?> 👋</span>
                <?php endif; ?>
            </div>

            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav mb-2 mb-lg-0 d-flex gap-3">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/pengguna/menuapp') ?>">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/about') ?>">About Us</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('products')?>">Product</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/orders') ?>">Orders</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?= base_url('/kuis') ?>">Quiz</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/feedback')?>">Feedback</a></li>
                </ul>
            </div>


            <div class="d-flex">
                <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger">Logout</a>
                <?php else: ?>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">Login/Register</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>
</body>

</html>