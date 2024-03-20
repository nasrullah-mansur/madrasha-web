@extends('front.leyout.layout', [$title = 'Chamber'])

@push('page_css')
    <link rel="stylesheet" href="{{asset('front/css/pages/chamber.css')}}">
@endpush

@push('page_plugin_css')
    <link rel="stylesheet" href="{{ asset('back/plugins/niceselect/nice-select.css') }}">
@endpush

@section('content')
<!-- Page banner start -->
<div class="page-banner" style="background-image: url({{ asset('front/images/banner-bg.jpg') }});">
    <div class="container">
        <h1>{{ $title }}</h1>
    </div>
</div>
<!-- Page banner end -->

<!-- Chamber section start -->
<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-1 order-lg-2">
                <div class="blog-content">
                    <div class="row">
                        @forelse ($chambers as $chamber)
                        <div class="col-lg-4">
                            <div class="blog-item">
                                <div class="img">
                                    <img class="img-fluid w-100" src="{{ asset($chamber->image)}}" alt="{{$chamber->chamber_name}}" />
                                </div>
                                <div class="blog-text">
                                    <div class="blog-item-title">
                                        <h3>{{$chamber->chamber_name}}</h3>
                                    </div>

                                    <div class="blog-content">
                                        <p class="m-0">
                                            <strong>Address </strong> {{ $chamber->address }}
                                        </p>

                                        <p class="m-0">
                                            <strong>Day & Time </strong> 
                                            {{ $chamber->chamber_time }}

                                        </p>
                                                                               
                                        <p class="m-0">
                                            <strong>Map </strong> <a href="{{$chamber->google_location}}">Google Map</a>
                                        </p>
                                        <p class="m-0">
                                            <strong>Contact </strong> {{ $chamber->serial_number }}
                                        </p>
                                    </div>
                                    <div class="read-more pt-3">
                                        <a href="{{ $chamber->btn_link ? $chamber->btn_link : '#' }}">Get Appointment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="no-blog"><i class="far fa-frown-open"></i> No chamber found <i class="far fa-frown-open"></i></p>
                        @endforelse
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</section>
<!-- Chamber section end -->

@endsection

@push('page_plugin_js')
<script src="{{ asset('back/plugins/niceselect/jquery.nice-select.min.js') }}"></script>
@endpush

@push('custom_page_js')
    <script>
        $('.select2').niceSelect();
    </script>
@endpush