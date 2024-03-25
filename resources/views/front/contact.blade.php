@extends('front.leyout.layout')

@section('content')
<!-- Banner start -->
    <section class="page-banner">
        <div class="banner-title">
            <div class="container">
                <h1>আমাদের সাথে যোগাযোগ</h1>
            </div>
        </div>

        <div class="banner-image">
            <div class="image-item" style="background-image: url({{ asset(banner() ? banner()->inner_page_image : '') }});"></div>
        </div>
    </section>
    <!-- Banner end -->


    <div class="contact section-padding">
        <div class="container">
            @if (Session::has('success'))
            <p class="text-success text-center pb-3">{{ Session::get('success') }}</p>
            @endif
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <div class="address">
                        <div class="address-text">
                            {!! $contact_section ? $contact_section->content : '' !!}
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form">
                        <form action="{{ route('contact.form') }}" method="POST">
                            @csrf
                            <input name="name" type="text" placeholder="আপনার নাম">
                            @if ($errors->has('name'))
                            <small class="error text-danger">{{ $errors->first('name') }}</small>
                            @endif
                            <input name="phone" type="text" placeholder="আপনার ফোন নাম্বার">
                            @if ($errors->has('phone'))
                            <small class="error text-danger">{{ $errors->first('phone') }}</small>
                            @endif
                            <input name="subject" type="text" placeholder="আপনার বিষয়">
                            @if ($errors->has('subject'))
                            <small class="error text-danger">{{ $errors->first('subject') }}</small>
                            @endif
                            <textarea name="details" placeholder="বিস্তারিত লিখুন ..."></textarea>
                            @if ($errors->has('details'))
                            <small class="error text-danger">{{ $errors->first('details') }}</small>
                            @endif
                            <button>সেন্ড করুন</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection