@extends('layouts.master')

@section('title','تم الدفع')

@section('content')

<section class="payment-result">

    <div class="result-card">

        <div class="result-icon success-icon">

            ✓

        </div>

        <h1>

            تم الدفع بنجاح

        </h1>

        <p>

            شكراً لثقتكم بمتجر سرمد.

            تم استلام طلبكم بنجاح وسيتم البدء في تجهيزه في أقرب وقت.

        </p>

        <a href="{{ route('home') }}" class="result-btn">

            العودة للرئيسية

        </a>

    </div>

</section>

@endsection
