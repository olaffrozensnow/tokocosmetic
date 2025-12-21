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
    /* CSS Reset and Basic Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #333;
        min-height: 100vh;
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
        background: rgba(255, 255, 255, 0.95);
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
    }

    .navmain.navbar {
        position: absolute;
        top: 0;
        width: 100%;
        background: transparent;
        z-index: 1000;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
    }


    /* Hero Section */
    .hero {
        position: relative;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 20px;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('https://images.unsplash.com/photo-1556228720-195a672e8a03?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        filter: brightness(0.6);
        z-index: -1;
        width: 100vw;
        height: 100vh;
    }

    .hero h1 {
        font-size: clamp(4rem, 15vw, 10rem);
        font-weight: 900;
        letter-spacing: 0.1em;
        line-height: 0.9;
        margin-bottom: 2rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        background: linear-gradient(45deg, #fff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Search Bar */
    .search-wrapper {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 20px 25px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.18);
        width: 100%;
        max-width: 700px;
        transition: all 0.3s ease;
    }

    .search-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }

    .search-wrapper label {
        font-weight: 600;
        white-space: nowrap;
        color: #555;
        font-size: 14px;
    }

    .search-input {
        width: 100%;
        border: none;
        outline: none;
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-radius: 30px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
}
    .search-input:focus {
        background-color: #fff;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .search-input::placeholder {
        color: #999;
    }

    .cart-icon {
        font-size: 1.8rem;
        color: #667eea;
        cursor: pointer;
        padding: 10px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .cart-icon:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: scale(1.1);
    }

    /* Products Section */
    .products {
        padding: 80px 20px;
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        min-height: 100vh;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .product-link {
        text-decoration: none;
        color: inherit;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        position: relative;
        overflow: hidden;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        transition: all 0.6s;
    }

    .product-card:hover::before {
        left: 100%;
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .product-image img {
        max-width: 100%;
        height: 220px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    /* Stiker Viva (Contoh) */
    .viva-sticker {
        position: absolute;
        top: 15px;
        left: 15px;
        width: 45px;
        height: 45px;
        z-index: 1;
    }

    .product-card h3 {
        font-size: 1.1rem;
        font-weight: 600;
        min-height: 50px;
        margin-bottom: 15px;
        color: #333;
        line-height: 1.4;
    }

    .product-card .price {
        font-size: 1.4rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
    }

    /* Cart Button Styling */
    .product-card form {
        margin-top: 15px;
    }

    .product-card button {
        border: none;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .product-card button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }

    .product-card button i {
        font-size: 18px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .nav-links {
            gap: 15px;
            padding: 10px 20px;
            flex-wrap: wrap;
        }

        .nav-links a {
            font-size: 12px;
            padding: 6px 12px;
        }

        .login {
            right: 20px;
            font-size: 12px;
            padding: 8px 16px;
        }

        .hero h1 {
            font-size: 3rem;
        }

        .search-wrapper {
            flex-direction: column;
            padding: 20px;
            gap: 15px;
        }

        .search-wrapper label {
            text-align: center;
            color: #5a67d8;
        }

        .product-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 0 10px;
        }

        .products {
            padding: 60px 10px;
        }
    }

    /* Animation keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .product-card:nth-child(even) {
        animation-delay: 0.1s;
    }

    .product-card:nth-child(3n) {
        animation-delay: 0.2s;
    }
    </style>
</head>

<body>

    <div class="navmain navbar">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Products</a>
            <a href="#">Orders</a>
            <a href="#">Quiz</a>
            <a href="#">Feedback</a>
        </div>
        <div class="login">LOGIN/REGISTER</div>
    </div>


    <main>
        <section class="hero">
            <h1>SHOP<br>NOW</h1>

            <div class="search-wrapper">

                <i class="fas fa-search search-icon"></i>
                <input type="search" id="search" class="search-input" placeholder="Search for skincare products...">
                <button class="search-clear" id="clearSearch" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
                <a href="yourcart" i class="fas fa-shopping-cart cart-icon"></i></a>
            </div>
             
        </section>
<div class="product-grid" id="productGrid">
    <?php foreach ($products as $product): ?>
        <div class="product-card"
            data-name="<?= strtolower(esc($product['productName'])) ?>"
            data-merk="<?= strtolower(esc($product['merk'] ?? '')) ?>"
            data-category="<?= strtolower(esc($product['categoryName'] ?? '')) ?>">

            <a href="/productDetail/<?= esc($product['productID']) ?>" class="product-link">

                <div class="product-image">
                    <img src="<?= base_url('img/' . $product['GambarProduct']); ?>"
                        alt="<?= esc($product['productName']); ?>">
                </div>

                <h3><?= esc($product['productName']); ?></h3>
                <p class="price">Rp. <?= number_format($product['Harga'], 0, ',', '.'); ?></p>

                <form action="<?= base_url('cartpage/add'); ?>" method="post">
                    <input type="hidden" name="productID" value="<?= $product['productID']; ?>">
                    <input type="hidden" name="productName" value="<?= esc($product['productName']); ?>">
                    <input type="hidden" name="Harga" value="<?= $product['Harga']; ?>">
                    <button type="submit">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>

            </a>
        </div>
    <?php endforeach; ?>
</div>

    </main>
    <script>
const searchInput = document.getElementById("search");
const clearBtn = document.getElementById("clearSearch");
const productCards = document.querySelectorAll(".product-card");

// Event saat mengetik
searchInput.addEventListener("input", function () {
    let query = searchInput.value.toLowerCase();

    // Tampilkan/Hide tombol clear
    clearBtn.style.display = query ? "block" : "none";

    productCards.forEach(card => {
        let name = card.getAttribute("data-name");
        let merk = card.getAttribute("data-merk");
        let category = card.getAttribute("data-category");

        if (
            name.includes(query) ||
            merk.includes(query) ||
            category.includes(query)
        ) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});

// Klik tombol clear
clearBtn.addEventListener("click", function () {
    searchInput.value = "";
    clearBtn.style.display = "none";

    // Reset semua product show lagi
    productCards.forEach(card => {
        card.style.display = "block";
    });
});
</script>

</body>

</html>