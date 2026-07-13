@extends('layouts.master')

@section('title', 'إتمام الدفع')

@section('content')

<section class="payment-page">

    <div class="payment-header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Sarmad" class="payment-logo">
        <h2>إتمام عملية الدفع</h2>
        <p class="payment-subtitle">دفع آمن ومشفّر بالكامل عبر Paymob</p>
    </div>

    <div class="payment-frame-wrapper">
        <iframe
            id="paymob-frame"
            src="https://accept.paymob.com/unifiedcheckout/?publicKey={{ $publicKey }}&clientSecret={{ $clientSecret }}"
            allow="payment"
        ></iframe>
    </div>

</section>

@endsection
