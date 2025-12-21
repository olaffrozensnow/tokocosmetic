<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #333;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Animated Background */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(0,0,0,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        animation: float 20s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Navigation Breadcrumb */
    .breadcrumb {
        padding: 20px 40px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .breadcrumb a {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: #333;
    }

    .breadcrumb .current {
        color: #333;
        font-weight: 600;
    }

    /* Main Container */
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 40px;
    }

    .product-detail {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        background: #ffffff;
        padding: 60px;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        animation: slideInUp 0.8s ease;
    }

    .product-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #333 0%, #666 50%, #333 100%);
        background-size: 200% 100%;
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Gallery Section */
    .gallery {
        position: relative;
    }

    .main-image-container {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 20px;
        overflow: hidden;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    .main-image {
        width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 16px;
        transition: transform 0.4s ease;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.1));
        animation: floatImage 3s ease-in-out infinite;
    }

    @keyframes floatImage {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .main-image:hover {
        transform: scale(1.05);
    }

    .thumbnails {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.7;
        position: relative;
        overflow: hidden;
    }

    .thumbnail::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .thumbnail:hover::before {
        transform: translateX(100%);
    }

    .thumbnail:hover,
    .thumbnail.active {
        border-color: #333;
        opacity: 1;
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Product Details */
    .details {
        position: relative;
        animation: slideInRight 0.8s ease 0.3s both;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .details h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 20px;
        color: #1a1a1a;
        line-height: 1.2;
        position: relative;
    }

    .details h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #333 0%, #666 100%);
        border-radius: 2px;
        animation: expandLine 1s ease 1s both;
    }

    @keyframes expandLine {
        from {
            width: 0;
        }

        to {
            width: 60px;
        }
    }

    .product-description {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 30px 0;
        padding: 20px;
        background: rgba(248, 249, 250, 0.8);
        border-radius: 12px;
        border-left: 4px solid #333;
        position: relative;
    }

    .product-description::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: 15px;
        font-size: 3rem;
        color: #333;
        opacity: 0.3;
        font-family: serif;
    }

    .price {
        font-size: 2.5rem;
        font-weight: 900;
        color: #333;
        margin: 30px 0;
        position: relative;
        display: inline-block;
    }

    .price::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        height: 8px;
        background: linear-gradient(135deg, rgba(51, 51, 51, 0.2) 0%, rgba(102, 102, 102, 0.2) 100%);
        border-radius: 4px;
        transform: scaleX(0);
        animation: fillPrice 1s ease 1.5s both;
    }

    @keyframes fillPrice {
        to {
            transform: scaleX(1);
        }
    }

    /* Rating Section */
    .rating-section {
        margin: 30px 0;
        padding: 20px;
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border-radius: 16px;
        border: 1px solid #e9ecef;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .stars {
        display: flex;
        gap: 2px;
    }

    .star {
        font-size: 1.2rem;
        color: #ffd700;
        animation: starTwinkle 2s ease-in-out infinite;
    }

    .star:nth-child(1) {
        animation-delay: 0s;
    }

    .star:nth-child(2) {
        animation-delay: 0.2s;
    }

    .star:nth-child(3) {
        animation-delay: 0.4s;
    }

    .star:nth-child(4) {
        animation-delay: 0.6s;
    }

    .star:nth-child(5) {
        animation-delay: 0.8s;
    }

    @keyframes starTwinkle {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
    }

    .rating-text {
        color: #666;
        font-size: 1rem;
        font-weight: 500;
    }

    .reviews-count {
        color: #333;
        font-weight: 600;
        cursor: pointer;
        text-decoration: underline;
        transition: color 0.3s ease;
    }

    .reviews-count:hover {
        color: #666;
    }

    /* Color Options */
    .colour-options {
        margin: 40px 0;
    }

    .colour-options h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .color-swatches {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .color-swatch {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .color-swatch:hover,
    .color-swatch.active {
        border-color: #333;
        transform: scale(1.2);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .color-swatch::after {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        border: 2px solid transparent;
        border-radius: 50%;
        transition: border-color 0.3s ease;
    }

    .color-swatch:hover::after {
        border-color: rgba(51, 51, 51, 0.3);
    }

    /* Action Buttons */
    .actions {
        display: flex;
        gap: 20px;
        margin-top: 50px;
        flex-wrap: wrap;
    }

    .action-button {
        flex: 1;
        min-width: 200px;
        padding: 18px 30px;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        color: white;
    }

    .action-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #333 0%, #666 100%);
        transition: left 0.3s ease;
        z-index: 0;
    }

    .action-button:hover::before {
        left: 0;
    }

    .action-button span {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .action-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    }

    .action-button i {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .action-button:hover i {
        transform: scale(1.2);
    }

    /* Product Features */
    .product-features {
        margin: 50px 0;
        padding: 30px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        border: 1px solid #dee2e6;
    }

    .product-features h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .features-list {
        list-style: none;
    }

    .features-list li {
        padding: 10px 0;
        color: #666;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: color 0.3s ease;
    }

    .features-list li:hover {
        color: #333;
    }

    .features-list li i {
        color: #28a745;
        font-size: 1.1rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .product-detail {
            grid-template-columns: 1fr;
            gap: 50px;
            padding: 40px;
        }

        .gallery {
            order: 1;
        }

        .details {
            order: 2;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .product-detail {
            padding: 30px 20px;
            border-radius: 16px;
        }

        .breadcrumb {
            padding: 15px 20px;
        }

        .details h1 {
            font-size: 2rem;
        }

        .price {
            font-size: 2rem;
        }

        .main-image-container {
            height: 300px;
            padding: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .action-button {
            min-width: unset;
        }

        .thumbnails {
            gap: 10px;
        }

        .thumbnail {
            width: 60px;
            height: 60px;
        }
    }

    /* Loading Animation */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .loading-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #333;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb">
        <a href="<?= base_url('/') ?>">Home</a> /
        <a href="<?= base_url('/products') ?>">Products</a> /
        <span class="current"><?= esc($product['productName']); ?></span>
    </nav>

    <div class="container">
        <div class="product-detail">
            <!-- Gallery Section -->
            <div class="gallery">
                <div class="main-image-container">
                    <img src="<?= base_url('img/' . $product['GambarProduct']); ?>"
                        alt="<?= esc($product['productName']); ?>" class="main-image" id="mainImage">
                </div>

                <div class="thumbnails">
                    <img src="<?= base_url('img/' . $product['GambarProduct']); ?>"
                        alt="<?= esc($product['productName']); ?>" class="thumbnail active"
                        onclick="changeMainImage(this.src)">
                    <!-- Additional thumbnail placeholders -->
                    <img src="<?= base_url('img/' . $product['GambarProduct']); ?>"
                        alt="<?= esc($product['productName']); ?>" class="thumbnail"
                        onclick="changeMainImage(this.src)">
                    <img src="<?= base_url('img/' . $product['GambarProduct']); ?>"
                        alt="<?= esc($product['productName']); ?>" class="thumbnail"
                        onclick="changeMainImage(this.src)">
                </div>
            </div>

            <!-- Product Details -->
            <div class="details">
                <h1><?= esc($product['productName']); ?></h1>

                <div class="product-description">
                    <?= esc($product['Deskripsi']); ?>
                </div>

                <div class="price">Rp. <?= number_format(esc($product['Harga']), 0, ',', '.'); ?></div>

                <div class="rating-section">
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star-half-alt star"></i>
                        </div>
                        <span class="rating-text">4.5 out of 5</span>
                    </div>
                    <span class="reviews-count">(441 verified reviews)</span>
                </div>

                <div class="colour-options">
                    <h3>Available Colors:</h3>
                    <div class="color-swatches">
                        <span class="color-swatch active" style="background: #ff6b35;"
                            onclick="selectColor(this)"></span>
                        <span class="color-swatch" style="background: #666666;" onclick="selectColor(this)"></span>
                        <span class="color-swatch" style="background: #2d5a27;" onclick="selectColor(this)"></span>
                        <span class="color-swatch" style="background: #1a365d;" onclick="selectColor(this)"></span>
                        <span class="color-swatch" style="background: #742a2a;" onclick="selectColor(this)"></span>
                    </div>
                </div>

                <div class="product-features">
                    <h3>Key Features:</h3>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i>Dermatologist tested and approved</li>
                        <li><i class="fas fa-leaf"></i>100% natural and organic ingredients</li>
                        <li><i class="fas fa-shield-alt"></i>Suitable for all skin types</li>
                        <li><i class="fas fa-heart"></i>Cruelty-free and vegan friendly</li>
                        <li><i class="fas fa-award"></i>Award-winning formula</li>
                    </ul>
                </div>

                <div class="actions">
                    <form action="<?= base_url('cart/add'); ?>" method="post" style="flex: 1;">
                        <input type="hidden" name="product_id" value="<?= $product['productID']; ?>">
                        <input type="hidden" name="product_name" value="<?= esc($product['productName']); ?>">
                        <input type="hidden" name="price" value="<?= $product['Harga']; ?>">
                        <button type="submit" class="action-button" onclick="showLoading()">
                            <span><i class="fas fa-shopping-cart"></i>Add to Cart</span>
                        </button>
                    </form>
                    <button class="action-button" onclick="buyNow()">
                        <span><i class="fas fa-bolt"></i>Buy Now</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Image Gallery Functions
    function changeMainImage(src) {
        const mainImage = document.getElementById('mainImage');
        mainImage.style.opacity = '0';

        setTimeout(() => {
            mainImage.src = src;
            mainImage.style.opacity = '1';
        }, 200);

        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        event.target.classList.add('active');
    }

    // Color Selection
    function selectColor(colorElement) {
        document.querySelectorAll('.color-swatch').forEach(swatch => {
            swatch.classList.remove('active');
        });
        colorElement.classList.add('active');

        // Add visual feedback
        colorElement.style.transform = 'scale(1.3)';
        setTimeout(() => {
            colorElement.style.transform = '';
        }, 200);
    }

    // Loading Functions
    function showLoading() {
        document.getElementById('loadingOverlay').classList.add('active');

        // Hide loading after form submission
        setTimeout(() => {
            document.getElementById('loadingOverlay').classList.remove('active');
        }, 2000);
    }

    function buyNow() {
        showLoading();
        // Add buy now logic here
        setTimeout(() => {
            alert('Redirecting to checkout...');
            document.getElementById('loadingOverlay').classList.remove('active');
        }, 1500);
    }

    // Smooth scroll to top when page loads
    window.addEventListener('load', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Add click effects to buttons
    document.querySelectorAll('.action-button').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                z-index: 0;
            `;

            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    });

    document.querySelectorAll('.product-detail').forEach(el => {
        observer.observe(el);
    });

    // Enhanced hover effects for interactive elements
    document.querySelectorAll('.thumbnail, .color-swatch, .action-button').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = `${this.style.transform} scale(1.05)`;
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = this.style.transform.replace(' scale(1.05)', '');
        });
    });
    </script>

</body>

</html>