<!DOCTYPE html>
<html lang="ar" dir="rtl" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','سرمد')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/test4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sections.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pay.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pagesofpaymob.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/paymentstatus.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
</head>

<body>

    @include('layouts.navbar')

    {{-- <main> --}}
        @yield('content')
    {{-- </main> --}}

    @include('layouts.footer')

    <script src="{{ asset('assets/js/test4.js') }}"></script>
    <script src="{{ asset('assets/js/product.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script> --}}

    @yield('scripts')

</body>

</html>
