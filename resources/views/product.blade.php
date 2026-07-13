@extends('layouts.master')

@section('title','سرمد')

@section('content')

<section class="product-page">

    <div class="product-container">

        <!-- Info -->

        <div class="product-info-page">

            <span class="category">
                Watches   {{ $productphotos->count() }}
            </span>

            <h1>
                {{ $product->name }}
            </h1>

            <div class="price">

                {{ number_format($product->price) }}
                EGP

            </div>

            <p class="description">

                {{ $product->description }}

            </p>

            <div class="quantity-box">

                <button type="button" id="decreaseQty">-</button>

                <input
                    id="quantity"
                    name="quantity"
                    type="number"
                    value="1"
                    min="1"
                >

                <button type="button" id="increaseQty">+</button>

            </div>

            <div class="action-buttons">

                <form action="{{ route('addtocart', $product->id) }}" method="POST">

                    @csrf

                    <input type="hidden" name="quantity" id="cartQuantity" value="1" >

                    <button type="submit" class="add-cart">

                        إضافة إلي السلة

                    </button>

                </form>

                <form action="{{ route('buynow',$product->id) }}" method="POST">

                    @csrf

                    <input
                        type="hidden"
                        name="quantity"
                        id="buyQuantity"
                        value="1"
                    >

                    <button type="submit" class="buy-now">

                        اشتري الآن

                    </button>

                </form>

            </div>

        </div>


        <!-- Gallery -->

        <div class="product-gallery">

            <div class="slider-frame">

                <button class="gallery-arrow prev">
                    &#10095;
                </button>

                <div class="gallery-wrapper">       {{-- ← needs overflow:hidden --}}
                    <div class="gallery-track">
                        <div class="slide">
                            <img src="{{ asset('uploads/images/' . $product->imagepath) }}">
                        </div>

                        @foreach($productphotos as $photo)
                            <div class="slide">
                                <img src="{{ asset('uploads/images/' . $photo->imagepath) }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="gallery-arrow next">
                    &#10094;
                </button>

            </div>

            <div class="gallery-dots">

                @php $totalSlides = $productphotos->count() + 1; @endphp

                {{-- Main image dot --}}
                <span class="dot active" data-index="0"></span>

                @foreach($productphotos as $index => $image)
                    <span class="dot" data-index="{{ $index + 1 }}"></span>
                @endforeach

            </div>

        </div>



    </div>

</section>




{{-- <section class="related-products">

    <div class="section-header">

        <h2>
            You May Also Like
        </h2>

    </div>

    <div class="products-slider">

        @foreach($relatedProducts as $product)

            @include('partials.product-card')

        @endforeach

    </div>

</section> --}}


@section('scripts')

    <script>

        const qty = document.getElementById('quantity');

        const buyQty = document.getElementById('buyQuantity');
        const cartQty = document.getElementById('cartQuantity');

        function syncQuantity() {
            buyQty.value = qty.value;
            cartQty.value = qty.value;
        }

        document.getElementById('increaseQty').onclick = function () {

            qty.value = parseInt(qty.value) + 1;
            syncQuantity();

        }

        document.getElementById('decreaseQty').onclick = function () {

            if (parseInt(qty.value) > 1) {

                qty.value = parseInt(qty.value) - 1;
                syncQuantity();

            }

        }

        qty.addEventListener('input', function () {

            if (parseInt(qty.value) < 1 || qty.value === '') {
                qty.value = 1;
            }

            syncQuantity();

        });

        syncQuantity();

    </script>

@endsection


@endsection
