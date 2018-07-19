<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Trip Timeline @guest @else | {{Auth::user()->first_name}} {{Auth::user()->last_name}} @endguest</title>

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
        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;">Trips Timeline</span></li>
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
                    <hr> <a href="{{ route('my.trips.oneway') }}" style="color: #fff;cursor: pointer;">
                    My Trips</a> <br>
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
            <!-- @if($test)
            {{$test}} <br>
            date('Ymd') - {{$test}}
            @endif -->
            <!-- @if(!$combined_past_trips)
            no c b date
            @else
                @foreach($combined_past_trips as $cb)
                {{$cb}}
                @endforeach
            @endif -->


            @if (!$uniqueOWs)
            no booking
            @else
            <!-- <div class="inner-addon left-addon">
                <i class="fas fa-search"></i>
            <input style="border: none; box-shadow: none; font-size: 20px; min-width: 17em;" type="text" id="search_history" name="search_history" class="form-control" height="50px" width="90%" placeholder="Search history" autofocus>
            </div> -->
            <center><i class="fa fa-calendar-alt" style="font-size: 20px;"></i></center>
            @endif
           <br>
           <div class="main">
                @if(!$uniqueOWs->count() || !$uniqueRTs->count())
                <div class="container" style="font-weight: 500;"> No active trip booking found</div>
                @else
                    @if (!$combined_trip_dates)
                    no trip dates
                    @else

                    <div style="background-color: #f8f8f8;padding: 2%;border: 1px solid #E8E8E8;font-family: Arial;">
                &nbsp;&nbsp;<span style="font-weight: 300;" class="text-success">Trips pending </span>- <span class="text-success">OW</span>&nbsp;&nbsp;/&nbsp;&nbsp;RT <span class="text-primary">Outbound</span>&nbsp;&nbsp;<span class="text-danger">Inbound</span><span class="float-right"><i class="fas fa-chevron-up text-success" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span>
                    </div>

                    <div class="">
                    @foreach ($combined_trip_dates as $trip_date)



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
                </div>

                <!-- start of checking of ows -->
                    @foreach ($uniqueOWs as $ow)

                         @php
                         
                         $ow_trip_date = explode(" ", $ow->trip->departure_date)[1] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[3];

                         $ow_trip_date = strtotime($ow_trip_date);
                         

                         @endphp
                        

                        @if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($trip_date)))
                        
                        @continue
                        @else
                        

                   
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
               
                <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-success"> {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$ow->trip->departure->name}} ({{$ow->trip->departure->abbreviation}}) to {{$ow->trip->arrival->name}} ({{$ow->trip->arrival->abbreviation}}) via {{$ow->trip->via}}</td>
                      <td style="border-top-style: none;">GHS {{$ow->trip->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div>
                        </td>
                    </tr>    
                            </tbody>
                        </table>
                    </div>
                    @endif
                    @endforeach
                <!-- end of ow bookings trips -->

                <!-- start of rt bookings trips -->
                @foreach ($uniqueRTs as $rt)

                         @php
                         
                         $rt_departing_date = explode(" ", $rt->departing->departure_date)[1] . "-" . explode(" ", $rt->departing->departure_date)[2] . "-" . explode(" ", $rt->departing->departure_date)[3];

                         $rt_returning_date = explode(" ", $rt->returning->departure_date)[1] . "-" . explode(" ", $rt->returning->departure_date)[2] . "-" . explode(" ", $rt->returning->departure_date)[3];

                         $rt_departing_date = strtotime($rt_departing_date);
                         

                         $rt_returning_date = strtotime($rt_returning_date);
                         

                         @endphp

                        @if (date('Ymd', $rt_departing_date) == date('Ymd', strtotime($trip_date)))
                        
                   
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
                    
                <table class="table" style="margin-bottom: 1%;">
                   
                  <tbody>
                    <!-- rt departing trip -->
                    <tr>
                      <th scope="row" style="" class="text-primary"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
                      <td style="">{{$rt->departing->departure->name}} ({{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}} ({{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</td>
                      <td style="">GHS {{$rt->departing->trip_fare}}</td>
                      <td style="">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div>
                        </td>
                    </tr>   
                    </tbody>
                        </table>
                    </div>
                    @endif
                        @if (date('Ymd', $rt_returning_date) == date('Ymd', strtotime($trip_date)))

                        
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
              
                <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-danger"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$rt->returning->departure->name}} ({{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}} ({{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</td>
                      <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div>
                        </td>
                    </tr>    
                            </tbody>
                        </table>
                    </div>

                    @endif
                

                <!-- end of rt bookings trips -->
                @endforeach
                </div>
            @endforeach  
                </div>
                    @endif

                    @endif

                <div style="background-color: #f8f8f8;padding: 2%;margin-top: 5%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">Past  <span class="float-right"><i class="fas fa-chevron-up" style="color: inherit;" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.children[3].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.children[3].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.children[3].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></span> </span>
                            
                </div>
                    @if (!$combined_past_trips)
                    <div class="container">no past One Way or return trips dates found in history</div>
                    @else
                    <div class="">
                    @foreach ($combined_past_trips as $ow_date)

                    <div class="card card-default" style="font-weight: 400;margin: 1%;margin-bottom: 2%;margin-top: 2%;">
                    
                    
                    <div class="card-header">
                        @php
                        
                        $now = date('Ymd'); 
                        $this_ow_date = date('Ymd', strtotime($ow_date));
                        $diffDays = $now - $this_ow_date;
                        $current_day = "";
                        $yesterday = "";
                        $tomorrow = "";
                        
                        switch ($diffDays) {
                            case -1:

                                echo "Tomorrow" . " - "  . date('l', strtotime($ow_date)) . ", " . date('F', strtotime($ow_date)) . " " . date('d', strtotime($ow_date)) . ", " . date('Y', strtotime($ow_date));
                                break;

                            case 0:
                                echo "Today" . " - "  . date('l', strtotime($ow_date)) . ", " . date('F', strtotime($ow_date)) . " " . date('d', strtotime($ow_date)) . ", " . date('Y', strtotime($ow_date));
                                break;

                            case +1:
                                echo "Yesterday" . " - "  . date('l', strtotime($ow_date)) . ", " . date('F', strtotime($ow_date)) . " " . date('d', strtotime($ow_date)) . ", " . date('Y', strtotime($ow_date));
                                break;
                            
                            default:
                                echo date('l', strtotime($ow_date)) . ", " . date('F', strtotime($ow_date)) . " " . date('d', strtotime($ow_date)) . ", " . date('Y', strtotime($ow_date));
                                break;
                        }
                    
                        
                        @endphp
                    </div>

                        @foreach ($uniqueOWs as $ow)
                         
                        

                         @php
                         
                         $ow_trip_date = explode(" ", $ow->trip->departure_date)[1] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[3];

                         $ow_trip_date = strtotime($ow_trip_date);
                         

                         @endphp
                        

                        @if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($ow_date)))
                        
                        @continue
                        @else
                
                   
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
               
                <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" class="text-success" style="border-top-style: none;"> {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$ow->trip->departure->name}} ({{$ow->trip->departure->abbreviation}}) to {{$ow->trip->arrival->name}} ({{$ow->trip->arrival->abbreviation}}) via {{$ow->trip->via}}</td>
                      <td style="border-top-style: none;">GHS {{$ow->trip->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" style="cursor: ;">Remove from history</a>
                        </div>
                      </div>
                        </td>
                    </tr>                    
                    
                  </tbody>
                </table>
                
                    
                </div>
                        @endif

                        @endforeach


                <!-- start of rt bookings trips -->
                @foreach ($uniqueRTs as $rt)

                        @php
                         
                         $rt_departing_date = explode(" ", $rt->departing->departure_date)[1] . "-" . explode(" ", $rt->departing->departure_date)[2] . "-" . explode(" ", $rt->departing->departure_date)[3];

                         $rt_returning_date = explode(" ", $rt->returning->departure_date)[1] . "-" . explode(" ", $rt->returning->departure_date)[2] . "-" . explode(" ", $rt->returning->departure_date)[3];

                         $rt_departing_date = strtotime($rt_departing_date);
                         

                         $rt_returning_date = strtotime($rt_returning_date);
                         

                         @endphp

                        @if (date('Ymd', $rt_departing_date) == date('Ymd', strtotime($ow_date)))
                        
                   
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
                    
                <table class="table" style="margin-bottom: 1%;">
                   
                  <tbody>
                    <!-- rt departing trip -->
                    <tr>
                      <th scope="row" style="" class="text-primary"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
                      <td style="">{{$rt->departing->departure->name}} ({{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}} ({{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</td>
                      <td style="">GHS {{$rt->departing->trip_fare}}</td>
                      <td style="">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div>
                        </td>
                    </tr>   
                    </tbody>
                        </table>
                    </div>
                    @endif
                        @if (date('Ymd', $rt_returning_date) == date('Ymd', strtotime($ow_date)))

                        
                    <div class="card-body" style="padding: 1%;font-size: 12.5px;font-family: Arial;">
              
                <table class="table" style="margin-bottom: 1%;">
                  
                  <tbody>
                    <tr>
                      <th scope="row" style="border-top-style: none;" class="text-danger"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
                      <td style="border-top-style: none;">{{$rt->returning->departure->name}} ({{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}} ({{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</td>
                      <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
                      <td style="border-top-style: none;">
                        <div class="dropdown dropleft float-right">
                        <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                          
                        
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
                        </div>
                      </div>
                        </td>
                    </tr>    
                            </tbody>
                        </table>
                    </div>

                    @endif
                

                <!-- end of rt bookings trips -->
                    
                    @endforeach
                    </div>
                 @endforeach
                </div>
            
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
            
               // $departure_station = $('input[name="ow_departure_station"]').val();
               // $date = $('input[name="ow_date"]').val();
               // $passenger_num = $('input[name="ow_passenger_num"]').val();
               
                $.ajax({
                    type : 'GET',
                    url  : '{{ route('search.history') }}',
                    data : {'search_history': $value},
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
