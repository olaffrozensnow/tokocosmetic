<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Skincare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
        min-height: 100vh;
        background: linear-gradient(135deg, #f7f4f1 0%, #e8ddd4 50%, #ddd0c0 100%);
    }

    .navbar {
        position: absolute;
        top: 20px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent;
        z-index: 1000;
    }

    .nav-links {
        display: flex;
        gap: 30px;
        backdrop-filter: blur(10px);
        padding: 12px 30px;
        margin-top: 1%;
        border-radius: 50px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .nav-links a {
        text-decoration: none;
        font-size: 14px;
        color: #333;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .nav-links a:hover {
        background: rgba(139, 118, 102, 0.2);
        color: #8b7666;
        transform: translateY(-2px);
    }

    .login {
        position: absolute;
        right: 60px;
        top: 32px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 25px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .login:hover {
        background: rgba(139, 118, 102, 0.2);
        color: #8b7666;
        transform: translateY(-2px);
    }

    .hero {
        position: relative;
        height: 65vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1556228720-195a672e8a03?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 120px 20px 60px;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(1px);
        z-index: 1;
    }

    .hero h1 {
        font-size: clamp(4rem, 10vw, 8rem);
        font-weight: 900;
        letter-spacing: -0.02em;
        line-height: 0.85;
        margin-bottom: 1.5rem;
        color: #ffffff;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        font-weight: 500;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .search-wrapper {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 8px;
        border-radius: 60px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        width: 100%;
        max-width: 600px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .search-wrapper:hover {
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
        transform: translateY(-2px);
    }

    .search-wrapper label {
        font-weight: 600;
        color: #8b7666;
        font-size: 14px;
        margin-left: 20px;
        white-space: nowrap;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        padding: 15px 0;
        font-size: 1rem;
        color: #334155;
    }

    .search-input::placeholder {
        color: #94a3b8;
    }

    .cart-icon {
        font-size: 1.5rem;
        color: white;
        background: #8b7666;
        padding: 12px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(139, 118, 102, 0.4);
    }

    .cart-icon:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(139, 118, 102, 0.5);
        background: #7a6659;
    }

    .products {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f7f4f1 0%, #e8ddd4 50%, #ddd0c0 100%);
        position: relative;
    }

    .products::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="0.5" fill="white" opacity="0.3"/><circle cx="80" cy="40" r="0.3" fill="white" opacity="0.2"/><circle cx="40" cy="80" r="0.4" fill="white" opacity="0.25"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 900;
        color: #5d4e37;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(93, 78, 55, 0.2);
        letter-spacing: -0.02em;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #8b7666;
        font-weight: 400;
        text-shadow: 0 1px 5px rgba(139, 118, 102, 0.1);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
        z-index: 1;
    }

    .product-card:hover::before {
        left: 100%;
    }

    .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .product-image {
        background: linear-gradient(135deg, #faf8f5 0%, #f2ede6 100%);
        padding: 30px;
        border-radius: 18px;
        margin-bottom: 25px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
        box-shadow: inset 0 2px 10px rgba(139, 118, 102, 0.1);
    }

    .product-image:hover {
        background: linear-gradient(135deg, #f2ede6 0%, #ede4d6 100%);
        box-shadow: inset 0 4px 20px rgba(139, 118, 102, 0.15);
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        filter: drop-shadow(0 4px 15px rgba(139, 118, 102, 0.2));
    }

    .product-card:hover .product-image img {
        transform: scale(1.1) rotate(2deg);
    }

    .product-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
    }

    .product-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #2d3748;
        line-height: 1.4;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .product-card .price {
        font-size: 1.4rem;
        font-weight: 800;
        color: #8b7666;
        margin-bottom: 5px;
        text-shadow: 0 1px 5px rgba(139, 118, 102, 0.2);
    }

    .product-card .stock-label {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .product-card form button {
        border: none;
        background: #8b7666;
        color: white;
        padding: 15px 25px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 600;
        width: 100%;
        margin-top: auto;
        box-shadow: 0 8px 25px rgba(139, 118, 102, 0.3);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .product-card form button:disabled,
    .product-card form button[disabled] {
        background-color: #ccc !important;
        cursor: not-allowed !important;
        box-shadow: none !important;
        transform: none !important;
    }

    .product-card form button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .product-card form button:not(:disabled):hover::before {
        left: 100%;
    }

    .product-card form button:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(139, 118, 102, 0.4);
        background: #7a6659;
    }

    .product-card form button:not(:disabled):active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(139, 118, 102, 0.3);
    }

    .product-card form button i {
        margin-right: 8px;
        font-size: 14px;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #8b7666;
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(139, 118, 102, 0.4);
        z-index: 10001;
        display: none;
        font-weight: 600;
        font-size: 14px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease-out;
        opacity: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .error {
        background: #d32f2f;
        box-shadow: 0 15px 35px rgba(211, 47, 47, 0.4);
    }

    .modal {
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        padding: 20px;
    }

    .modal.open {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 20px;
        width: 90%;
        max-width: 900px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: zoomIn 0.3s ease-out;
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(15px);
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .modal-close {
        color: #8b7666;
        position: absolute;
        top: 15px;
        right: 25px;
        font-size: 36px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .modal-close:hover,
    .modal-close:focus {
        color: #5d4e37;
        text-decoration: none;
    }

    .modal-image-wrapper {
        background: linear-gradient(135deg, #faf8f5 0%, #f2ede6 100%);
        border-radius: 16px;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 300px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-image {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 12px;
        filter: drop-shadow(0 4px 15px rgba(139, 118, 102, 0.4));
    }

    .modal-details h2 {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 10px;
        color: #333;
    }

    .modal-details .modal-price {
        font-size: 1.8rem;
        font-weight: 800;
        color: #8b7666;
        margin-bottom: 25px;
    }

    .modal-details p {
        font-size: 1rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
        padding: 15px;
        background: #f8f8f8;
        border-radius: 10px;
        border-left: 5px solid #8b7666;
    }

    #modalAddToCartForm button {
        background: #5d4e37;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        border: none;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        box-shadow: 0 10px 25px rgba(93, 78, 55, 0.4);
        text-transform: uppercase;
    }

    #modalAddToCartForm button:hover:not(:disabled) {
        background: #4a3e31;
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(93, 78, 55, 0.5);
    }

    @media (max-width: 768px) {
        .modal-content {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px;
        }

        .modal-image-wrapper {
            height: 250px;
        }

        .modal-details h2 {
            font-size: 1.8rem;
        }

        .modal-details .modal-price {
            font-size: 1.5rem;
        }
    }
    </style>
</head>

<body>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="notification" style="display: block; opacity: 1;">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="notification error" style="display: block; opacity: 1;">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>
    <?= $this->include('layouts/navbar') ?>
    <main>
        <section class="hero">
            <h1>SHOP<br>NOW</h1>
            <p class="hero-subtitle">Discover premium skincare products for your daily routine</p>
            <div class="search-wrapper">
                <label for="search">FIND YOUR PERFECT MATCH</label>
                <input type="search" id="search" class="search-input" placeholder="Search skincare products...">
                <a href="<?= base_url('cart') ?>" class="fas fa-shopping-cart cart-icon"></a>
            </div>
        </section>
        <section class="products">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Featured Products</h2>
                    <p class="section-subtitle">Curated skincare essentials for every skin type</p>
                </div>
                <div class="product-grid">
                    <?php foreach ($products as $product): ?>
                    <?php
                        $imageBase64Data = $product['GambarProduct'] ?? null;
                        $imageSrc = !empty($imageBase64Data) ? "data:image/jpeg;base64," . $imageBase64Data : base_url('img/default.png');
                        
                    ?>
                    <div class="product-card" data-id="<?= esc($product['productID']); ?>"
                        data-name="<?= esc($product['productName']); ?>" data-price="<?= esc($product['Harga']); ?>"
                        data-image-base64="<?= esc($imageBase64Data); ?>"
                        data-description="<?= esc($product['Deskripsi'], 'attr'); ?>"

                        data-stock="<?= esc($product['Stok']); ?>">

                        <div class="product-image" onclick="openProductModal(this)">
                            <?php if (!empty($product['GambarProduct'])): ?>
                            <img src="<?= $imageSrc ?>" alt="<?= esc($product['productName']); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="product-info">
                            <h3><?= esc($product['productName']); ?></h3>
                            <p class="price">Rp. <?= number_format($product['Harga'], 0, ',', '.'); ?></p>
                            <p class="stock-label"
                                style="color: <?= ($product['Stok'] > 0) ? '#4CAF50' : '#D32F2F'; ?>;">
                                Stok: <span
                                    id="stok-value-<?= esc($product['productID']); ?>"><?= esc($product['Stok']); ?></span>
                                <?= ($product['Stok'] <= 0) ? ' (HABIS)' : ''; ?>
                            </p>
                            <form action="<?= base_url('cart/add'); ?>" method="post">
                                <input type="hidden" name="productID" value="<?= $product['productID']; ?>">
                                <input type="hidden" name="productName" value="<?= esc($product['productName']); ?>">
                                <input type="hidden" name="Harga" value="<?= $product['Harga']; ?>">
                                <button type="submit" data-product-id="<?= esc($product['productID']); ?>"
                                    <?= ($product['Stok'] <= 0) ? 'disabled' : ''; ?>>
                                    <i class="fas fa-cart-plus"></i>
                                    <?= ($product['Stok'] <= 0) ? 'Stok Habis' : 'Add to Cart'; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <div class="modal-image-wrapper">
                <img id="modalProductImage" src="" alt="Product Image" class="modal-image">
            </div>
            <div class="modal-details">
                <h2 id="modalProductName">Nama Produk</h2>
                <p id="modalProductPrice" class="modal-price">Rp. 0</p>
                <p id="modalProductDescription"></p>
                <form id="modalAddToCartForm" action="<?= base_url('cart/add'); ?>" method="post">
                    <input type="hidden" name="productID" id="modalProductID">
                    <input type="hidden" name="productName" id="modalFormProductName">
                    <input type="hidden" name="Harga" id="modalFormHarga">
                    <button type="submit">
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    setTimeout(function() {
        const notification = document.querySelector('.notification');
        if (notification && notification.style.opacity === '1') {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100px)';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 300);
        }
    }, 3000);

    // Search Functionality
    const searchInput = document.getElementById('search');
    const productCards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();

        productCards.forEach(card => {
            const productName = card.getAttribute('data-name').toLowerCase();
            const productPrice = card.getAttribute('data-price');
            const productDescription = card.getAttribute('data-description').toLowerCase();

            // Cek apakah search term cocok dengan nama, harga, atau deskripsi
            if (productName.includes(searchTerm) ||
                productPrice.includes(searchTerm) ||
                productDescription.includes(searchTerm)) {
                card.style.display = 'flex';
                card.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                card.style.display = 'none';
            }
        });

        // Tampilkan pesan jika tidak ada hasil
        const visibleCards = Array.from(productCards).filter(card => card.style.display !== 'none');
        const productGrid = document.querySelector('.product-grid');
        let noResultMsg = document.querySelector('.no-result-message');

        if (visibleCards.length === 0 && searchTerm !== '') {
            if (!noResultMsg) {
                noResultMsg = document.createElement('div');
                noResultMsg.className = 'no-result-message';
                noResultMsg.style.cssText = `
                    grid-column: 1 / -1;
                    text-align: center;
                    padding: 60px 20px;
                    font-size: 1.2rem;
                    color: #8b7666;
                    font-weight: 600;
                `;
                noResultMsg.innerHTML = `
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; display: block; opacity: 0.5;"></i>
                    Tidak ada produk yang cocok dengan pencarian "${searchTerm}"
                `;
                productGrid.appendChild(noResultMsg);
            } else {
                noResultMsg.innerHTML = `
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; display: block; opacity: 0.5;"></i>
                    Tidak ada produk yang cocok dengan pencarian "${searchTerm}"
                `;
            }
        } else if (noResultMsg) {
            noResultMsg.remove();
        }
    });

    function openProductModal(element) {
        const card = element.closest('.product-card');
        if (!card) return;

        const id = card.getAttribute('data-id');
        const name = card.getAttribute('data-name');
        const price = card.getAttribute('data-price');
        const Deskripsi = card.getAttribute('data-description');
        const imageBase64 = card.getAttribute('data-image-base64');
        const stock = parseInt(card.getAttribute('data-stock'));

        let imageSrc = '';
        if (imageBase64) {
            imageSrc = 'data:image/jpeg;base64,' + imageBase64;
        } else {
            const imgElement = card.querySelector('.product-image img');
            if (imgElement) {
                imageSrc = imgElement.src;
            }
        }

        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);

        document.getElementById('modalProductName').textContent = name;
        document.getElementById('modalProductPrice').textContent = formattedPrice;
       

        const stockStatus = stock > 0 ? `<span style="color:#4CAF50; font-weight:700;">Stok Tersedia: ${stock}</span>` :
            `<span style="color:#D32F2F; font-weight:700;">Stok Habis</span>`;
        document.getElementById('modalProductDescription').innerHTML = Deskripsi + '<br><br>' + stockStatus;

        document.getElementById('modalProductImage').src = imageSrc;
        document.getElementById('modalProductImage').alt = name;

        document.getElementById('modalProductID').value = id;
        document.getElementById('modalFormProductName').value = name;
        document.getElementById('modalFormHarga').value = price;

        const modalButton = document.querySelector('#modalAddToCartForm button');
        if (stock <= 0) {
            modalButton.disabled = true;
            modalButton.textContent = 'Stok Habis';
            modalButton.style.backgroundColor = '#ccc';
            modalButton.style.boxShadow = 'none';
            modalButton.style.cursor = 'not-allowed';
        } else {
            modalButton.disabled = false;
            modalButton.innerHTML = '<i class="fas fa-cart-plus"></i> Tambah ke Keranjang';
            modalButton.style.backgroundColor = '#5d4e37';
            modalButton.style.boxShadow = '0 10px 25px rgba(93, 78, 55, 0.4)';
            modalButton.style.cursor = 'pointer';
        }

        const modal = document.getElementById('productModal');
        modal.classList.add('open');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('productModal');
        const closeBtn = document.querySelector('.modal-close');
        const forms = document.querySelectorAll('form[action*="cart/add"]');

        closeBtn.onclick = function() {
            modal.classList.remove('open');
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove('open');
            }
        }

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button');
                if (button.disabled) {
                    e.preventDefault();
                    return;
                }

                const isModalForm = this.id === 'modalAddToCartForm';

                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                button.style.background = '#6b5b4f';

                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-check"></i> Added!';
                    button.style.background = '#4caf50';

                    setTimeout(() => {
                        button.disabled = false;
                        button.innerHTML = originalText;
                        button.style.background = isModalForm ? '#5d4e37' :
                            '#8b7666';
                    }, 2000);

                }, 500);
            });
        });
    });
    </script>
</body>
</html>