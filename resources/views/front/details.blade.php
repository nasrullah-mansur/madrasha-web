@extends('front.leyout.layout')

@section('content')
<!-- Banner start -->
    <section class="page-banner">
        <div class="banner-title">
            <div class="container">
                <h1>{{ $division->title }}</h1>
            </div>
        </div>

        <div class="banner-image">
            <div class="image-item" style="background-image: url({{ asset(banner() ? banner()->inner_page_image : '') }});"></div>
        </div>
    </section>
    <!-- Banner end -->


    <!-- Details start -->
    <div class="container section-padding course-details">
        <div class="row">
            <div class="col-lg-8">
                <div class="details">{!! $division->content !!}</div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <h4>আমাদের অন্যন্য বিভাগ</h4>
                    <ul>
                        @foreach ($divisions as $div)
                        <li><a href="{{ route('division.view', $div->slug) }}">{{ $div->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Details end -->
@endsection