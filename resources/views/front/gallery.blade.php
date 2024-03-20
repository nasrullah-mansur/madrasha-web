@extends('front.leyout.layout')

@section('content')
<!-- Banner start -->
    <section class="page-banner">
        <div class="banner-title">
            <div class="container">
                <h1>ফটো গ্যালারি</h1>
            </div>
        </div>

        <div class="banner-image">
            <div class="image-item" style="background-image: url({{ asset(banner() ? banner()->inner_page_image : '') }});"></div>
        </div>
    </section>
    <!-- Banner end -->

    <!-- Gallery start -->
    <div class="container gallery-page section-padding">
        <ul>
            <li data-filter="all" class="active">সমস্ত ছবি</li>
            @foreach ($categories as $category)
            <li data-filter=".item-{{ $category->id }}">{{ $category->title }}</li>
            @endforeach
        </ul>

        <div class="gallery-content row">
            @foreach ($galleries as $gallery)
                <div class="col-lg-3 mix item-{{ $gallery->category->id }}">
                <div class="gallery-item">
                    <img src="{{ $gallery->image }}" alt="{{ $gallery->image }}">
                    <div class="overlay">
                        <a data-gall="gallery01" href="{{ $gallery->image }}" class="gall-img">দেখুন</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    <!-- Gallery end -->


@endsection

@push('custom_css')
    <link rel="stylesheet" href="{{ asset('front/css/venobox.min.css') }}">
@endpush

@push('custom_js')
    <script src="{{ asset('front/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('front/js/venobox.min.js') }}"></script>

    <script>
        var mixer = mixitup('.gallery-content');

        new VenoBox({
            selector: '.gall-img',
        });
    </script>
@endpush