<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>My Bus @guest @else | {{Auth::user()->first_name}} {{Auth::user()->last_name}} @endguest</title>

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
                right: 47%;
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

            /* enable absolute positioning */
            .inner-addon { 
                position: relative; 
            }

            /* style icon */
            .inner-addon .fa-search {
              position: absolute;
              padding: 10px;
              pointer-events: none;
              color: #ddd;
            }

            /* align icon */
            .left-addon .fa-search  { left:  0px;}
            .right-addon .fa-search { right: 0px;}

            /* add padding  */
            .left-addon input  { padding-left:  30px; }
            .right-addon input { padding-right: 30px; }

            
        </style>
    </head>
    <body style="max-width: 100%;">
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}. Kindly <a href="{{route('login')}}">log in</a></center></p>
            </div>
            @endif
        <div class="col-md-12" style="background-color: #fff;">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;"> Bus</span></li>
                    <!-- <li><span class="top-right links"><a href="#"> <i class="fas fa-cog"></i> </a></span></li> -->
                    <li><span class="top-left links"> <a ><span style="font-size: 15px;" onclick='
                    document.getElementById("mySidenav").style.width = "60%";
                    
                        ' >&#9776;</span> </a></span></li>
                </ul> 
            </div>
        </div> 
        <hr style="margin-bottom: 0%;">
            <div id="mySidenav" class="sidenav" style="background-image: url({{URL::to('images/3.jpg')}});opacity: 0.;">
                <a href="javascript:void(0)" style="font-size: 25px;font-weight: 900;color: #fff;" class="closebtn top-right" onclick="
                document.getElementById('mySidenav').style.width = '0';">&times;</a>
                <div class="col-md-12" style="color: #fff;font-weight: 700;font-size: 20px;">
                    <hr> <a href="{{ route('my.trips.oneway') }}" style="color: #fff;cursor: pointer;">
                    My Trips </a> <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                    <a href="{{ route('oneway.drive.status') }}" style="color: #fff;cursor: pointer;">
                    Drive Status</a> <br>
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
           
           <div class="col-md-12" style="background-color: #00000008;min-height: 91%;">
            <br>
             @if(!$uniqueOWs->count() || !$uniqueRTs->count())
                no trip history found
                @else
                    @if (!$combined_trip_dates)
                    no ow trip dates
                    @else

                    @foreach ($combined_trip_dates as $trip_date)

                    @foreach ($uniqueOWs as $ow)

                         @php
                         
                         $ow_trip_date = explode(" ", $ow->trip->departure_date)[3] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[1];

                         $ow_trip_date = strtotime($ow_trip_date);
                         $ow_trip_date+= 1209600; 

                         @endphp

                    @if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($trip_date)))
                    @continue
                    @else
            <div class="card card-default" style="border-radius: 0;margin: -3%;margin-bottom: 5%;font-weight: 500;">
                <div class="card-header" style="background-color: #fff;">
                    {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}} --
                     @php
                        
                        $now = date('Ymd'); 
                        $this_ow_date = date('Ymd', strtotime($trip_date));
                        $diffDays = $now - $this_ow_date;
                        
                        
                        switch ($diffDays) {
                            case -1:

                                echo "Tomorrow" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;

                            case 0:
                                echo "Today" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                            
                            default:
                                echo date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                        }
                    
                        
                    @endphp
                    <span class="text-success">One Way Trip Outbound <i class="material-icons text-success" style="font-size: 15px;">flight_takeoff</i></span>
                      <span class="float-right"><i class="fa fa-chevron-down" style="color: inherit;" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>
                </div>
                <div class="card-body" style="display: none;">
                    
                    <div class="col-xs-12" style="padding: 0%;">    
                    <div class="col-xs-4" style="padding: 0%;"><center> <i class="fa fa-user-circle"></i> </center> <center>{{$ow->trip->bus->driver}}</center><center><span style="font-size: 11px;color: #777;">driver</span></center></div>
                    <div class="col-xs-4" style="padding: 0%;"><center><i class="fa fa-bus"></i> </center><center> {{$ow->trip->bus->bus_number}}</center><center><span style="font-size: 11px;color: #777;">bus number</span></center></div> 
                    <div class="col-xs-4" style="padding: 0%;"><center> <span style="font-size: 15px;">{{$ow->trip->bus->capacity}}</span></center><center> passengers</center><center><span style="font-size: 11px;color: #777;">capacity</span></center></div>
                    </div>
                            
                        
                    <br><br>
                    <div class="col-xs-12" style="padding: 0%;margin-top: 2%;margin-bottom: 2%;">
                    <div class="col-xs-6" style="border-color: green;padding: 1%;font-weight: 600;">
                    <center>{{$ow->trip->departure->name}}( {{$ow->trip->departure->abbreviation}})  </center>
                    <center>to</center>
                    <center>{{$ow->trip->arrival->name}}( {{$ow->trip->arrival->abbreviation}})</center>
                    <center>via {{$ow->trip->via}}</center>
                    

                    </div>
                    <div class="col-xs-6">
                        <a href="{{ URL::to('/images/'.$ow->trip->bus->photo) }}"><img src="{{ URL::to('/images/'.$ow->trip->bus->photo) }}" alt="Yutong bus" class="img-thumbnail"></a>
                    </div>
                    </div>
                    
                    <br><br>
                    Features <i class="fa fa-star"></i>
                    <br>
                    <ul class="list-inline">
                        <li>&#183; <i class="material-icons">local_gas_station</i> {{$ow->trip->bus->specialFeatures['fuel']}}</li>
                        <li>&#183; <i class="fa fa-tv"></i>
                        @if ($ow->trip->bus->specialFeatures['television'] == "yes") 
                        Television
                        @else
                        <s>Television</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fa fa-wifi"></i>  
                        @if ($ow->trip->bus->specialFeatures['wifi'] == "yes") 
                        Wifi
                        @else
                        <s>Wifi</s>
                        @endif
                        </li>
                        <li>
                            @if ($ow->trip->bus->specialFeatures['ac'] == "yes") 
                        &#183; Air Condition
                        @else
                        &#183; <s>Air Condition</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-wheelchair"></i>
                         @if ($ow->trip->bus->specialFeatures['wheel_lift'] == "yes") 
                        Wheel lift
                        @else
                        <s>Wheel Lift</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-bus"></i> {{$ow->trip->bus->specialFeatures['articulation']}}</li>
                        <li>&#183; {{$ow->trip->bus->specialFeatures['decker']}}</li>
                    </ul>
                    
                </div>
            </div>
            
             @endif
                    @endforeach

                    <!-- end of ow bookings           -->
                    <!-- start of rt bookings -->
                    @foreach ($uniqueRTs as $rt)

                         @php
                         
                         $rt_departing_date = explode(" ", $rt->departing->departure_date)[3] . "-" . explode(" ", $rt->departing->departure_date)[2] . "-" . explode(" ", $rt->departing->departure_date)[1];

                         $rt_returning_date = explode(" ", $rt->returning->departure_date)[3] . "-" . explode(" ", $rt->returning->departure_date)[2] . "-" . explode(" ", $rt->returning->departure_date)[1];

                         $rt_departing_date = strtotime($rt_departing_date);
                         $rt_departing_date+= 1209600; 

                         $rt_returning_date = strtotime($rt_returning_date);
                         $rt_returning_date+= 1209600; 

                         @endphp

                    @if (date('Ymd', $rt_departing_date) == date('Ymd', strtotime($trip_date)))
                    <div class="card card-default" style="border-radius: 0;margin: -3%;margin-bottom: 5%;font-weight: 500;">
                <div class="card-header" style="background-color: #fff;">
                    {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}} --
                     @php
                        
                        $now = date('Ymd'); 
                        $this_ow_date = date('Ymd', strtotime($trip_date));
                        $diffDays = $now - $this_ow_date;
                        
                        
                        switch ($diffDays) {
                            case -1:

                                echo "Tomorrow" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;

                            case 0:
                                echo "Today" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                            
                            default:
                                echo date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                        }
                    
                        
                    @endphp
                    <span class="text-primary">Return Trip Outbound <i class="material-icons text-primary" style="font-size: 15px;">flight_takeoff</i></span>
                      <span class="float-right"><i class="fa fa-chevron-down" style="color: inherit;" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>
                </div>
                <div class="card-body" style="display: none;">
                    
                    <div class="col-xs-12" style="padding: 0%;">    
                    <div class="col-xs-4" style="padding: 0%;"><center> <i class="fa fa-user-circle"></i> </center> <center>{{$rt->departing->bus->driver}}</center><center><span style="font-size: 11px;color: #777;">driver</span></center></div>
                    <div class="col-xs-4" style="padding: 0%;"><center><i class="fa fa-bus"></i> </center><center> {{$rt->departing->bus->bus_number}}</center><center><span style="font-size: 11px;color: #777;">bus number</span></center></div> 
                    <div class="col-xs-4" style="padding: 0%;"><center> <span style="font-size: 15px;">{{$rt->departing->bus->capacity}}</span></center><center> passengers</center><center><span style="font-size: 11px;color: #777;">capacity</span></center></div>
                    </div>
                            
                        
                    <br><br>
                    <div class="col-xs-12" style="padding: 0%;margin-top: 2%;margin-bottom: 2%;">
                    <div class="col-xs-6" style="border-color: green;padding: 1%;font-weight: 600;">
                    <center>{{$rt->departing->departure->name}}( {{$rt->departing->departure->abbreviation}})  </center>
                    <center>to</center>
                    <center>{{$rt->departing->arrival->name}}( {{$rt->departing->arrival->abbreviation}})</center>
                    <center>via {{$rt->departing->via}}</center>
                    

                    </div>
                    <div class="col-xs-6">
                        <a href="{{ URL::to('/images/'.$rt->departing->bus->photo) }}"><img src="{{ URL::to('/images/'.$rt->departing->bus->photo) }}" alt="Trip bus" class="img-thumbnail"></a>
                    </div>
                    </div>
                    
                    <br><br>
                    Features <i class="fa fa-star"></i>
                    <br>
                    <ul class="list-inline">
                        <li>&#183; <i class="material-icons">local_gas_station</i> {{$rt->departing->bus->specialFeatures['fuel']}}</li>
                        <li>&#183; <i class="fa fa-tv"></i>
                        @if ($rt->departing->bus->specialFeatures['television'] == "yes") 
                        Television
                        @else
                        <s>Television</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fa fa-wifi"></i>  
                        @if ($rt->departing->bus->specialFeatures['wifi'] == "yes") 
                        Wifi
                        @else
                        <s>Wifi</s>
                        @endif
                        </li>
                        <li>
                            @if ($rt->departing->bus->specialFeatures['ac'] == "yes") 
                        &#183; Air Condition
                        @else
                        &#183; <s>Air Condition</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-wheelchair"></i>
                         @if ($rt->departing->bus->specialFeatures['wheel_lift'] == "yes") 
                        Wheel lift
                        @else
                        <s>Wheel Lift</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-bus"></i> {{$rt->departing->bus->specialFeatures['articulation']}}</li>
                        <li>&#183; {{$rt->departing->bus->specialFeatures['decker']}}</li>
                    </ul>
                    
                </div>
            </div>
                    @endif
                    @if (date('Ymd', $rt_returning_date) == date('Ymd', strtotime($trip_date)))
            <div class="card card-default" style="border-radius: 0;margin: -3%;margin-bottom: 5%;font-weight: 500;">
                <div class="card-header" style="background-color: #fff;">
                    {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}} --
                     @php
                        
                        $now = date('Ymd'); 
                        $this_ow_date = date('Ymd', strtotime($trip_date));
                        $diffDays = $now - $this_ow_date;
                        
                        
                        switch ($diffDays) {
                            case -1:

                                echo "Tomorrow" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;

                            case 0:
                                echo "Today" . " - "  . date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                            
                            default:
                                echo date('l', strtotime($trip_date)) . ", " . date('F', strtotime($trip_date)) . " " . date('d', strtotime($trip_date)) . ", " . date('Y', strtotime($trip_date));
                                break;
                        }
                    
                        
                    @endphp
                    <span class="text-primary">Return Trip Inbound <i class="material-icons text-primary" style="font-size: 15px;">flight_land</i></span>
                      <span class="float-right"><i class="fa fa-chevron-down" style="color: inherit;" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>
                </div>
                <div class="card-body" style="display: none;">
                    
                    <div class="col-xs-12" style="padding: 0%;">    
                    <div class="col-xs-4" style="padding: 0%;"><center> <i class="fa fa-user-circle"></i> </center> <center>{{$rt->returning->bus->driver}}</center><center><span style="font-size: 11px;color: #777;">driver</span></center></div>
                    <div class="col-xs-4" style="padding: 0%;"><center><i class="fa fa-bus"></i> </center><center> {{$rt->returning->bus->bus_number}}</center><center><span style="font-size: 11px;color: #777;">bus number</span></center></div> 
                    <div class="col-xs-4" style="padding: 0%;"><center> <span style="font-size: 15px;">{{$rt->returning->bus->capacity}}</span></center><center> passengers</center><center><span style="font-size: 11px;color: #777;">capacity</span></center></div>
                    </div>
                            
                        
                    <br><br>
                    <div class="col-xs-12" style="padding: 0%;margin-top: 2%;margin-bottom: 2%;">
                    <div class="col-xs-6" style="border-color: green;padding: 1%;font-weight: 600;">
                    <center>{{$rt->returning->departure->name}}( {{$rt->returning->departure->abbreviation}})  </center>
                    <center>to</center>
                    <center>{{$rt->returning->arrival->name}}( {{$rt->returning->arrival->abbreviation}})</center>
                    <center>via {{$rt->returning->via}}</center>
                    

                    </div>
                    <div class="col-xs-6">
                        <a href="{{ URL::to('/images/'.$rt->returning->bus->photo) }}"><img src="{{ URL::to('/images/'.$rt->returning->bus->photo) }}" alt="Yutong bus" class="img-thumbnail"></a>
                    </div>
                    </div>
                    
                    <br><br>
                    Features <i class="fa fa-star"></i>
                    <br>
                    <ul class="list-inline">
                        <li>&#183; <i class="material-icons">local_gas_station</i> {{$rt->returning->bus->specialFeatures['fuel']}}</li>
                        <li>&#183; <i class="fa fa-tv"></i>
                        @if ($rt->returning->bus->specialFeatures['television'] == "yes") 
                        Television
                        @else
                        <s>Television</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fa fa-wifi"></i>  
                        @if ($rt->returning->bus->specialFeatures['wifi'] == "yes") 
                        Wifi
                        @else
                        <s>Wifi</s>
                        @endif
                        </li>
                        <li>
                            @if ($rt->returning->bus->specialFeatures['ac'] == "yes") 
                        &#183; Air Condition
                        @else
                        &#183; <s>Air Condition</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-wheelchair"></i>
                         @if ($rt->returning->bus->specialFeatures['wheel_lift'] == "yes") 
                        Wheel lift
                        @else
                        <s>Wheel Lift</s>
                        @endif
                        </li>
                        <li>&#183; <i class="fas fa-bus"></i> {{$rt->returning->bus->specialFeatures['articulation']}}</li>
                        <li>&#183; {{$rt->returning->bus->specialFeatures['decker']}}</li>
                    </ul>
                    
                </div>
            </div>
            
                 @endif
                    @endforeach

                    <!-- end of rt bookings -->
                    @endforeach
                    @endif
                @endif
                
            
            </div>
        
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
           </div> 
        

               
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

            $('body').on('keyup', '#search_history', function(){
              // alert('Hi');
               $value = $('#search_history').val(); // arrival station
               let pointid = $('#search_history').attr("data-pointid");
               // $departure_station = $('input[name="ow_departure_station"]').val();
               // $date = $('input[name="ow_date"]').val();
               // $passenger_num = $('input[name="ow_passenger_num"]').val();
               
                $.ajax({
                    type : 'GET',
                    url  : '{{ route('search.history') }}',
                    data : {'search_history': $value, 'booking_id': pointid},
                    success:function(data){
                        /*console.log(data);*/
                        
                              $('.main').html(data);
                          
                        
                    }
                }); 

                });


            $('#ow_contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#ow_title').val() + ' ' + $('input[name="ow_first_name"]').val() + ' ' + $('input[name="ow_last_name"]').val(); 
                this.options.add(c, 2);
            });
            // let deletehistory class element be for oneway trips and remove history for return trips
            $('.delete_history').click(function(){

                let pointid = $(this).attr("data-pointid");

                $.ajax({
                    url: "{{route('history.delete')}}",
                    type: 'DELETE',
                    data: {'booking_id':pointid},

                    
                }).done(function(data){
                    
                        alert('success');
                });
                alert(pointid);
            });

            
        </script>
        
        
           

    </body>
</html>
