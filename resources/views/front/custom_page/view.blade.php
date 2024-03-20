@extends('front.leyout.layout',  [$title = $custom_page->name])


@section('content')
<!-- Page banner start -->
<div class="page-banner" style="background-image: url({{ asset('front/images/banner-bg.jpg') }});">
    <div class="container">
        <h1>{{ $custom_page->name }}</h1>
    </div>
</div>
<!-- Page banner end -->


<div class="container">
    <div class="py-5">
        <h1>{{ $custom_page->name }}</h1>
        <div class="py-3">
            {!! $custom_page->content !!}
        </div>
    </div>
</div>

@endsection