@extends('layouts.master')

@section('title','سرمد')

@section('content')

    <!-- HERO SECTION -->
    <section class="hero">

        <div class="overlay"></div>

        <div class="hero-content">

            <span class="luxury-badge">
                Luxury Watches & Perfumes
            </span>

            <h1>
                أسلوبٌ يعكس شخصيتك... وتفاصيل تصنع حضورك.
            </h1>

            <p>
                اكتشف تشكيلةً مختارة من الساعات الفاخرة والعطور الراقية، لتمنح حضورك لمسةً من التميز والأناقة.
            </p>

            <div class="hero-buttons">

                <a href="#" class="btn-primary">
                    تسوق الآن
                </a>

                <a href="{{ route('about') }}" class="btn-secondary">
                    عن سرمد
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

            @if ($products->count() > 4)
                <button class="slider-btn prev">
                    &#10095;
                </button>
            @endif

            <div class="products-slider">

                @foreach ($products as $product)

                        <div class="product-card" onclick="window.location='{{ route('product', $product->id) }}'">

                            <div class="product-image">

                                <img src="{{ asset('uploads/images/' . $product->imagepath) }}" alt="watch">

                                <span class="badge">
                                    Bestseller
                                </span>

                            </div>

                            <div class="product-info">

                                <h3>{{ $product->name }}</h3>

                                <p>
                                    {{ $product->description }}
                                </p>

                                <div class="product-footer">

                                    <span class="price">
                                        {{ number_format($product->price) }} EGP
                                    </span>

                                    <form action="{{ route('addtocart',$product->id) }}" method="POST" >
                                        @csrf

                                        <input type="hidden" name="quantity" id="quantityInput" value="1">

                                        <button type="submit" >

                                            إضافة إلى السلة

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                @endforeach

            </div>

            @if ($products->count() > 4)
                <button class="slider-btn next">
                    &#10094;
                </button>
            @endif

        </div>


    </section>



    <section class="collection-section">

        <div class="section-header">

            <span>Luxury Timepieces</span>

            <h2>Featured Watches</h2>

        </div>

        <div class="slider-wrapper">

            @if ($products->count() > 4)
                <button class="slider-btn prev">
                    &#10095;
                </button>
            @endif

            <div class="products-slider">

                @foreach ($watches as $product)

                        <div class="product-card" onclick="window.location='{{ route('product', $product->id) }}'">

                            <div class="product-image">

                                <img src="{{ asset('uploads/images/' . $product->imagepath) }}" alt="watch">

                                {{-- <span class="badge">
                                    Bestseller
                                </span> --}}

                            </div>

                            <div class="product-info">

                                <h3>{{ $product->name }}</h3>

                                <p>
                                    {{ $product->description }}
                                </p>

                                <div class="product-footer">

                                    <span class="price">
                                        {{ number_format($product->price) }} EGP
                                    </span>

                                    <form action="{{ route('addtocart',$product->id) }}" method="POST" >
                                        @csrf

                                        <input type="hidden" name="quantity" id="quantityInput" value="1">

                                        <button type="submit" >

                                            إضافة إلى السلة

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                @endforeach

            </div>

            @if ($products->count() > 4)
                <button class="slider-btn next">
                    &#10094;
                </button>
            @endif

        </div>

    </section>


    <section class="collection-section">

        <div class="section-header">

            <span>Luxury Fragrances</span>

            <h2>Featured Perfumes</h2>

        </div>

        <div class="slider-wrapper">


            @if ($perfumes->count() > 4)
                <button class="slider-btn prev">
                    &#10095;
                </button>
            @endif

            <div class="products-slider">

                @foreach ($perfumes as $product)

                        <div class="product-card" onclick="window.location='{{ route('product', $product->id) }}'">

                            <div class="product-image">

                                <img src="{{ asset('uploads/images/' . $product->imagepath) }}" alt="perfume">

                                {{-- <span class="badge">
                                    Bestseller
                                </span> --}}

                            </div>

                            <div class="product-info">

                                <h3>{{ $product->name }}</h3>

                                <p>
                                    {{ $product->description }}
                                </p>

                                <div class="product-footer">

                                    <span class="price">
                                        {{ number_format($product->price) }} EGP
                                    </span>

                                    <form action="{{ route('addtocart',$product->id) }}" method="POST" >
                                        @csrf

                                        <input type="hidden" name="quantity" id="quantityInput" value="1">

                                        <button type="submit" >

                                            إضافة إلى السلة

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                @endforeach

            </div>

            @if ($perfumes->count() > 4)
                <button class="slider-btn next">
                    &#10094;
                </button>
            @endif

        </div>

    </section>

@endsection
