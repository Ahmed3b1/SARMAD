@extends('layouts.master')

@section('title','سرمد')

@section('content')

    <section class="cart-page">

        <div class="cart-container">

            <!-- Cart Items -->

            <div class="cart-items">

                <h2 class="section-title">
                    سلة التسوق
                </h2>

                @if($cartItems->count())

                    @foreach($cartItems as $item)

                        <div class="cart-item" id="cart-item-{{ $item->id }}">

                            <div class="cart-image">

                                <img
                                    src="{{ asset('uploads/images/'.$item->product->imagepath) }}"
                                >

                            </div>

                            <div class="cart-details">

                                <span class="item-category">
                                    ساعات
                                </span>

                                <h3>
                                    {{ $item->product->name }}
                                </h3>

                                <div class="item-price">

                                    {{ number_format($item->product->price) }}
                                    EGP

                                </div>

                            </div>

                            <div class="cart-quantity">

                                <button class="decreaseQty" data-id="{{ $item->id }}">-</button>

                                <input type="number" class="quantity-input" data-id="{{ $item->id }}"
                                        value="{{ $item->quantity }}" min="1" >

                                <button class="increaseQty" data-id="{{ $item->id }}">+</button>

                            </div>

                            <div class="item-total" id="item-total-{{ $item->id }}">

                                {{ number_format($item->quantity * $item->product->price) }}
                                EGP
                            </div>

                            <button class="remove-item" data-id="{{ $item->id }}">

                                ×

                            </button>

                        </div>

                    @endforeach

                @else

                    <div class="empty-cart">

                        <h3>سلة التسوق فارغة</h3>

                        <p>لم تقم بإضافة أي منتجات إلى السلة بعد.</p>

                    </div>

                @endif



            </div>

            <!-- Summary -->

            <div class="cart-summary">

                <h3>
                    ملخص الطلب
                </h3>

                <div class="summary-row">

                    <span>عدد المنتجات</span>

                    <span id="cart-count">
                        {{ $count }}
                    </span>

                </div>

                <div class="summary-row">

                    <span>المجموع</span>

                    <span id="cart-subtotal">
                        {{ number_format($subtotal) }}
                        EGP
                    </span>

                </div>

                <div class="summary-row">

                    <span>الشحن</span>

                    <span id="cart-shipping">
                        50 EGP
                    </span>

                </div>

                <div class="summary-row total">

                    <span>الإجمالي</span>

                    <span id="cart-total">
                        {{ number_format($total) }}
                        EGP
                    </span>

                </div>

                <div class="coupon-box">

                    <input
                        type="text"
                        placeholder="كود الخصم"
                    >

                    <button>

                        تطبيق

                    </button>

                </div>

                <a
                    href="{{ route('checkout') }}"
                    class="checkout-btn"
                >

                    متابعة الدفع

                </a>

            </div>

        </div>

    </section>

@endsection


@section('scripts')

    {{-- javascript update cart --}}

    <script>

        $(document).ready(function () {

            // زيادة الكمية
            $('.increaseQty').click(function () {

                let id = $(this).data('id');

                let input = $(this).siblings('.quantity-input');

                let quantity = parseInt(input.val());

                quantity++;

                input.val(quantity);

                updateCart(id, quantity);

            });

            // تقليل الكمية
            $('.decreaseQty').click(function () {

                let id = $(this).data('id');

                let input = $(this).siblings('.quantity-input');

                let quantity = parseInt(input.val());

                if(quantity > 1)
                {
                    quantity--;

                    input.val(quantity);

                    updateCart(id, quantity);
                }

            });

        });

        function updateCart(id, quantity)
        {

            $.ajax({

                url: "/cartupdate/" + id,

                type: "PATCH",

                data: {

                    quantity: quantity,

                    _token: $('meta[name="csrf-token"]').attr('content')

                },

                success: function(response){

                    $('#cart-count').text(response.count);

                    $('#cart-subtotal').text(response.subtotal + ' EGP');

                    $('#cart-shipping').text(response.shipping + ' EGP');

                    $('#cart-total').text(response.total + ' EGP');

                    $('#item-total-' + id).text(response.itemTotal + ' EGP');

                    $('#navbar-cart-count').text(response.count);

                },

                error: function(){

                    alert('حدث خطأ');

                }

            });

        }

    </script>



    {{-- javascript remove item from cart --}}

    <script>

        $(document).on('click', '.remove-item', function () {

            let id = $(this).data('id');

            $.ajax({

                url: "/cartdelete/" + id,

                type: "DELETE",

                data: {

                    _token: $('meta[name="csrf-token"]').attr('content')

                },

                success: function(response){

                    $('#cart-item-' + id).remove();

                    $('#cart-count').text(response.count);

                    $('#cart-subtotal').text(response.subtotal + ' EGP');

                    $('#cart-shipping').text(response.shipping + ' EGP');

                    $('#cart-total').text(response.total + ' EGP');

                    $('#navbar-cart-count').text(response.count);

                    if(response.count == 0){

                        location.reload();

                    }

                }

            });

        });

    </script>

@endsection





