@extends('layouts.master')

@section('title','ساعات - سرمد')

@section('content')

    @forelse ($subcategories as $subcategory)

        <section class="collection-section">

            <div class="section-header">

                <span>{{ $subcategory->quote }}</span>

                <h2>{{ $subcategory->name }}</h2>

            </div>

            <div class="slider-wrapper">

                @if ($subcategory->products->count() > 4)
                    <button class="slider-btn prev">
                        &#10095;
                    </button>
                @endif

                <div class="products-slider">

                    @foreach ($subcategory->products as $product)

                        <div class="product-card" onclick="window.location='{{ route('product', $product->id) }}'">

                            <div class="product-image">

                                <img src="{{ asset('uploads/images/' . $product->imagepath) }}" alt="{{ $product->name }}">

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

                                    <form action="{{ route('addtocart', $product->id) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="quantity" value="1">

                                        <button type="submit">
                                            إضافة إلى السلة
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                @if ($subcategory->products->count() > 4)
                    <button class="slider-btn next">
                        &#10094;
                    </button>
                @endif

            </div>

        </section>

    @empty

        <div class="empty-cart">
            <h3>لا توجد منتجات متاحة حاليًا</h3>
            <p>تابعنا للحصول على آخر تشكيلاتنا من الساعات الفاخرة.</p>
        </div>

    @endforelse

@endsection
