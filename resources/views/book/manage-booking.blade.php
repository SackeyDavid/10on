<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Manage Your Booking @guest @else | {{Auth::user()->first_name}} {{Auth::user()->last_name}} @endguest</title>

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
                right: 32%;
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

            select, input {border: none;border-bottom: 1px #ddd solid;width: 100%;}
            select:focus, input:focus {outline: none;border-bottom: 1px #ddd solid;width: 100%;}
            
        </style>
    </head>
    <body style="max-width: 100%;">
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}.</a></center></p>
            </div>
            @endif

            <div id="delete-info" class="alert alert-info" role="alert" style="margin-bottom: 0%;">
            <button type="button" data-dismiss="alert" class="close" onclick="$('.alert').alert('close');"><span aria-hidden="true">&times;</span></button>
            <p class=""><center style="color: #000;font-weight: 500;"> Deleting any Return Trip (RT) booking deletes the two trips. More info at bottom of page.</center></p>
            </div>

        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;">Manage Booking</span></li>
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
            
           
           <div class="main" style="font-family: Arial;">
           <center> <i class="fa fa-edit" style="font-size: 32px;color: #000;"></i><br>Edit Booking Info</center> 
           <br>
           <!--  @if(!count($combined_trip_dates))
             no combined_trip_dates
            @else
                @foreach($combined_trip_dates as $cb)
                {{$cb}}
                @endforeach
            @endif -->


                @if(!$uniqueOWs->count() && !$uniqueRTs->count())
                no trip booking found
                @else
                    @if (!$combined_trip_dates)
                    no ow trip dates
                    @else
                    <div style="background-color: #f8f8f8;padding: 2%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">Active Bookings 
            </div>
                    @foreach ($combined_trip_dates as $trip_date)

<!-- ow bookings -->
                    @foreach ($uniqueOWs as $ow)

                         @php
                         
                         $ow_trip_date = explode(" ", $ow->trip->departure_date)[1] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[3];

                         $ow_trip_date = strtotime($ow_trip_date);
                         
                         @endphp

                    @if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($trip_date)))
                    @continue
                    @else
                <div class="card card-default" style="font-weight: 400;margin: 1%;margin-top: 2%;">
                
                    
                <div class="card-header">
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
                    --OW-{{$ow->id}}
                    <span class="float-right"><i class="fas fa-chevron-down" style="color: inherit;"  onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>

                        <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-success"> {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}}</th>
                      <th style="border-top-style: none;">{{$ow->trip->departure->name}}( {{$ow->trip->departure->abbreviation}}) to {{$ow->trip->arrival->name}}( {{$ow->trip->arrival->abbreviation}}) via {{$ow->trip->via}}</th>
                      <td style="border-top-style: none;"><i class="material-icons text-success" style="font-size: 15px;">flight_takeoff</i></td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this booking</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_ow_booking text-danger" data-pointid="{{$ow->id}}">Cancel booking</span></a>
                        </div>
                      </div>

                        </td>
                    </tr>    
                            </tbody>
                        </table>
                </div>
                        
                        

                   
                    <div class="card-body" style="display: none;padding: 1%;font-size: 12.5px;">
                     <div class="card-body">  
                     <table class="class">
                     <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-success"> {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}}</th>
                      <th style="border-top-style: none;">{{$ow->trip->departure->name}}( {{$ow->trip->departure->abbreviation}}) to {{$ow->trip->arrival->name}}( {{$ow->trip->arrival->abbreviation}}) via {{$ow->trip->via}}</th>
                      <td style="border-top-style: none;">GHS {{$ow->trip->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <!-- <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this booking</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history text-danger" data-pointid="{{$ow->id}}">Cancel booking</span></a>
                        </div>
                      </div> -->

                        </td>
                    </tr>    
                            </tbody>
                        </table> <br>
                    <i class="fas fa-user"></i> Personal <br>

                    <!-- this should be horizontal in design but not yet -->
                    <form method="POST" action="{{route('edit.booking')}}">
                        @csrf
                        
                    <ul class="list-group">
                       <li class="list-group-item">
                        <select type="text" name="title" value="{{$ow->user->title}}">
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                            <option>Ms</option>
                        </select> 
                       <li class="list-group-item"><input type="text" name="first_name" value="{{$ow->user->first_name}}"></li>
                       <li class="list-group-item"><input type="text" name="last_name" value="{{$ow->user->last_name}}"></li>
                       <li class="list-group-item"><input type="email" name="email" value="{{$ow->user->email}}"></li> 
                       <li class="list-group-item"><input type="text" name="country" value="{{$ow->user->country}}"></li>
                       <li class="list-group-item"><input type="tel" name="mobile_number" value="{{$ow->user->mobile_number}}"></li>
                       <li class="list-group-item"><input type="text" name="contact_person" value="{{$ow->user->contact_person}}"></li>
                       <li class="list-group-item">
                        @if(Auth::user()->remind_me == "yes")

                       Remind me
                            <input type="checkbox" id="remind_me" name="remind_me" value="yes"  class="form-control passenger-details-inputs" onclick="
                            if (this.is(':checked')) {
                                this.val('yes');
                            }else {
                                this.val('no');
                            }" checked required>
                            
                    
                        
                        @else
                        Remind me
                        <input type="checkbox" id="remind_me" name="remind_me" style=""  class="form-control passenger-details-inputs" placeholder="Title" required> 
                        @endif
                      </li>
                    </ul>
                    
                    <br>
                    <i class="fas fa-mobile-alt"></i> Payment <br>
                    <ul class="list-group">
                        <li class="list-group-item"><input type="text" name="phone_number" value="{{$ow->mobileMoney->phone_number}}"></li>
                        <li class="list-group-item">
                            <select type="text" name="network">
                                <option>{{$ow->mobileMoney->network}}</option>
                                <option value="mtn-gh">MTN</option>
                                <option value="tigo-gh">TIGO</option>
                                <option value="vodafone-gh">Vodafone</option>
                                <option value="airtel-gh">Airtel</option>
                            </select>
                    </ul>
                    <br>
                    <center><button class="btn btn-success btn-lg">Save</button></center>
                    </form>
                    </div>
                    </div>
                   
                </div>
                      @endif

                    @endforeach          
<!-- end ow bookings -->

<!-- start of rt bookings -->
                        @foreach ($uniqueRTs as $rt)

                         @php
                         
                         $rt_departing_date = explode(" ", $rt->departing->departure_date)[1] . "-" . explode(" ", $rt->departing->departure_date)[2] . "-" . explode(" ", $rt->departing->departure_date)[3];

                         $rt_returning_date = explode(" ", $rt->returning->departure_date)[1] . "-" . explode(" ", $rt->returning->departure_date)[2] . "-" . explode(" ", $rt->returning->departure_date)[3];

                         $rt_departing_date = strtotime($rt_departing_date);
                         

                         $rt_returning_date = strtotime($rt_returning_date);
                         

                         @endphp

                    @if (date('Ymd', $rt_departing_date) == date('Ymd', strtotime($trip_date)))
                <div class="card card-default" style="font-weight: 400;margin: 1%;margin-top: 2%;">
                
                    
                <div class="card-header">
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
                    --RT-{{$rt->id}}
                    <span class="float-right"><i class="fas fa-chevron-down" style="color: inherit;"  onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>

                        <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-primary"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
                      <th style="border-top-style: none;">{{$rt->departing->departure->name}}( {{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}}( {{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</th>
                      <td style="border-top-style: none;"><i class="material-icons text-primary" style="font-size: 15px;">flight_takeoff</i></td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this booking</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_rt_booking text-danger" data-pointid="{{$rt->id}}">Cancel this booking</span></a>
                        </div>
                      </div>

                        </td>
                    </tr>    
                            </tbody>
                        </table>
                </div>
                        
                 <!-- ones with colors in the card body are the trips that are pending -->

                   
                    <div class="card-body" style="display: none;padding: 1%;font-size: 12.5px;">
                     <div class="card-body"> 
                     <table class="table"> 
                     <tbody>  
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-primary"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
                      <th style="border-top-style: none;">{{$rt->departing->departure->name}}( {{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}}( {{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</th>
                      <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <!-- <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this booking</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_rt_booking text-danger" data-pointid="{{$rt->id}}">Cancel this booking</span></a>
                        </div>
                      </div> -->

                        </td>
                    </tr>    
                     <tr>
                      <th scope="row" style="border-top-style: none;"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$rt->returning->departure->name}}( {{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}}( {{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</td>
                      <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <!-- <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div> -->
                        </td>
                    </tr>
                    </tbody> 
                    </table> 

                    <i class="fas fa-user"></i> Personal <br>

                    <!-- this should be horizontal in design but not yet -->
                    <form method="POST" action="{{route('edit.booking')}}">
                        @csrf
                        
                    <ul class="list-group">
                       <li class="list-group-item">
                        <select type="text" name="title" value="{{$rt->user->title}}">
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                            <option>Ms</option>
                        </select> 
                       <li class="list-group-item"><input type="text" name="first_name" value="{{$rt->user->first_name}}"></li>
                       <li class="list-group-item"><input type="text" name="last_name" value="{{$rt->user->last_name}}"></li>
                       <li class="list-group-item"><input type="email" name="email" value="{{$rt->user->email}}"></li> 
                       <li class="list-group-item"><input type="text" name="country" value="{{$rt->user->country}}"></li>
                       <li class="list-group-item"><input type="tel" name="mobile_number" value="{{$rt->user->mobile_number}}"></li>
                       <li class="list-group-item"><input type="text" name="contact_person" value="{{$rt->user->contact_person}}"></li>
                       <li class="list-group-item">
                        @if(Auth::user()->remind_me == "yes")

                       Remind me
                            <input type="checkbox" id="remind_me" name="remind_me" value="yes"  class="form-control passenger-details-inputs" onclick="
                            if (this.is(':checked')) {
                                this.val('yes');
                            }else {
                                this.val('no');
                            }" checked required>
                            
                    
                        
                        @else
                        Remind me
                        <input type="checkbox" id="remind_me" name="remind_me" style=""  class="form-control passenger-details-inputs" placeholder="Title" required> 
                        @endif
                      </li>
                    </ul>
                    
                    <br>
                    <i class="fas fa-mobile-alt"></i> Payment <br>
                    <ul class="list-group">
                        <li class="list-group-item"><input type="text" name="phone_number" value="{{$rt->mobileMoney['phone_number']}}"></li>
                        <li class="list-group-item">
                            <select type="text" name="network">
                                <option>{{$rt->mobileMoney['network']}}</option>
                                <option value="mtn-gh">MTN</option>
                                <option value="tigo-gh">TIGO</option>
                                <option value="vodafone-gh">Vodafone</option>
                                <option value="airtel-gh">Airtel</option>
                            </select>
                    </ul>
                    <br>
                    <center><button class="btn btn-success btn-lg">Save</button></center>
                    </form>
                    </div>
                    </div>
                   
                </div>
                    @endif
                @if(date('Ymd', $rt_returning_date) == date('Ymd', strtotime($trip_date)))
                <div class="card card-default" style="font-weight: 400;margin: 1%;margin-top: 2%;">
                
                    
                <div class="card-header">
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
                    --RT-{{$rt->id}}
                    <span class="float-right"><i class="fas fa-chevron-down" style="color: inherit;"  onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>

                        <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-primary"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
                      <th style="border-top-style: none;">{{$rt->returning->departure->name}}( {{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}}( {{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</th>
                      <td style="border-top-style: none;"><i class="material-icons text-primary" style="font-size: 15px;">flight_land</i> </td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this booking</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_rt_booking text-danger" data-pointid="{{$rt->id}}">Cancel this booking</span></a>
                        </div>
                      </div>

                        </td>
                    </tr>    
                            </tbody>
                        </table>
                </div>
                        
             

                   
                    <div class="card-body" style="display: none;padding: 1%;font-size: 12.5px;">
                     <div class="card-body"> 
                     <table class="table"> 
                     <tbody>
                     <tr>
                      <th scope="row" style="border-top-style: none;"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$rt->departing->departure->name}}( {{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}}( {{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</td>
                      <td style="border-top-style: none;">GHS {{$rt->departing->trip_fare}}</td>
                      <td style="border-top-style: none;">
                       <!--  <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Cancel this trip</span></a>
                        </div>
                      </div> -->
                        </td>
                    </tr>

                     <tr>
                      <th scope="row" style="border-top-style: none;" class="text-primary"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$rt->returning->departure->name}}( {{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}}( {{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</td>
                      <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <!-- <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Cancel this trip</span></a>
                        </div>
                      </div> -->
                        </td>
                    </tr>
                    </tbody> 
                    </table> 
                    <i class="fas fa-user"></i> Personal <br>

                    <!-- this should be horizontal in design but not yet -->
                    <form method="POST" action="{{route('edit.booking')}}">
                        @csrf
                        
                    <ul class="list-group">
                       <li class="list-group-item">
                        <select type="text" name="title" value="{{$rt->user->title}}">
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                            <option>Ms</option>
                        </select> 
                       <li class="list-group-item"><input type="text" name="first_name" value="{{$rt->user->first_name}}"></li>
                       <li class="list-group-item"><input type="text" name="last_name" value="{{$rt->user->last_name}}"></li>
                       <li class="list-group-item"><input type="email" name="email" value="{{$rt->user->email}}"></li> 
                       <li class="list-group-item"><input type="text" name="country" value="{{$rt->user->country}}"></li>
                       <li class="list-group-item"><input type="tel" name="mobile_number" value="{{$rt->user->mobile_number}}"></li>
                       <li class="list-group-item"><input type="text" name="contact_person" value="{{$rt->user->contact_person}}"></li>
                       <li class="list-group-item">
                        @if(Auth::user()->remind_me == "yes")

                       Remind me
                            <input type="checkbox" id="remind_me" name="remind_me" value="yes"  class="form-control passenger-details-inputs" onclick="
                            if (this.is(':checked')) {
                                this.val('yes');
                            }else {
                                this.val('no');
                            }" checked required>
                            
                    
                        
                        @else
                        Remind me
                        <input type="checkbox" id="remind_me" name="remind_me" style=""  class="form-control passenger-details-inputs" placeholder="Title" required> 
                        @endif
                      </li>
                    </ul>
                    
                    <br>
                    <i class="fas fa-mobile-alt"></i> Payment <br>
                    <ul class="list-group">
                        <li class="list-group-item"><input type="text" name="phone_number" value="{{$rt->mobileMoney['phone_number']}}"></li>
                        <li class="list-group-item">
                            <select type="text" name="network">
                                <option>{{$rt->mobileMoney['network']}}</option>
                                <option value="mtn-gh">MTN</option>
                                <option value="tigo-gh">TIGO</option>
                                <option value="vodafone-gh">Vodafone</option>
                                <option value="airtel-gh">Airtel</option>
                            </select>
                    </ul>
                    <br>
                    <center><button class="btn btn-success btn-lg">Save</button></center>
                    </form>
                    </div>
                    </div>
                   
                </div>

                      @endif

                    @endforeach 
<!-- end of rt bookings -->
                    @endforeach
                    @endif
                @endif
                <br>
                <div class="container" style="color: #777;font-family: Arial;font-size: 12px;">
                <ul class="list-inline">
                    <li>RT-## = Return Trip ID.</li>
                    <li>OW-## = One Way Trip ID.</li>
                    <li>(<span class="text-success">OW</span>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="text-primary">RT</span> - Out <i class="material-icons" style="font-size: 15px;">flight_takeoff</i>&nbsp;&nbsp;/&nbsp;In <i class="material-icons" style="font-size: 15px;">flight_land</i> </span>).</li>
                    <li>All OW Trips are Outbounds.</li>
                    <li>Deleting any RT trip deletes the two bookings.</li>
                </ul>
                </div>

                
                
           </div> 
        

               
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript">
            $('#delete-info').fadeTo(12000, 500).slideUp(500, function() {
                $('.alert-info').slideUp(500);
            });

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
            $('.delete_ow_booking').click(function(){

                let pointid = $(this).attr("data-pointid");

                // history.delete route also works for deleting one way trips
                $.ajax({
                    url: "{{route('history.delete')}}",
                    type: 'DELETE',
                    data: {'booking_id':pointid},

                    
                }).done(function(data){
                    
                        alert('Booking cancellation successful. You can refresh page to see changes');
                        //location.reload();
                });
            
            });

            $('.delete_rt_booking').click(function(){

                let pointid = $(this).attr("data-pointid");

                $.ajax({
                    url: "{{route('return.booking.delete')}}",
                    type: 'DELETE',
                    data: {'booking_id':pointid},

                    
                }).done(function(data){
                    
                        alert('Booking cancellation successful. You can refresh page to see changes');
                        //location.reload();
                });
                
            });

            
        </script>
        
        
           

    </body>
</html>
