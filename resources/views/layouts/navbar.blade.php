<!-- NAVBAR -->
    <nav class="navbar {{ request()->routeIs('home') ? 'navbar-home' : 'navbar-pages' }}"
     id="navbar">

        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Samrad">
        </div>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{route('home')}}">الرئيسية</a></li>
            <li><a href="{{route('watches')}}">ساعات</a></li>
            <li><a href="{{route('perfumes')}}">عطور</a></li>
            <li><a href="{{route('about')}}">عن سرمد</a></li>
        </ul>

        <div class="nav-actions">

            <a href="{{ route('cart') }}" class="cart-btn">

                <i class="fa-solid fa-cart-shopping"></i>

                <span>السلة</span>

                @if($cartCount > 0)
                    <span id="navbar-cart-count" class="cart-count">
                        {{ $cartCount }}
                    </span>
                @endif

            </a>

            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>

    </nav>
