@extends('layouts.master')

@section('title','فشل الدفع')

@section('content')

<section class="payment-result">

    <div class="result-card">

        <div class="result-icon failed-icon">

            ✕

        </div>

        <h1>

            فشل إتمام عملية الدفع

        </h1>

        <p>

            لم يتم إتمام عملية الدفع.

            يمكنك المحاولة مرة أخرى أو اختيار وسيلة دفع أخرى.

        </p>

        <a href="{{ route('home') }}" class="result-btn">

            العودة للرئيسية

        </a>

    </div>

</section>

@endsection
