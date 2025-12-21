<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Pages::landingpage');

$routes->get('home', 'Home::index');

// Auth routes
$routes->get('login', 'Pengguna::login');          
$routes->post('pengguna/login', 'Pengguna::login');  
$routes->get('register', 'Pengguna::register');        
$routes->post('register', 'Pengguna::save');           
$routes->get('logout', 'Pengguna::logout');            

// Menu & Products
$routes->get('pengguna/menuapp', 'Menuapp::index', ['filter' => 'auth']);
$routes->get('menuapp', 'Menuapp::pengunjung');
$routes->get('products', 'Authenticated\Products::index');
$routes->get('products/detail/(:num)', 'Authenticated\Products::detail/$1');
$routes->get('ourproducts', 'ProductPages::halamanproduk');

// Pages
$routes->get('pages', 'Pages::index');
$routes->get('about', 'Pages::aboutus');
$routes->get('productDetail/(:alphanum)', 'Pages::detailProduct/$1'); // FIXED TYPO

// Payment
$routes->get('payment/checkout', 'Payment::checkout', ['filter' => 'auth']);
$routes->post('payment/checkout', 'Payment::checkout');
$routes->post('payment/saveOrder', 'Payment::saveOrder');
$routes->post('payment/notificationhandler', 'Payment::notificationHandler');

// Cart
$routes->post('cart/add', 'Cart::add', ['filter' => 'auth']);
$routes->get('cart', 'Cart::index', ['filter' => 'auth']);
$routes->post('cart/updateQuantity', 'Cart::updateQuantity', ['filter' => 'auth']);
$routes->post('cart/removeItem', 'Cart::removeItem', ['filter' => 'auth']);
// $routes->get('yourcart', 'CartPage::index');

// Orders
$routes->get('orders', 'OrderController::index');
$routes->get('orders/detail/(:num)', 'OrderController::detail/$1');

// Alamat
$routes->get('alamat/create', 'Alamat::create');
$routes->post('alamat/save', 'Alamat::save');
$routes->post('alamat/update', 'Alamat::update');
$routes->post('alamat/delete', 'Alamat::delete');
$routes->post('alamat/setPrimary', 'Alamat::setPrimary');

// Quiz/Kuis - gunakan match untuk GET & POST sekaligus
$routes->match(['get', 'post'], 'kuis', 'Kuis::index', ['filter' => 'auth']);
$routes->get('quiz', 'Quiz::index'); // Atau Pages::quiz jika mau

// Feedback
$routes->get('feedback', 'Feedback::feed');
$routes->get('feedback/create', 'Feedback::create');
$routes->post('feedback/store', 'Feedback::store');
$routes->post('feedback/delete/(:segment)', 'Feedback::delete/$1');

// Dashboard & Checkout
$routes->get('dashboard', 'Dashboard::dboard');
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout/processPayment', 'Checkout::processPayment');

// Product Board
$routes->get('productboard/create', 'ProductBoard::create');
$routes->post('productboard/save', 'ProductBoard::save');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin::index'); 
    $routes->get('login', 'Admin::login'); 
    $routes->post('attemptLogin', 'Admin::attemptLogin'); 
    $routes->get('logout', 'Admin::logout');
    
    $routes->get('dashboard', 'Admin::dashboard'); 
    
    // Products
    $routes->get('product', 'Admin\Product::index');
    $routes->get('product/create', 'Admin\Product::create');
    $routes->post('product/store', 'Admin\Product::store');
    $routes->get('product/edit/(:segment)', 'Admin\Product::edit/$1');
    $routes->post('product/update/(:segment)', 'Admin\Product::update/$1');
    $routes->get('product/delete/(:segment)', 'Admin\Product::delete/$1');
    
    // Orders
    $routes->get('pesanan', 'Admin\Pesanan::index');
    $routes->get('pesanan/getDetail/(:segment)', 'Admin\Pesanan::getDetail/$1');
    
    // Users
    $routes->get('users', 'Admin\users::index');
    
    // Shipping
    $routes->get('pengiriman', 'Admin\Pengiriman::index');
    $routes->post('pengiriman/store', 'Admin\Pengiriman::store');
    $routes->post('pengiriman/update', 'Admin\Pengiriman::update');
    $routes->get('pengiriman/delete/(:segment)', 'Admin\Pengiriman::delete/$1');
    $routes->get('pengiriman/debug', 'Admin\Pengiriman::debug');
    
    // Categories
    $routes->get('categories', 'Admin\Categories::index');
    $routes->post('categories/create', 'Admin\Categories::create');
    $routes->post('categories/update', 'Admin\Categories::update');
    $routes->get('categories/delete/(:segment)', 'Admin\Categories::delete/$1'); 
    
    // Feedback
    $routes->get('feedback', 'Admin\Feedback::index');
});