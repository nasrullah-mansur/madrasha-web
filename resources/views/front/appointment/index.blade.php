@extends('front.leyout.layout')

@push('page_css')
    <link rel="stylesheet" href="{{asset('front/css/pages/appointment.css')}}">
@endpush

@push('page_plugin_css')
<link rel="stylesheet" type="text/css" href="{{ asset('back/vendors/css/forms/selects/select2.min.css') }}">
@endpush

@push('page_plugin_js')
<script src="{{ asset('back/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
@endpush


@section('content')
<!-- Page banner start -->
<div class="page-banner" style="background-image: url({{ asset('front/images/banner-bg.jpg') }});">
    <div class="container">
        <h1>{{ $title }}</h1>
    </div>
</div>
<!-- Page banner end -->

@if (Session::has('success'))
<div class="appointment-success-box">
    <div class="page-overlay"></div>
    <div class="success-message">
        <button class="close-btn">
            <i class="fas fa-times"></i>
        </button>

        @php
            $user = Session::get('success');
        @endphp

        <h4>Hello {{ $user['name'] }}.</h4>
        <p>Thank you for scheduling your appointment with us.</p>

        <p>An email has been sent to your inbox containing your appointment information. Please check your email for further details. Alternatively, You can check <a target="_blank" href="https://mail.google.com/mail">here</a></p>

        <h5>Appointment Details</h5>
        <ul>
            
            <li>
                <strong>Time</strong>
                <span>{{ $user['day'] }}</span>
            </li>
           
            <li>
                <strong>Fee</strong>
                <span>{{ $user['fee'] }}</span>
            </li>
            <li>
                <strong>Chamber</strong>
                <span>{{ $user['chamber'] }}</span>
            </li>
            <li>
                <strong>Name</strong>
                <span>{{ $user['name'] }}</span>
            </li>
            <li>
                <strong>Phone</strong>
                <span>{{ $user['phone'] }}</span>
            </li>
            <li>
                <strong>Email</strong>
                <span>{{ $user['email'] }}</span>
            </li>
        </ul>
        <br>
        <p>We kindly request your punctual arrival at the chamber. We will also reach out to you at your provided contact number.</p>

        <div class="btn-area">
            <a class="download-btn" href="{{ route('pdf.create', $user->id) }}">Download PDF</a>
        </div>
    </div>
</div>
@endif



<div class="appointment-page">
    <div class="container">
        <h2>Start Your Appointment Request Here.</h2>
        
        <div >
            <form action="{{ route('appointment.store')}}" method="POST">
                @csrf
                <div class="row form">
                    <div class="col-lg-6">
                        <div class="input-content">

                            <div class="input-item w-h">
                                <label for="chamber">Select Preferred Chamber <span>*</span></label>
                                <select name="chamber" id="chamber">
                                    <option disabled selected>Select Preferred Chamber</option>
                                    @foreach ($chambers as $chamber)
                                    <option value="{{ $chamber->id }}">{{ $chamber->chamber_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('chamber'))
                                <small class="text-danger">{{ $errors->first('chamber') }}</small>
                                @endif
                            </div>
                            

                            <div class="input-item w-h">
                                <label for="select_day">Select Preferred Day & Time <span>*</span></label>
                                <select name="select_day" id="select_day">Select Preferred Day & Time</select>
                                @if ($errors->has('select_day'))
                                <small class="text-danger">{{ $errors->first('select_day') }}</small>
                                @endif
                            </div>



                            <div class="input-item w-h">
                                <label for="name">Enter Patient Name <span>*</span></label>
                                <input name="name" id="user_name" type="text" class="w-100 my-input" placeholder="Enter Patient Name">
                                @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                            <div class="input-item w-h">
                                <label for="phone">Enter Contact Number <span>*</span></label>
                                <input name="phone" id="user_phone" type="text" class="w-100 my-input" placeholder="Enter Contact Number">
                                @if ($errors->has('phone'))
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                                @endif
                            </div>

                            <div class="input-item w-h">
                                <label for="email">Enter Email Address <span>*</span></label>
                                <input name="email" id="user_email" type="email" class="w-100 my-input" placeholder="Enter Email Address">
                                @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                    

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="info bg-white p-3 h-100">
                            <div class="info">
                                <h4>Appointment Summary:</h4>
                                <p id="appointment_summary_2"></p>
                                <p id="appointment_summary_1"></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form bg-white mt-5">
                    <div class="submit-area text-center">
                    <button type="submit">Confirm Appointment</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('custom_page_js')
    <script>


        // Popup Message;
        $('.appointment-success-box .close-btn').on('click', function() {
            $('.appointment-success-box').addClass('d-none');
        })

        // Initialize Select2 Plugin
        if ($("select").length > 0) {
            $("select").select2({
                placeholder: "Select Preferred Day & Time",
            });
        }

        let days = [];
        let chamberMess;
        let getNextDaysLimit = 30;


        let myName = "";
        let myPhone = "";
        let myEmail = "";
        let isActive = false;
        let drFee = 0;

        

        $('#user_name, #user_phone, #user_email').on('keyup', function(e) {
            if (e.target.id === 'user_name') myName = e.target.value;
            if (e.target.id === 'user_phone') myPhone = e.target.value;
            if (e.target.id === 'user_email') myEmail = e.target.value;
            summery_text();
        });

        function summery_text() {
            let output = `
                Patient Name: <strong>${myName}</strong>. <br>
                Contact Number: <strong>${myPhone}</strong> <br>
                Email Address: <strong>${myEmail}</strong> <br>
                Consultation Fee: <strong>${drFee}</strong> 
                
            `;
            $('#appointment_summary_1').html(output);

        }

     

        $('#chamber').on('change', function() {
            const id = $(this).val();
            const deleteRoute = "{{ route('get.day.time') }}";
            $('#time').html('');

            $.get(deleteRoute, { id }, response => {
                
                drFee = response.fee;
                days = [];

                response.daytime.forEach(element => {
                    let resDayTime = element.day + ' ' + element.time;
                    days.push(resDayTime)
                });

                let nextDaysData = getNextDays(getNextDaysLimit, days);
                

                selectDays(sortMyDateArray(nextDaysData))

                chamberMess = `Selected Chamber: <strong>${response.chamber_name}</strong>.`;
                $('#appointment_summary_2').html(`${chamberMess}`);
            });
        });

        $('#select_day').on('change', function() {
            const dateDay = $(this).val();
            const dayMess = `Selected Day & Time: <strong>${dateDay}</strong>.`;
            $('#appointment_summary_2').html(`${chamberMess} <br> ${dayMess}`);
        });

      
        // Initialize Days Dropdown

        function selectDays(days) {
            const showintDays = ['<option selected disabled>Select one</option>'];
            const selectDays = $('#select_day');
    
            // days.forEach(day => showintDays.push(`<option value="${day}">${day}</option>`));
            days.forEach(day => {
                showintDays.push(`<option value="${day}">${day}</option>`)
                // selectDays.append(`<option value="${day}">${day}</option>`);
            });
            
            selectDays.html(showintDays.join(''));
        }

        // Initialize Message
        const message = ` Select your preferred chamber, day-time, and provide your name, contact number, and email to schedule your appointment.`;
        $('#appointment_summary_2').html(message);


         function getNextDays(count, searchArr) {
            let result = [];

            // Function to format date as "DD Month YYYY"
            function formatDate(date) {
                const options = { day: 'numeric', month: 'long', year: 'numeric', weekday: 'long' };
                return date.toLocaleDateString('en-BD', options);
            }
    
            // Function to get the next 10 days from today (including today)
            function getDays() {
                const dates = [];
                let currentDate = new Date();
                for (let i = 0; i < count; i++) {
                    dates.push(formatDate(currentDate));
                    currentDate.setDate(currentDate.getDate() + 1); // Incrementing date by 1
                }
                
                return dates;
            }

            searchArr.forEach(pn => {
                getDays().forEach((n) => {
                    if(n.includes(pn.split(' ')[0])) {
                      result.push(n + ", " + pn.substring(pn.indexOf(' ') + 1));
                    }
                })
            })
            

            return result;
            
        }
        
        
        
        
        
        function sortMyDateArray(arr) {
            
            console.log(arr)
            
            arr.sort((a, b) => {
                const dateA = new Date(a.split(',')[1].trim());
                const dateB = new Date(b.split(',')[1].trim());
                return dateA - dateB;
            });
            
            
            return arr;

        }


    </script>
@endpush