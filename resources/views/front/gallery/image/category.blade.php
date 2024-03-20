@extends('front.leyout.layout')

@push('page_css')
    <link rel="stylesheet" href="{{asset('front/css/pages/gallery.css')}}">
@endpush

@section('content')
<!-- Page banner start -->
<div class="page-banner" style="background-image: url({{ asset('front/images/banner-bg.jpg') }});">
    <div class="container">
        <h1>{{ $title }}</h1>
    </div>
</div>
<!-- Page banner end -->

@push('page_plugin_css')
    <link rel="stylesheet" href="{{ asset('front/css/venobox.min.css') }}" />
@endpush

@push('page_plugin_js')
<script src="{{ asset('front/js/venobox.min.js') }}"></script>
@endpush

<!-- Gallery start -->
<div class="gallery-page">
    <div class="container">
        <div class="category">
            <ul>
                <li>
                    <a href="{{ route('image.gallery') }}">All</a>
                </li>
                @foreach ($categories as $category)
                <li class="{{ $active_slug == $category->slug ? 'active' : '' }}">
                    <a href="{{ route('image.gallery.category', $category->slug) }}">{{$category->title}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="items">
            <div class="row">
                @foreach ($galleries as $gallery)
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a class="my-image-links" data-gall="gallery01" href="{{ asset($gallery->image) }}">
                            <img class="img-fluid w-100" src="{{ asset($gallery->image) }}" alt="{{ theme() ? theme()->theme_name : '' }}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="paginate-area">
                {{ $galleries->onEachSide(3)->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Gallery end -->
@endsection