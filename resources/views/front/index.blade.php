@extends('front.leyout.layout')

@section('content')
<!-- Banner start -->
    @if (banner())
    <section class="banner">
        <div class="banner-title">
            <div class="container">
                <h1>{{ banner()->title }}</h1>
                <div class="text-white">{!! banner()->content !!}</div>
            </div>
        </div>
        <div class="banner-slider">
            @foreach ($sliders as $slider)
            <div class="slider-item" style="background-image: url({{ $slider->image }});"></div>
            @endforeach
        </div>
    </section>
    @endif
    <!-- Banner end -->

    <!-- Classes start -->
    <section class="classes section-padding">
        <div class="container">
            <div class="section-title">
                <h2>আমাদের বিভাগসমূহ</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($divisions as $division)
                <div class="col-lg-4">
                    <div class="class-item">
                        <div class="image">
                            <img src="{{ asset($division->image) }}" alt="{{$division->alt}}">
                        </div>
                        <div class="text">
                            <h3>{{ $division->title }}</h3>
                            <a href="{{ route('division.view', $division->slug) }}">আরো পড়ুন</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!-- Classes end -->

    <!-- Notice start -->
    @if ($notice)
    @if ($notice->status === STATUS_ACTIVE)
    <section class="notice section-padding-y section-margin">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h2>জরুরী নোটিশ:</h2>
                </div>
                <div class="col-lg-9">
                    {!! $notice->content !!}
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif
    <!-- Notice end -->

    <!-- Glance start -->
    @if ($glance)
    <section class="glance section-padding">
        <div class="container">
            <div class="section-title">
                <h2>এক নজরে আমাদের মাদরাসা </h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="glance-text border p-3">{!! $glance->content !!}</div>
                </div>
                <div class="col-lg-6">
                    <div class="glance-list border p-3">
                        <ul>
                            @foreach (json_decode($glance->list) as $glans)
                            <li>
                                <span>{{ $glans->list_name }}</span>
                                <span>{{ $glans->count }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Glance end -->
@endsection