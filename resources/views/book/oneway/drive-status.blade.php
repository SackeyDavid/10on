<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Drive Status | Active Trips</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
        <link rel="manifest" href="/images/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/search-trips.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/material-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/provide-personal-details.css') }}">
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                left: -1%;
                margin-top: -2%;
            }

            .top-center {
                font-size: 18px;
                position: absolute;
                right: 36%;
                font-weight: 600;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #ff3345;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .sidenav{
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }
            /*.sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }*/

            .sidenav a:hover {
                color: #f1f1f1;
            }
            .fa-chevron-down {
                color: #ff3345;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }

            .active {
                background-color: #fff;
                opacity: 0.4;
                padding: 2%;
                color: #fff;
                border-radius: 10%;
            }
        </style>
    </head>
    <body>
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}. Kindly <a href="{{route('user.trips.oneway')}}"><u>log in.</u></a></center></p>
            </div>
            @endif

            
        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;">Drive status</span></li>
                    <!-- <li><span class="top-right links"><a href="#"> <i class="fas fa-cog"></i> </a></span></li> -->
                    <li><span class="top-left links"> <a ><span style="font-size: 15px;" onclick='
                    document.getElementById("mySidenav").style.width = "60%";
                    
                        ' >&#9776;</span> </a></span></li>
                </ul> 
            </div>
        </div> 
        <hr style="margin-bottom: 2%;">
            <div id="mySidenav" class="sidenav" style="background-image: url({{URL::to('images/3.jpg')}});opacity: 0.;">
                <a href="javascript:void(0)" style="font-size: 25px;font-weight: 900;color: #fff;" class="closebtn top-right" onclick="
                document.getElementById('mySidenav').style.width = '0';">&times;</a>
                <div class="col-md-12" style="color: #fff;font-weight: 700;font-size: 20px;">
                    <hr>
                    <a href="{{ route('my.trips.oneway') }}" style="color: #fff;cursor: pointer;">
                    My Trips </a> <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                   
                    <a href="{{ route('oneway.drive.status') }}" style="color: #fff;cursor: pointer;">
                    <u>Drive Status</u></a> <br>
                    <hr>
                    <a href="{{ URL::to('/home') }}" style="color: #fff;cursor: pointer;">
                    My Account</a> <br>
                    <hr>
                    Notifications <br>
                    <hr>
                    <br><br>
                    <div class="col-md-12">
                    <a class="btn btn-sm" style="background-color: #ff3345;color: #fff;" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                     <a href="/" style="text-decoration: none;color: #fff;"> Home <i class="fa fa-home"></i></a>
                    </div>
                </div>
            </div>
            
           <div class="col-md-12 container">
            @if(!$ow_bookings->count() || !$rt_bookings->count())
            no bookings
            @else
                @if(!count($combined_trip_dates))
                <div class="container"> no active trips now</div>
                @else
        
                @foreach($combined_trip_dates as $trip_date)

                    @foreach($ow_bookings as $ow)

                         @php
                         
                         $ow_trip_date = explode(" ", $ow->trip->departure_date)[3] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[1];

                         $ow_trip_date = strtotime($ow_trip_date);
                         $ow_trip_date+= 1209600; 

                         @endphp

                    @if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($trip_date)))
                    @continue
                    @else

                    @php

                    $trip = $ow->trip;

                    $date_booked = \Carbon\Carbon::parse($ow->created_at);
                    $departing_date = \Carbon\Carbon::parse($trip->departure_date);

                    $date = explode(" ", $ow->created_at);

                    $days_left = $departing_date->diffInDays($date_booked) . ' days';

                    if (explode(" ", $days_left)[0] <= 1) {
                        $days_left = $departing_date->diffInHours($date_booked) . ' hours';
                        if (explode(" ", $days_left)[0] <= 1 ) {
                            $days_left = $departing_date->diffInMinutes($date_booked) . ' mins';    
                            if (explode(" ", $days_left)[0] <= 1 ) {
                            $days_left = $departing_date->diffInSeconds($date_booked) . ' seconds';    
                        
                            }
                        }
                    }

                    @endphp
            <div class="card card-default" style="font-weight: 400;margin-bottom: 2%;">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item"><span style="font-family: Arial;">Booking(OW-{{$ow->id}}) on <span style="font-size: 12px;font-family: Arial;">{{$date[0]}} at {{$date[1]}}</span></span></li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;color: inherit;" class="fas fa-chevron-up" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></li>
                    </ul> 
                </div>
                <div class="card-body" style="padding: 0%;">
                    <div class="card-header" style="background-color: #B0E0E6;">
                        Outbound  <span>({{$trip->departure_location}} - {{$trip->arrival_location}})</span>
                    </div>
                    <div class="card-body" style="padding: 0%;">
                        <table class="table table-bordered" style="margin: 0%;">
                        
                            <thead>
                                <tr style="font-size: 11px;">
                                    <th>Booked </th>
                                    <th>Check-in</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="font-weight: 300;background-color: #fff;">
                                    <td>{{$ow->created_at->diffForHumans()}}</td>
                                    <td>{{$days_left}} left</td>
                                </tr>
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
                    @endif
                    @endforeach

                    <!-- end of ow active bookings -->
                    <!-- start of rt active bookings -->
                    @foreach($rt_bookings as $rt)

                     @php
                     
                     $rt_departing_date = explode(" ", $rt->departing->departure_date)[3] . "-" . explode(" ", $rt->departing->departure_date)[2] . "-" . explode(" ", $rt->departing->departure_date)[1];

                     $rt_returning_date = explode(" ", $rt->returning->departure_date)[3] . "-" . explode(" ", $rt->returning->departure_date)[2] . "-" . explode(" ", $rt->returning->departure_date)[1];

                     $rt_departing_date = strtotime($rt_departing_date);
                     $rt_departing_date+= 1209600; 

                     $rt_returning_date = strtotime($rt_returning_date);
                     $rt_returning_date+= 1209600; 

                

                    $outbound = $rt->departing;

                    $inbound = $rt->returning;

                    $date_booked = \Carbon\Carbon::parse($rt->created_at);

                    $date = explode(" ", $rt->created_at);


                    $departing_date = \Carbon\Carbon::parse($outbound->departure_date);

                    $departing_days_left = $departing_date->diffInDays($date_booked) . ' days';

                    if (explode(" ", $departing_days_left)[0] <= 1) {
                        $days_left = $departing_date->diffInHours($date_booked) . ' hours';
                        if (explode(" ", $departing_days_left)[0] <= 1 ) {
                            $departing_days_left = $departing_date->diffInMinutes($date_booked) . ' mins';    
                            if (explode(" ", $days_left)[0] <= 1 ) {
                            $departing_days_left = $departing_date->diffInSeconds($date_booked) . ' seconds';    
                        
                            }
                        }
                    }

                    $returning_date = \Carbon\Carbon::parse($inbound->departure_date);

                    $returning_days_left = $returning_date->diffInDays($date_booked) . ' days';

                    if (explode(" ", $returning_days_left)[0] <= 1) {
                        $returning_days_left = $returning_date->diffInHours($date_booked) . ' hours';
                        if (explode(" ", $returning_days_left)[0] <= 1 ) {
                            $returning_days_left = $returning_date->diffInMinutes($date_booked) . ' mins';    
                            if (explode(" ", $returning_days_left)[0] <= 1 ) {
                            $returning_days_left = $returning_date->diffInSeconds($date_booked) . ' seconds';    
                        
                            }
                        }
                    }

                    @endphp


                @if (date('Ymd', $rt_departing_date) == date('Ymd', strtotime($trip_date)))
            <div class="card card-default" style="font-weight: 400;margin-bottom: 2%;">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item"><span style="font-family: Arial;">Booking(RT-{{$rt->id}}) on <span style="font-size: 12px;font-family: Arial;">{{$date[0]}} at {{$date[1]}}</span></span></li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;color: inherit;" class="fas fa-chevron-up" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></li>
                    </ul> 
                </div>
                <div class="card-body" style="padding: 0%;">
                    <div class="card-header" style="background-color: #B0E0E6;">
                        Outbound  <span>({{$outbound->departure_location}} - {{$outbound->arrival_location}})</span>
                    </div>
                    <div class="card-body" style="padding: 0%;">
                        <table class="table table-bordered" style="margin: 0%;">
                        
                            <thead>
                                <tr style="font-size: 11px;">
                                    <th>Booked </th>
                                    <th>Check-in</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="font-weight: 300;background-color: #fff;">
                                    <td>{{$rt->created_at->diffForHumans()}}</td>
                                    <td>{{$departing_days_left}} left</td>
                                </tr>
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
                    @endif
                    @if (date('Ymd', $rt_returning_date) == date('Ymd', strtotime($trip_date)))
                <div class="card card-default" style="font-weight: 400;margin-bottom: 2%;">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item"><span style="font-family: Arial;">Booking(RT-{{$rt->id}}) on <span style="font-size: 12px;font-family: Arial;">{{$date[0]}} at {{$date[1]}}</span></span></li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;color: inherit;" class="fas fa-chevron-up" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></li>
                    </ul> 
                </div>
                    
                <div class="card-body" style="padding: 0%;">
                    <div class="card-header" style="background-color: #66CDAA;">
                        Inbound  <span>({{$inbound->departure_location}} - {{$inbound->arrival_location}})</span>
                    </div>
                    <div class="card-body" style="padding: 0%;">
                        <table class="table table-bordered" style="margin: 0%;">
                        
                            <thead>
                                <tr style="font-size: 11px;">
                                    <th>Booked </th>
                                    <th>Check-in</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="font-weight: 300;background-color: #fff;">
                                    <td>{{$rt->created_at->diffForHumans()}}</td>
                                    <td>{{$returning_days_left}} left</td>
                                </tr>
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
                    @endif
            
                    @endforeach

                    <!-- end of rt active bookings -->
                @endforeach
            
                @endif
            @endif
        
        
        
        <br>
        <div class="modal" id="login-modal" style="z-index: 1999;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title">Session Expired</h4>

                </div>

                <div class="modal-body">

                    <span style="font-weight: 300;">Your session has expired.</span>

                </div>

                <div class="modal-footer">

                    <button id="btnExpiredOk" onclick="sessionExpiredRedirect()" type="button" class="btn btn-primary" data-dismiss="modal" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Ok</button>
                    <a href="" onclick="sessionExpiredRedirect()" type="button" class="btn btn-success" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Login</a>

                </div>

            </div>

        </div>

    </div>
        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript">
            $('#ow_contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#ow_title').val() + ' ' + $('input[name="ow_first_name"]').val() + ' ' + $('input[name="ow_last_name"]').val(); 
                this.options.add(c, 2);
            });
            $('.alert-info').fadeTo(15000, 500).slideUp(500, function() {
                $('.alert-info').slideUp(500);
            });
            
        </script>
        
        
           

    </body>
</html>
