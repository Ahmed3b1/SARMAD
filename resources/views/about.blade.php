@extends('layouts.master')

@section('title','عن سرمد')

@section('content')

<section class="about-hero">

    <div class="overlay"></div>

    <div class="about-hero-content">

        <span class="luxury-badge">

            About Sarmad

        </span>

        <h1>

            حيث تلتقي الأناقة بالفخامة

        </h1>

        <p>

            نؤمن أن التفاصيل الصغيرة هي ما يصنع الانطباع الكبير، لذلك نختار لكم منتجات تجمع بين الجودة، الذوق الرفيع، والتميز.

        </p>

    </div>

</section>

<section class="about-story">

    <div class="story-image">

        <img src="{{ asset('assets/images/watches.jpg') }}">

    </div>

    <div class="story-content">

        <span>

            قصتنا

        </span>

        <h2>

            بداية شغف... أصبح علامة

        </h2>

        <p>

            تأسست سرمد لتقديم تجربة تسوق مختلفة، تجمع بين الساعات والعطور المختارة بعناية، لنقدم منتجات تضيف لمسة من الرقي إلى حياتك اليومية.

        </p>

        <p>

            نحرص على اختيار كل منتج وفق أعلى معايير الجودة والأناقة حتى يصل إليك ما يعكس شخصيتك بأفضل صورة.

        </p>

    </div>

</section>

<section class="vision-section">

    <div class="vision-box">

        <h2>

            رؤيتنا

        </h2>

        <p>

            أن تصبح سرمد الوجهة الأولى لكل من يبحث عن الجودة، والرقي، والتفاصيل التي تصنع الفرق.

        </p>

    </div>

</section>

<section class="about-features">

    <div class="feature-card">

        <div class="icon">

            ✨

        </div>

        <h3>

            جودة مختارة

        </h3>

        <p>

            منتجات يتم اختيارها بعناية لتضمن أعلى مستويات الجودة.

        </p>

    </div>

    <div class="feature-card">

        <div class="icon">

            👑

        </div>

        <h3>

            أناقة

        </h3>

        <p>

            تصميمات تضيف لمسة راقية تناسب مختلف الأذواق.

        </p>

    </div>

    <div class="feature-card">

        <div class="icon">

            🤝

        </div>

        <h3>

            ثقة

        </h3>

        <p>

            تجربة شراء آمنة وخدمة تهدف إلى رضا العميل أولاً.

        </p>

    </div>

</section>

<section class="about-cta">

    <h2>

        اكتشف مجموعتنا المميزة

    </h2>

    <a href="{{ route('home') }}">

        تسوق الآن

    </a>

</section>



@endsection





