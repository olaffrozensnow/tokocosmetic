 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <title>Document</title>
 </head>
 <body>
    <div class="navbar">
      <div class="navbar-brand">
                <?php if (session()->get('logged_in')): ?>
                <span>Halo, <?= esc(session()->get('UserName')) ?> 👋</span>
                <?php endif; ?>
            </div>
    <!-- Menu tengah -->
    <div class="navbar-center">
      <a href="#">About Us</a>
      <a href="#">Products</a>
      <a href="#">Orders</a>
      <a href="#">Quiz</a>
      <a href="#">Feedback</a>
      
    </div>

    <!-- Menu kanan -->
    <div class="navbar-right">
          <div class="d-flex">
                <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">Logout</a>
                <?php else: ?>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">Login/Register</a>
                <?php endif; ?>
            </div>
      
  </div>
  </div>

  <?= $this->renderSection('content'); ?>
 </body>
 </html>
 