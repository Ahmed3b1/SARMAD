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

            <h3>المتجر</h3>

            <ul>

                <li>
                    <a href="#">
                        ساعات
                    </a>
                </li>

                <li>
                    <a href="#">
                        عطور
                    </a>
                </li>

                <li>
                    <a href="{{route('privacypolicy')}}">
                         سياسة الخصوصية
                    </a>
                </li>

                <li>
                    <a href="{{route('terms')}}">
                         شروط الاستخدام
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
