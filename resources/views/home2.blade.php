<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سرمد | الساعات والفخامة المتكاملة</title>
    <link rel="stylesheet" href="{{ asset('assets/css/test2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="main-header">
        <div class="container navbar">
            <div class="logo">
                <span class="brand-logo">سرمد</span>
            </div>
            <nav class="nav-links">
                <a href="#" class="active">الرئيسية</a>
                <a href="#">جميع المنتجات</a>
                <a href="#">الساعات</a>
                <a href="#">العطور</a>
            </nav>
            <div class="nav-actions">
                <a href="#" class="cart-icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>

    <section class="hero-section" style="background-image: url('{{ asset('images/Background 04.png') }}');">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="fade-in">علامة تجارية متخصصة في ساعات اليد والإكسسوارات الراقية</h1>
            <p class="fade-in delays-1">تقدم تصاميم أنيقة تعكس الذوق الرفيع بأسعار مدروسة وتجربة تجمع بين الجودة والأناقة.</p>
            <div class="hero-buttons fade-in delays-2">
                <a href="#" class="btn btn-primary">تسوق الساعات</a>
                <a href="#" class="btn btn-secondary">اكتشف العطور</a>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">مجموعاتنا الحصرية</h2>
            <div class="categories-grid">

                <div class="category-card scroll-reveal">
                    <div class="category-img-wrapper">
                        <div class="placeholder-img"><i class="fa-solid fa-clock"></i></div>
                    </div>
                    <div class="category-info">
                        <h3>ساعات يد فاخرة</h3>
                        <p>دقة التصميم التي تضفي لمسة من الفخامة لإطلالتك اليومية.</p>
                        <a href="#" class="text-link">تصفح المجموعة <i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                </div>

                <div class="category-card scroll-reveal">
                    <div class="category-img-wrapper">
                        <div class="placeholder-img"><i class="fa-solid fa-bottle-droplet"></i></div>
                    </div>
                    <div class="category-info">
                        <h3>عطور راقية</h3>
                        <p>نوتات عطرية ساحرة تعبر عن هويتك وأصالتك الفريدة.</p>
                        <a href="#" class="text-link">تصفح المجموعة <i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="values-banner">
        <div class="container values-wrapper">
            <div class="value-item">
                <i class="fa-solid fa-gem"></i>
                <h4>جودة استثنائية</h4>
            </div>
            <div class="value-item">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <h4>تصاميم أنيقة</h4>
            </div>
            <div class="value-item">
                <i class="fa-solid fa-tags"></i>
                <h4>قيمة ومكتبة أسعار مدروسة</h4>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container footer-content">
            <p>© 2026 سرمد. جميع الحقوق محفوظة.</p>
            <div class="payment-badges">
                <span class="badge-title">الدفع الآمن عبر Paymob:</span>
                <i class="fa-brands fa-cc-visa"></i>
                <i class="fa-brands fa-cc-mastercard"></i>
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/test2.js') }}"></script>
</body>
</html>
