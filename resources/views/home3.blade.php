<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>سرمد | ساعات وعطور راقية</title>
    <!-- Estedad Font (official variable font for modern Persian/Arabic UI) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/estedad@v3.0.0/fontface/stylesheet.css" rel="stylesheet">
    <!-- Font Awesome 6 (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Swiper JS for subtle animation and carousel elegance (lightweight) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Estedad', 'Segoe UI', Tahoma, sans-serif;
            background-color: #0b0f17;
            color: #e5e9f0;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #101624;
        }
        ::-webkit-scrollbar-thumb {
            background: #2c3e66;
            border-radius: 8px;
        }

        /* main color variable #171e31 */
        :root {
            --sarmad-primary: #171e31;
            --sarmad-gold: #c9a87b;
            --sarmad-gold-light: #dbbc91;
            --sarmad-dark-bg: #0d1222;
            --sarmad-card-bg: #1a2238;
            --sarmad-border: #2a344e;
            --sarmad-text-light: #f0f3fa;
        }

        /* background identity: using the uploaded background image (Background 04 aesthetic but we apply a unique overlay)
           We'll use a sophisticated dark gradient + abstract pattern that matches PDF's luxurious identity.
           Since "Background 04.pdf" provided a single '0' page, the actual visual from brand identity is interpreted:
           We create a premium hero background with subtle golden accents and geometric shapes inspired by Persian elegance.
        */
        .hero {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(135deg, rgba(23,30,49,0.92) 0%, rgba(13,18,34,0.96) 100%),
                        url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cGF0aCBmaWxsPSIjYzlhODdiIiBmaWxsLW9wYWNpdHk9IjAuMDYiIGQ9Ik0wIDBoNDB2NDBIMHoiLz48cGF0aCBmaWxsPSIjYzlhODdiIiBmaWxsLW9wYWNpdHk9IjAuMDgiIGQ9Ik0xMCAxMGgyMHYyMEgxMHoiLz48L3N2Zz4=');
            background-repeat: repeat;
            background-size: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-bottom: 2px solid rgba(201,168,123,0.3);
        }

        /* golden geometric shimmer (animated subtle pattern) */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 40%, rgba(201,168,123,0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(23,30,49,0.85);
            backdrop-filter: blur(12px);
            z-index: 1000;
            border-bottom: 1px solid rgba(201,168,123,0.25);
            transition: all 0.3s ease;
        }

        .logo {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }

        /* logo style derived from PDF pages: "سرمد" with refined calligraphic vibe */
        .logo-arabic {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #fff, #c9a87b);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
            font-family: 'Estedad', serif;
        }

        .logo-latin {
            font-size: 0.85rem;
            font-weight: 300;
            color: #c9a87b;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: #eef2ff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: 0.2s;
            border-bottom: 2px solid transparent;
            padding-bottom: 4px;
        }

        .nav-links a:hover {
            color: #c9a87b;
            border-bottom-color: #c9a87b;
        }

        .nav-icons {
            display: flex;
            gap: 1.2rem;
        }
        .nav-icons i {
            font-size: 1.3rem;
            cursor: pointer;
            color: #eef2ff;
            transition: 0.2s;
        }
        .nav-icons i:hover {
            color: #c9a87b;
            transform: scale(1.05);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 7rem 1.5rem 4rem;
            animation: fadeUp 0.9s ease-out;
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(35px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 3.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .hero-title span {
            color: #c9a87b;
            background: linear-gradient(145deg, #c9a87b, #e5cf9e);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-sub {
            font-size: 1.2rem;
            opacity: 0.85;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-btn {
            background: linear-gradient(95deg, #171e31, #1f2a46);
            border: 1px solid #c9a87b;
            padding: 0.9rem 2.2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            border-radius: 48px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Estedad', sans-serif;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            backdrop-filter: blur(4px);
        }

        .cta-btn:hover {
            background: #c9a87b;
            border-color: #c9a87b;
            color: #171e31;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -8px rgba(201,168,123,0.4);
        }

        /* Featured Section - pattern inspired from PDF pages that show minimalism & gold */
        .section-title {
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .section-title:after {
            content: "";
            display: block;
            width: 70px;
            height: 3px;
            background: #c9a87b;
            margin: 0.6rem auto 0;
            border-radius: 5px;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .product-card {
            background: var(--sarmad-card-bg);
            border-radius: 28px;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(201,168,123,0.25);
            transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-8px);
            border-color: #c9a87b;
            box-shadow: 0 18px 32px -12px rgba(0,0,0,0.5);
        }

        .card-img {
            height: 240px;
            background: linear-gradient(145deg, #1e283e, #131b2f);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #c9a87b;
            position: relative;
        }

        .card-img i {
            font-size: 4.8rem;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
            transition: 0.2s;
        }

        .product-card:hover .card-img i {
            transform: scale(1.05);
            color: #e2c294;
        }

        .card-info {
            padding: 1.5rem;
            text-align: center;
        }
        .card-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .price {
            color: #c9a87b;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0.7rem 0;
        }
        .btn-outline-gold {
            background: transparent;
            border: 1px solid #c9a87b;
            padding: 0.5rem 1.4rem;
            border-radius: 40px;
            color: #c9a87b;
            font-weight: 500;
            transition: 0.2s;
            cursor: pointer;
            font-family: 'Estedad', sans-serif;
        }
        .btn-outline-gold:hover {
            background: #c9a87b;
            color: #171e31;
        }

        /* luxury watch + perfume section divider */
        .category-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            max-width: 1200px;
            margin: 3rem auto;
            padding: 1rem;
        }
        .preview-card {
            background: rgba(23,30,49,0.7);
            backdrop-filter: blur(8px);
            border-radius: 2rem;
            flex: 1;
            min-width: 240px;
            text-align: center;
            padding: 2rem 1.5rem;
            border: 1px solid rgba(201,168,123,0.3);
            transition: all 0.3s;
        }
        .preview-card i {
            font-size: 3rem;
            color: #c9a87b;
            margin-bottom: 1rem;
        }
        .preview-card h3 {
            font-size: 1.7rem;
        }

        /* swiper animation for testimonial or lookbook (clean identity) */
        .lookbook {
            margin: 4rem auto;
            max-width: 1100px;
            padding: 0 1rem;
        }
        .swiper-slide {
            background: #1a2238;
            border-radius: 28px;
            padding: 2rem;
            text-align: center;
            border: 1px solid #2e3a58;
        }
        .swiper-slide i {
            font-size: 2.5rem;
            color: #c9a87b;
        }

        footer {
            background: #0a0f1c;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #2a344e;
            margin-top: 4rem;
        }

        /* responsive */
        @media (max-width: 800px) {
            .navbar {
                padding: 0.8rem 1.2rem;
                flex-wrap: wrap;
                gap: 0.8rem;
            }
            .nav-links {
                gap: 1rem;
                order: 3;
                width: 100%;
                justify-content: center;
            }
            .hero-title {
                font-size: 2.4rem;
            }
            .hero-sub {
                font-size: 1rem;
            }
        }

        @media (max-width: 550px) {
            .featured-grid {
                gap: 1rem;
            }
            .section-title {
                font-size: 1.8rem;
            }
        }

        /* Cart sidebar preview dummy (for phase 1 we just show interactive hint) */
        .cart-badge {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #c9a87b;
            color: #171e31;
            font-size: 0.7rem;
            font-weight: bold;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* identity pattern from pdf: subtle background texture */
        .bg-pattern-soft {
            background-image: radial-gradient(circle at 10% 20%, rgba(201,168,123,0.03) 2%, transparent 2.5%);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="bg-pattern-soft">

<!-- Navigation -->
<nav class="navbar">
    <div class="logo">
        <span class="logo-arabic">سرمد</span>
        <span class="logo-latin">SAR</span>
    </div>
    <div class="nav-links">
        <a href="#">الرئيسية</a>
        <a href="#">الساعات</a>
        <a href="#">العطور</a>
        <a href="#">المجموعات</a>
    </div>
    <div class="nav-icons">
        <i class="far fa-heart"></i>
        <div class="cart-badge">
            <i class="fas fa-shopping-bag" id="cartIcon"></i>
            <span class="cart-count" id="cartCount">0</span>
        </div>
        <i class="far fa-user"></i>
    </div>
</nav>

<!-- Hero Section with Background identity (luxury pattern + brand name) -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">سرمد <span>الخلود و الأناقة</span></h1>
        <p class="hero-sub">ساعات يدوية وعطور راقية تعبر عن الذوق الرفيع. تصميم خالد يجمع بين الفخامة والحداثة.</p>
        <button class="cta-btn" id="exploreBtn">استكشف المجموعة <i class="fas fa-arrow-left"></i></button>
    </div>
</section>

<!-- Featured Products Section: identity from PDF mentioning watches & perfumes -->
<div class="container" style="max-width: 1400px; margin: 4rem auto;">
    <h2 class="section-title">أيقونات سرمد</h2>
    <div class="featured-grid" id="featuredProducts">
        <!-- dynamic products from js (watches + perfumes) -->
    </div>
</div>

<!-- Dual Category Preview: watches & perfumes quick links -->
<div class="category-preview">
    <div class="preview-card" data-category="watches">
        <i class="fas fa-clock"></i>
        <h3>ساعات سرمد</h3>
        <p>تصاميم خالدة مع لمسات ذهبية</p>
        <button class="btn-outline-gold" style="margin-top: 12px;">تسوق الساعات</button>
    </div>
    <div class="preview-card" data-category="perfumes">
        <i class="fas fa-spray-can-sparkles"></i>
        <h3>عطور سرمد</h3>
        <p>روائح شرقية فاخرة تدوم طويلاً</p>
        <button class="btn-outline-gold" style="margin-top: 12px;">تسوق العطور</button>
    </div>
</div>

<!-- Lookbook slider (subtle animation / golden identity showcase) -->
<div class="lookbook">
    <h2 class="section-title">لحظات سرمد</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><i class="fas fa-gem"></i><p style="margin-top: 1rem;">إصدار محدود من الساعات الذهبية</p></div>
            <div class="swiper-slide"><i class="fas fa-feather-alt"></i><p style="margin-top: 1rem;">عطر "الخلود" مستوحى من العراقة</p></div>
            <div class="swiper-slide"><i class="fas fa-crown"></i><p style="margin-top: 1rem;">تشكيلة خاصة بمناسبة الموسم</p></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<footer>
    <p>© 2026 سرمد - ساعات وعطور فاخرة | جميع الحقوق محفوظة</p>
    <p style="font-size: 0.8rem; margin-top: 8px; opacity: 0.7;">هوية بصرية مستوحاة من الأصالة والتفرد</p>
</footer>

<!-- simple cart state (phase 1 demo) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Product catalog (watches & perfumes aligned with brand identity)
    const products = [
        { id: 1, name: "ساعة أثير", category: "watch", price: 1450, imgIcon: "fas fa-clock", description: "حركة سويسرية، ذهبي وردي" },
        { id: 2, name: "ساعة سرمد كلاسيك", category: "watch", price: 1890, imgIcon: "fas fa-hourglass-half", description: "جلد فاخر" },
        { id: 3, name: "ساعة الخلود", category: "watch", price: 2250, imgIcon: "fas fa-crown", description: "كريستال ياقوتي" },
        { id: 4, name: "عطر ملكي", category: "perfume", price: 580, imgIcon: "fas fa-flask", description: "عود و عنبر" },
        { id: 5, name: "عطر أزهار الليل", category: "perfume", price: 420, imgIcon: "fas fa-leaf", description: "مسك وزهر البرتقال" },
        { id: 6, name: "عطر سرمد الأسود", category: "perfume", price: 760, imgIcon: "fas fa-moon", description: "خشب الصندل" }
    ];

    // Cart array (simple for UI count)
    let cartItems = [];
    function updateCartCountUI() {
        const countEl = document.getElementById('cartCount');
        if(countEl) countEl.innerText = cartItems.length;
    }

    function addToCart(productId) {
        const product = products.find(p => p.id === productId);
        if(product){
            cartItems.push(product);
            updateCartCountUI();
            // subtle animation feedback
            const btn = document.querySelector(`.add-cart-btn[data-id='${productId}']`);
            if(btn) {
                btn.innerHTML = '✓ تم الإضافة';
                setTimeout(() => btn.innerHTML = 'أضف للسلة', 1200);
            }
            // Optional small toast feel
        }
    }

    // Render featured products grid (mix watches and perfumes, represent identity)
    function renderFeatured() {
        const container = document.getElementById('featuredProducts');
        if(!container) return;
        container.innerHTML = '';
        // show 4 featured items (2 watches, 2 perfumes for balance)
        const featured = [products[0], products[1], products[3], products[5]];
        featured.forEach(prod => {
            const card = document.createElement('div');
            card.className = 'product-card';
            const iconClass = prod.imgIcon;
            const categoryName = prod.category === 'watch' ? 'ساعة' : 'عطر';
            card.innerHTML = `
                <div class="card-img">
                    <i class="${iconClass}"></i>
                </div>
                <div class="card-info">
                    <h3>${prod.name}</h3>
                    <p style="font-size:0.8rem; color:#b9c2dd;">${prod.description}</p>
                    <div class="price">${prod.price.toLocaleString()} ر.س</div>
                    <button class="btn-outline-gold add-cart-btn" data-id="${prod.id}">أضف للسلة</button>
                </div>
            `;
            container.appendChild(card);
        });
        // attach event listeners
        document.querySelectorAll('.add-cart-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = parseInt(btn.getAttribute('data-id'));
                addToCart(id);
            });
        });
    }

    // small hover animation and cart icon preview: show alert (for demo)
    document.addEventListener('DOMContentLoaded', () => {
        renderFeatured();

        // swiper initialization for animation (elegant slider)
        if (typeof Swiper !== 'undefined') {
            new Swiper('.mySwiper', {
                loop: true,
                autoplay: { delay: 2800, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                effect: 'slide',
                speed: 700
            });
        }

        // cart icon click demo (phase hint)
        const cartBagIcon = document.getElementById('cartIcon');
        if(cartBagIcon){
            cartBagIcon.addEventListener('click', () => {
                if(cartItems.length === 0) alert('سلة التسوق فارغة حالياً. أضف منتجاتك المفضلة.');
                else alert(`لديك ${cartItems.length} منتج(منتجات) في السلة. سيتم تفعيل صفحة السلة في المرحلة القادمة.`);
            });
        }

        // explore button scroll to products
        const exploreBtn = document.getElementById('exploreBtn');
        if(exploreBtn){
            exploreBtn.addEventListener('click', () => {
                document.querySelector('.featured-grid')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }

        // category preview buttons redirection demo (phase 2 placeholder)
        const watchBtn = document.querySelector('.preview-card[data-category="watches"] .btn-outline-gold');
        const perfumeBtn = document.querySelector('.preview-card[data-category="perfumes"] .btn-outline-gold');
        if(watchBtn){
            watchBtn.addEventListener('click', () => alert('صفحة الساعات قريباً (المرحلة الثانية) ✨'));
        }
        if(perfumeBtn){
            perfumeBtn.addEventListener('click', () => alert('صفحة العطور الراقية قريباً ✨'));
        }

        // nav bar links placeholder but not annoying
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                if(link.innerText.includes('الساعات')) alert('سيتم توجيهك إلى متجر الساعات في الإصدار القادم');
                else if(link.innerText.includes('العطور')) alert('مجموعة العطور الفاخرة قريباً');
                else alert('جاري تجهيز المتجر بتجربة فاخرة');
            });
        });

        // Add hover animation + brand identity color for interactive cards
        // initial cart count set zero
        updateCartCountUI();
    });

    // Additional dynamic styling to reflect brand from PDF: the logo and design pattern "سرمد" in navbar already uses gradient.
    // We embed subtle identity decorative corners
    const styleSheet = document.createElement("style");
    styleSheet.textContent = `
        .product-card .card-img i {
            transition: all 0.25s;
        }
        .navbar .logo-arabic {
            font-feature-settings: "ss02";
        }
        .hero .cta-btn i {
            margin-right: 6px;
        }
    `;
    document.head.appendChild(styleSheet);

    // Responsive background identity applied with radial glow (already in hero)
    // Fully consistent with #171e31 main color and estedad font used everywhere.
    // The logo appears as "سرمد" and the identity from PDF page 2,4,5 has been used to inspire minimal luxury.
</script>
</body>
</html>
