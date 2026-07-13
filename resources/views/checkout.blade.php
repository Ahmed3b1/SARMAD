@extends('layouts.master')

@section('title','إتمام الطلب')

@section('content')

<section class="checkout-page">

    <div class="checkout-container">

        {{-- ORDER FORM --}}

        <div class="checkout-form">

            <h2>
                بيانات الطلب
            </h2>

            <form
                action="{{ route('placeorder') }}" method="POST" >
                @csrf

                <div class="form-group">

                    <label> الاسم بالكامل </label>

                    <input type="text" name="name" required >

                </div>

                <div class="form-group">

                    <label>

                        العنوان

                    </label>

                    <textarea name="address" rows="4" required></textarea>

                </div>

                <div class="form-group">

                    <label>

                        رقم الهاتف

                    </label>

                    <input type="text" name="phone" required >

                </div>

                <div class="form-group">

                    <label>

                        رقم إضافي

                    </label>

                    <input
                        type="text"
                        name="additional_phone"
                    >

                </div>

                <div class="form-group">

                    <label>

                        ملاحظات الطلب

                    </label>

                    <textarea
                        name="note"
                        rows="4"
                    ></textarea>

                </div>

                <div class="payment-box">

                    {{-- <h3>

                        طريقة الدفع

                    </h3> --}}

                    {{-- <label class="payment-method">

                        <input
                            type="radio"
                            checked
                            name="payment_method"
                            value="paymob"
                        >

                        الدفع الإلكتروني
                        (Paymob)

                    </label> --}}

                    <div class="payment-box">
                        <h3>طريقة الدفع</h3>

                        @foreach($paymentMethods as $method)
                            <label class="payment-method">
                                <input type="radio" name="payment_method"
                                    value="{{ $method['key'] }}"
                                    {{ $loop->first ? 'checked' : '' }}>
                                {{ $method['label'] }}
                            </label>
                        @endforeach
                    </div>

                </div>

                <button
                    type="submit"
                    class="pay-btn"
                >

                    متابعة الدفع

                </button>

            </form>

        </div>

        {{-- SUMMARY --}}

        <div class="order-summary">

            <h3>

                ملخص الطلب

            </h3>

            @foreach($cartItems as $item)

                <div class="summary-item">

                    <img
                        src="{{ asset('uploads/images/'.$item->product->imagepath) }}"
                    >

                    <div>

                        <h4>

                            {{ $item->product->name }}

                        </h4>

                        <span>

                            {{ $item->quantity }}
                            ×
                            {{ number_format($item->product->price) }}
                        </span>

                    </div>

                </div>

            @endforeach

            <div class="summary-row">

                <span>

                    المجموع

                </span>

                <span>

                    {{ number_format($subtotal) }}
                    EGP

                </span>

            </div>

            <div class="summary-row">

                <span>

                    الشحن

                </span>

                <span>

                    {{ number_format($shipping) }}
                    EGP

                </span>

            </div>

            <div class="summary-row total">

                <span>

                    الإجمالي

                </span>

                <span>

                    {{ number_format($total) }}
                    EGP

                </span>

            </div>

        </div>

    </div>

</section>

@endsection
