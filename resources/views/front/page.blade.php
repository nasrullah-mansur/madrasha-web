@extends('front.leyout.layout')

@section('content')
<!-- Banner start -->
    <section class="page-banner">
        <div class="banner-title">
            <div class="container">
                <h1>{{ $page->title }}</h1>
            </div>
        </div>

        <div class="banner-image">
            <div class="image-item" style="background-image: url({{ asset(banner() ? banner()->inner_page_image : '') }});"></div>
        </div>
    </section>
    <!-- Banner end -->

    <div class="container section-padding">
        {!! $page->content !!}
    </div>

@endsection