<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>سرمد | Watches & Perfumes</title>

    <link rel="stylesheet" href="{{ asset('assets/css/test4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sections.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Samrad">
        </div>

        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">ساعات</a></li>
            <li><a href="#">Perfumes</a></li>
            <li><a href="#">Collections</a></li>
        </ul>

        <div class="nav-actions">
            <a href="#" class="cart-btn">
                Cart
            </a>
        </div>

    </nav>


    <!-- HERO SECTION -->
    <section class="hero">

        <div class="overlay"></div>

        <div class="hero-content">

            <span class="luxury-badge">
                Luxury Watches & Perfumes
            </span>

            <h1>
                Timeless Elegance,
                Crafted For You
            </h1>

            <p>
                Discover premium watches and luxurious perfumes
                designed to elevate your everyday style.
            </p>

            <div class="hero-buttons">

                <a href="#" class="btn-primary">
                    Shop Now
                </a>

                <a href="#" class="btn-secondary">
                    Explore Collection
                </a>

            </div>

        </div>

    </section>




    <section class="best-sellers">

        <div class="section-header">

            <span>Most Loved</span>

            <h2>Best Sellers</h2>

            <p>
                Discover our most popular luxury pieces.
            </p>

        </div>

        <div class="slider-wrapper">

            <button class="slider-btn prev">
                &#10094;
            </button>

            <div class="products-slider">

                @for($i = 1; $i <= 8; $i++)

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('assets/images/watch-placeholder.png') }}" alt="watch">

                        <span class="badge">
                            Bestseller
                        </span>

                    </div>

                    <div class="product-info">

                        <h3>Classic Royal Watch</h3>

                        <p>
                            Elegant stainless steel design.
                        </p>

                        <div class="product-footer">

                            <span class="price">
                                2,499 EGP
                            </span>

                            <button>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

                @endfor

            </div>

            <button class="slider-btn next">
                &#10095;
            </button>

        </div>


    </section>



    <section class="collection-section">

        <div class="section-header">

            <span>Luxury Timepieces</span>

            <h2>Featured Watches</h2>

        </div>

        <div class="slider-wrapper">

            <button class="slider-btn prev">
                &#10094;
            </button>

            <div class="products-slider">

                @for($i = 1; $i <= 8; $i++)

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('assets/images/watch-placeholder.png') }}" alt="watch">

                    </div>

                    <div class="product-info">

                        <h3>Premium Watch</h3>

                        <p>Modern luxury style.</p>

                        <div class="product-footer">

                            <span class="price">
                                1,999 EGP
                            </span>

                            <button>
                                Add
                            </button>

                        </div>

                    </div>

                </div>

                @endfor

            </div>

            <button class="slider-btn next">
                &#10095;
            </button>

        </div>

    </section>


    <section class="collection-section">

        <div class="section-header">

            <span>Luxury Fragrances</span>

            <h2>Featured Perfumes</h2>

        </div>

        <div class="slider-wrapper">

            <button class="slider-btn prev">
                &#10094;
            </button>
            <div class="products-slider">

                @for($i = 1; $i <= 8; $i++)

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('assets/images/perfume-placeholder.png') }}" alt="perfume">

                    </div>

                    <div class="product-info">

                        <h3>Oud Prestige</h3>

                        <p>Long lasting premium fragrance.</p>

                        <div class="product-footer">

                            <span class="price">
                                899 EGP
                            </span>

                            <button>
                                Add
                            </button>

                        </div>

                    </div>

                </div>

                @endfor

            </div>

            <button class="slider-btn next">
                &#10095;
            </button>

        </div>

    </section>

    <script src="{{ asset('assets/js/test4.js') }}"></script>

</body>
<footer class="footer">

    <div class="footer-overlay"></div>

    <div class="footer-container">

        <div class="footer-brand">

            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt="Samrad"
            >

            <p>
                Luxury watches and perfumes crafted
                for timeless elegance.
            </p>

        </div>

        <div class="footer-column">

            <h3>Shop</h3>

            <ul>

                <li>
                    <a href="#">
                        Watches
                    </a>
                </li>

                <li>
                    <a href="#">
                        Perfumes
                    </a>
                </li>

                <li>
                    <a href="#">
                        Best Sellers
                    </a>
                </li>

            </ul>

        </div>

        <div class="footer-column">

            <h3>Support</h3>

            <ul>

                <li><a href="#">FAQ</a></li>

                <li><a href="#">Shipping</a></li>

                <li><a href="#">Returns</a></li>

            </ul>

        </div>

        <div class="footer-column">

            <h3>Contact</h3>

            <ul>

                <li>info@samrad.com</li>

                <li>+20 100 000 0000</li>

                <li>Egypt</li>

            </ul>

        </div>

    </div>

    <div class="footer-bottom">

        © {{ date('Y') }}
        Samrad. All Rights Reserved.

    </div>

</footer>
</html>





<section class="hero">

    <div class="hero-pattern"></div>

    <div class="container">

        <div class="row align-items-center min-vh-100">

            <div class="col-lg-6"
                data-aos="fade-up">

                <span class="hero-badge">

                    Luxury Collection

                </span>

                <h1>

                    الفخامة ليست اختياراً
                    بل هوية تدوم

                </h1>

                <p>

                    مجموعة مختارة من الساعات
                    والعطور الراقية لأصحاب
                    الذوق الرفيع.

                </p>

                <div class="hero-buttons">

                    <a href="{{ route('paymob.pay') }}"
                        class="btn-gold">

                        pay

                    </a>

                    <a href="#"
                        class="btn-outline-gold">

                        تسوق العطور

                    </a>

                </div>

            </div>

            <div class="col-lg-6 text-center"
                data-aos="fade-left">

                <img src="{{ asset('assets/images/hero-watch.png') }}"
                    class="hero-watch"
                    alt="watch">

            </div>

        </div>

    </div>

</section>

<section class="categories py-5">

    <div class="container">

        <div class="section-title">

            <h2>تسوق حسب الفئة</h2>

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <div class="category-card">

                    <img src="{{ asset('assets/images/watch-category.jpg') }}">

                    <div class="overlay">

                        <h3>الساعات</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="category-card">

                    <img src="{{ asset('assets/images/perfume-category.jpg') }}">

                    <div class="overlay">

                        <h3>العطور</h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="products py-5">

    <div class="container">

        <div class="section-title">

            <h2>الأكثر مبيعاً</h2>

        </div>

        <div class="row g-4">

            @for($i=0;$i<4;$i++)

            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <img src="https://placehold.co/400x400">

                    <div class="product-body">

                        <h5>ساعة سرمد</h5>

                        <span>2,500 جنيه</span>

                        <button>
                            أضف للسلة
                        </button>

                    </div>

                </div>

            </div>

            @endfor

        </div>

    </div>

</section>

<section class="about-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h2>عن سرمد</h2>

                <p>

                    علامة تجارية متخصصة
                    في الساعات والعطور
                    الراقية تجمع بين الأناقة
                    والقيمة.

                </p>

            </div>

            <div class="col-lg-6">

                <img
                    class="img-fluid rounded"
                    src="https://placehold.co/700x500">

            </div>

        </div>

    </div>

</section>

<section class="newsletter">

    <div class="container text-center">

        <h2>

            اشترك ليصلك كل جديد

        </h2>

        <form class="newsletter-form">

            <input
                type="email"
                placeholder="البريد الإلكتروني">

            <button>

                اشتراك

            </button>

        </form>

    </div>

</section>
