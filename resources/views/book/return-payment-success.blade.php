<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Payment Success</title>

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
                right: 30%;
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
            @media (max-width: 600px) {
                #login-modal .modal-dialog {
                /*overflow-y: hidden !important;
                overflow-x: hidden !important;
                overflow: hidden;*/
                height: 20%;
                width: 60%;
                margin: 20%;
                margin-top: 16%;
                
                }

            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
        </style>
    </head>
    <body style="width: 100%;">
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}</center></p>
            </div>
            @endif
        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;">Payment Success</span></li>
                    <!-- <li><span class="top-right links"><a href="#"> <i class="fas fa-cog"></i> </a></span></li> -->
                    <li><span class="top-left links"> <a ><span style="font-size: 15px;" onclick='
                    document.getElementById("mySidenav").style.width = "60%";
                    // if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                    //         this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "block";
                    //     } else {
                    //         this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "none";
                    //     }
                        
                        // $(this).toggleClass("fa-arrow-right fa-arrow-left");
                        ' >&#9776;</span> </a></span></li>
                </ul> 
            </div>
            <div id="mySidenav" class="sidenav" style="background-image: url('{{URL::to('images/3.jpg')}}');opacity: 0.;">
                <a href="javascript:void(0)" style="font-size: 25px;font-weight: 900;color: #fff;" class="closebtn top-right" onclick="
                document.getElementById('mySidenav').style.width = '0';">&times;</a>
                <div class="col-md-12" style="color: #fff;font-weight: 700;font-size: 20px;">
                    <hr>
                    My Trips <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                    <a href="{{ route('return.drive.status', ['booking_id' => $booking->id]) }}" style="color: #fff;cursor: pointer;">
                    Drive Status </a><br>
                    <hr>
                    My Account <br>
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
                    </div>
                </div>
            </div>

            

        </div>
        <hr style="margin-bottom: 2%;">
        <div style="margin: 0%;height: 36vh;font-weight: 400;">
            <div class="col-md-12" style="color: #000;font-weight: 300">
               <center>
                <span style="font-size: 20px;">Thank you , 
                    @if(Auth::user())
                    {{ $passenger_details->first_name}} {{ $passenger_details->last_name}}
                    @else
                    
                    @endif
                </span> <br>
                <span>Your booking with ID <span style="font-weight: 800">RT-{{$booking->id}}</span> has been <span style="font-weight: 800">submitted.</span> You will receive notification when check-in opens</span>
            </center>
            </div>
            
            
            <div class="col-md-12">
                <br>
                <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid #ccc;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">
                                      Your Trip</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">&nbsp;&nbsp; </span><i style="color: #ff3345;cursor: pointer;" class="fas fa-chevron-down" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                             
                              <td style="padding: 5%; ">
                                <ul class="list-unstyled">
                                 <li>
                        <ul class="list-inline">
                          <li>Depart: <span class="trip_details">{{ $outbound->departure_time }} - {{ $outbound->arrival_time }}</span></li>  
                          <li class="pull-right"><span class="trip_details">GH&#8373; 

                            <!-- display lowest price stored in combined cost using the LPDK and LPRK values -->
                            @php
                            
                            echo number_format(((float)$outbound->trip_fare + (float)$inbound->trip_fare)*$passenger_num,2);
                            @endphp
                          </span> </li>
                        </ul>
                    </li>
                    <li>
                    <ul class="list-inline">
                        
                    <li>Return: <span class="trip_details">{{ $inbound->departure_time }} - {{ $inbound->arrival_time }}</span><br></li>
                        
                    
                    </ul>
                    </li>
                    <li>
                        <ul class="list-inline" style="margin-bottom: -2%;">
                          <li><span id="trip_duration_in_hrs" class="trip_details">
                            @php 
                            $out_duration =  $outbound->trip_duration_in_hrs ;
                            $in_duration =  $inbound->trip_duration_in_hrs ;
                            $data_out_duration =  explode(" ", $out_duration);
                            $data_in_duration = explode(" ", $in_duration);
                            $data_out_duration_hrs_element = (float)$data_out_duration[0];
                            $data_in_duration_hrs_element = (float)$data_in_duration[0];

                            $data_out_duration_mins_element = (float)$data_out_duration[3];
                            $data_in_duration_mins_element = (float)$data_in_duration[3];


                            $trip_hrs_duration = $data_out_duration_hrs_element + $data_in_duration_hrs_element;
                            $trip_mins_duration = $data_out_duration_mins_element + $data_in_duration_mins_element;

                            if (($trip_mins_duration - 60) >= 0)
                            {
                                $trip_mins_duration = $trip_mins_duration % 60;
                                $trip_hrs_duration++;
                            }

                            echo $trip_hrs_duration . '<span style="color: #777;font-size: 13px;font-weight: 600;"> hr</span>' . ' ' . $trip_mins_duration . '<span style="color: #777;font-size: 13px;font-weight: 600;"> min</span>';
                            
                            @endphp
                             <span style="color: #777;font-size: 13px;font-weight: 600;"> via {{ $outbound->via }}</span>  </span></li>  
                          <li class="pull-right"><strong><span class="trip_host">{{ $outbound->host->username }} &nbsp;&nbsp;{{ $inbound->host->username }}</span></strong></li>
                        </ul>
                         
                    </li>
                    
                </ul>
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>
                <br>
                <div style="display: block;">
                <p><i class="material-icons" style="font-size: 15px;color: #B0E0E6;">flight_takeoff</i> Outbound</p>
                <div class="card card-default">
                    @if (!$outbound->departure_location || !$outbound->arrival_location || !$departure_abbreviation || !$arrival_abbreviation)
                    @else
                    
                    
                        <table class="table table-bordered"  style="border: 0.5px solid #ccc;margin-bottom: 0%;">
                          <thead style="background-color: #B0E0E6">
                            <tr>
                              <th colspan="4">{{ $outbound->departure_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $departure_abbreviation }}</strong></span>) to {{ $outbound->arrival_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $arrival_abbreviation }}</strong></span>)</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th rowspan="3">
                              <center>
                                {{ $outbound->host->represents->name }}  
                              </center></th>
                              <td>Depart</td>
                              <td>Arrive</td>
                              <td>Duration</td>
                            </tr>
                            <tr>
                              
                              <td rowspan="2" style="padding: 1%;">
                                  
                                      <span style="color: #000;font-size: 13px;padding: 5%;">{{ $outbound->departure_time }} </span>
                                      
                                    @php
                                    $depart_date =   $outbound->departure_date;
                                    $data_depart_date = explode(" ", $depart_date);
                                    $week_day = $data_depart_date[0];
                                    $day = $data_depart_date[1];
                                    $month = $data_depart_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  
                              </td>
                              <td rowspan="2" style="padding: 1%;">
                                    <span style="color: #000;font-size: 13px;padding: 5%;">{{ $outbound->arrival_time }} </span>
                                      
                                    @php
                                    $arrival_date =   $outbound->arrival_date;
                                    $data_arrive_date = explode(" ", $arrival_date);
                                    $week_day = $data_arrive_date[0];
                                    $day = $data_arrive_date[1];
                                    $month = $data_arrive_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  </td>
                              <td rowspan="2">
                                  <span style="color: #000;font-size: 13px;padding: 1%;">{{ $data_out_duration_hrs_element }} hr </span> <br>
                                      
                                    @php
                                    
                                    
                                    echo '<span style="padding: 1%;font-weight: 500;">' . $data_out_duration_mins_element . ' min' . '</span> <br>';
                                    echo '<span style="padding: 1%;font-weight: 500;">' . 'Non-stop ' . '</span>';
                                    @endphp
                              </td>
                            </tr>
                            <tr>
                              
                              
                            </tr>
                          </tbody>
                        </table> 
                    
                    @endif
                
                </div>
                
                <i class="material-icons" style="font-size: 15px;color: #66CDAA">flight_land</i> Inbound
                <table class="table table-bordered"  style="border: 0.5px solid #ccc;margin-bottom: 0%;">
                          <thead style="background-color: #7FFFD4">
                            <tr>
                              <th colspan="4">{{ $outbound->arrival_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $arrival_abbreviation }}</strong></span>) to {{ $outbound->departure_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $departure_abbreviation }}</strong></span>)
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th rowspan="3">
                              <center>
                                {{ $inbound->host->represents->name }}  
                              </center></th>
                              <td>Depart</td>
                              <td>Arrive</td>
                              <td>Duration</td>
                            </tr>
                            <tr>
                              
                              <td rowspan="2" style="padding: 1%;">
                                  
                                      <span style="color: #000;font-size: 13px;padding: 5%;">{{ $inbound->departure_time }} </span>
                                      
                                    @php
                                    $depart_date =   $inbound->departure_date;
                                    $data_depart_date = explode(" ", $depart_date);
                                    $week_day = $data_depart_date[0];
                                    $day = $data_depart_date[1];
                                    $month = $data_depart_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  
                              </td>
                              <td rowspan="2" style="padding: 1%;">
                                    <span style="color: #000;font-size: 13px;padding: 5%;">{{ $inbound->arrival_time }} </span>
                                      
                                    @php
                                    $arrival_date =   $inbound->arrival_date;
                                    $data_arrive_date = explode(" ", $arrival_date);
                                    $week_day = $data_arrive_date[0];
                                    $day = $data_arrive_date[1];
                                    $month = $data_arrive_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  </td>
                              <td rowspan="2">
                                  <span style="color: #000;font-size: 13px;padding: 1%;">{{ $data_in_duration_hrs_element }} hr </span> <br>
                                      
                                    @php
                                    
                                    
                                    echo '<span style="padding: 1%;font-weight: 500;">' . $data_in_duration_mins_element . ' min' . '</span> <br>';
                                    echo '<span style="padding: 1%;font-weight: 500;">' . 'Non-stop ' . '</span>';
                                    @endphp
                              </td>
                            </tr>
                            <tr>
                              
                              
                            </tr>
                          </tbody>
                        </table>
                        <br>
                <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid #ccc;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">
                                      @if($passenger_num > 1) 
                                        Passengers
                                      @else
                                        Passenger
                                      @endif</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">&nbsp;&nbsp; </span><u style="color: #ff3345;cursor: pointer;" class="fas fa-chevron" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '>Edit</u></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                             
                              <td style="padding: 5%; ">
                                <ul class="list-unstyled" style="font-weight: 400;">
                                    @if(Auth::user())
                                    <li>{{ Auth::user()->title}} {{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</li>
                                                                    
                                    @else
                                     @if($passenger_details == 'session expired')
                                     
                                     @else
                                    <li>{{$passenger_details->title}} {{$passenger_details->first_name}} {{$passenger_details->last_name}}</li>
                                     @endif
                                    @endif
                                
                                
                                </ul>
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>

                <br>
                <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid #ccc;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">Payment details</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">&nbsp;&nbsp; </span><u style="color: #ff3345;cursor: pointer;" class="fas fa-chevron" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '>Edit</u></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                             
                              <td style="padding: 5%; ">
                                <ul class="list-unstyled" style="font-weight: 400;">
                                    @if($option == 'wallet')
                                    <li>Paying with mobile money</li>
                                    <li>{{$payment_details->phone_number}}</li>
                                     <li>{{$payment_details->network}}</li>                                    
                                    @else
                                    <li>Paying with card</li>
                                    <li>{{$payment_details->card_number}}</li>
                                    @endif
                                
                                
                                </ul>
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>
                
 

                        <br>

                        <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid blue;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">You will earn</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">Show breakdown&nbsp;&nbsp; </span><i style="color: #ff3345;cursor: pointer;" class="fas fa-chevron-down" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                              <td style=" ">
                                  @php
                                $kilometers = (float)$outbound->kilometers + (float)$inbound->kilometers;

                                echo '<ul class="list-unstyled"><li><span style="color: #000;font-weight: 700">' . $kilometers . '</span></li><li>
                                   <span style="font-weight: 500;font-size: 15px;"> Landwards kilometers <br> <span style="font-size: 12px;font-family: Segoe UI;">(plus any applicable tier bonuses)</span></span>
                                </li></ul>';
                                @endphp 
                              </td>
                              <td style="padding: 5%; ">
                                @php
                                $kilometers = (float)$outbound->kilometers + (float)$inbound->kilometers;

                                echo '<ul class="list-unstyled"><li><span style="color: #000;font-weight: 700">' . $kilometers . '</span></li><li>
                                   <span style="font-weight: 500;font-size: 15px;"> Tier kilometers</span>
                                </li></ul>';
                                @endphp 
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>
                        <br>
                <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid #ccc;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">
                                      Terms and conditions</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">&nbsp;&nbsp; </span><i style="color: #ff3345;cursor: pointer;" class="fas fa-chevron-down" onclick='
                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].childNodes[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                             
                              <td style="padding: 5%; ">
                                <ul class="list-unstyled" style="font-weight: 400;">
                                    @if(Auth::user())
                                    <li>{{ Auth::user()->title}} {{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</li>
                                                                    
                                    @else
                                        @if($passenger_details == 'session expired')
                                        
                                        @else
                                    <li>{{$passenger_details->title}} {{$passenger_details->first_name}} {{$passenger_details->last_name}}</li>
                                        @endif
                                    
                                    @endif
                                
                                
                                </ul>
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>
                        <br>
                <table class="table table-bordered">
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid #ccc;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">
                                      Summary of charges</li>
                                      <li class="pull-right"></li>
                                  </ul>
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <div style="padding: 0%;">
                             
                              <td style="padding: 5%; ">
                                <ul class="list-unstyled" style="font-weight: 400;">
                                <li>
                                    <ul class="list-inline">
                                        <li>Ticket details</li>
                                        <li class="float-right">@if($passenger_num > 1) 
                                          {{$passenger_num}}  passengers
                                          @else
                                           {{$passenger_num}} passenger
                                          @endif</li>
                                    </ul>
                                    <hr style="margin-top: 3%;">
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li>Fare</li>
                                        <li class="float-right">GHS 
                                            @php
                                            echo number_format((float)$outbound->fare->road_fare + (float)$inbound->fare->road_fare,2);
                                            @endphp
                                          </li>
                                    </ul>
                                    <hr style="margin-top: 3%;">
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li>Taxes and fees</li>
                                        <li class="float-right">GHS 
                                            @php
                                            echo number_format((float)$outbound->tax->total + (float)$outbound->tax->total,2);
                                            @endphp</li>
                                    </ul>
                                    <hr style="margin-top: 3%;">
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li>Carrier-imposed charges</li>
                                        <li class="float-right">GHS 
                                            @php
                                            echo number_format((float)$outbound->fare->carrier_imposed_charges + (float)$inbound->fare->carrier_imposed_charges,2);
                                            @endphp</li>
                                    </ul>
                                    
                                </li>
                                </ul>

                              </td>
                              </div>
                            </tr>
                           <tr>
                            <div>
                               <td style="background-color: #f8f8f8;">
                                   <ul class="list-inline">
                                       <li>Total price in Ghanaian cedi</li>
                                       <li class="float-right"> @php
                                            echo '<span style="font-weight: 600;color: #000;">GHS ' .number_format(((float)$outbound->trip_fare + (float)$inbound->trip_fare)*$passenger_num,2). '</span>';
                                            @endphp</li>
                                   </ul>
                                   
                            <ul class="list-inline">
                                <li style="color: #000;font-size: 14px;font-family: Corbel;">Show fare breakdown (taxes and fees)</li>
                                <li class="float-right"><i class="fas fa-chevron-down logo-color" onclick='
                        if (this.parentNode.parentNode.parentNode.children[2].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[2].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[2].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                            </ul>
                            <div style="display: none;">
                                <p><span style="font-weight: 500;font-size: 14px;font-family: Corbel;">
                                @if(!$outbound->fare || !$inbound->fare)
                                <span style="font-size: 11px;font-family: Corbel;color: #ff3345;">There is no available information</span>
                                @else
                                All prices shown in GH&#8373;
                                @endif
                                </span></p>
                                <table class="table table-bordered">
                                  <thead style="background-color: #f8f8f8;">
                                    <tr>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Fare breakdown</span></th>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Adults</span></th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">Roadfare</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $road_fare = (float)$outbound->fare->road_fare + (float)$inbound->fare->road_fare;

                                        echo number_format($road_fare, 2);
                                        @endphp
                                        @endif
                                     </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Carrier-imposed charges</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $carrier_imposed_charges = (float)$outbound->fare->carrier_imposed_charges + (float)$inbound->fare->carrier_imposed_charges;

                                        echo number_format($carrier_imposed_charges, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Taxes, fees and charges</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $total_tax = (float)$outbound->fare->total_tax + (float)$inbound->fare->total_tax;

                                        echo number_format($total_tax, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Total per passenger</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $total_per_passenger = (float)$outbound->fare->total_per_passenger + (float)$inbound->fare->total_per_passenger;

                                        echo number_format($total_per_passenger, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Number of passengers</th>
                                      <td>{{$passenger_num}}</td>
                                      
                                    </tr>
                                    
                                    <tr style="background-color: #f8f8f8;color: #000;">
                                      <th scope="row"><span>Grand total</span></th>
                                      <td>
                            @php
                            
                            echo number_format(((float)$outbound->trip_fare + (float)$outbound->trip_fare)*$passenger_num,2);
                            @endphp</td>
                                      
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        
                               </td>
                           </div>
                           </tr>
                          </tbody>
                        </table>

                        <hr>
                        <p><span style="color: #000;">Total fare: GH&#8373;
                            @php
                            
                            echo number_format(((float)$outbound->trip_fare + (float)$inbound->trip_fare)*$passenger_num,2);
                            @endphp
                            </span>
                            <br>
                            <span style="color: #777;font-family: Segoe UI; font-weight: 600;font-size: 13px;">Total price in Ghana cedis including road fare, taxes, fees and carrier-imposed charges for 
                            @if(!$passenger_num)
                            @else
                                @if($passenger_num > 1)
                                {{ $passenger_num }} passengers.
                                @else
                                {{ $passenger_num }} passenger.
                                @endif
                            @endif
                            Conditions apply.</span>
                            

                        </p>

                        <div>
                            <ul class="list-inline">
                                <li style="color: #000;font-size: 14px;font-family: Corbel;">Show fare breakdown (taxes and fees)</li>
                                <li class="float-right"><i class="fas fa-chevron-down logo-color" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                            </ul>
                            <div style="display: none;">
                                <p><span style="font-weight: 500;font-size: 14px;font-family: Corbel;">
                                @if(!$outbound->fare || !$inbound->fare)
                                <span style="font-size: 11px;font-family: Corbel;color: #ff3345;">There is no available information</span>
                                @else
                                All prices shown in GH&#8373;
                                @endif
                                </span></p>
                                <table class="table table-bordered">
                                  <thead style="background-color: #f8f8f8;">
                                    <tr>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Fare breakdown</span></th>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Adults</span></th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">Roadfare</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $road_fare = (float)$outbound->fare->road_fare + (float)$inbound->fare->road_fare;

                                        echo number_format($road_fare, 2);
                                        @endphp
                                        @endif
                                     </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Carrier-imposed charges</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $carrier_imposed_charges = (float)$outbound->fare->carrier_imposed_charges + (float)$inbound->fare->carrier_imposed_charges;

                                        echo number_format($carrier_imposed_charges, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Taxes, fees and charges</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $total_tax = (float)$outbound->fare->total_tax + (float)$inbound->fare->total_tax;

                                        echo number_format($total_tax, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Total per passenger</th>
                                      <td>
                                        @if(!$outbound->fare || !$inbound->fare)
                                        -
                                        @else
                                        @php

                                        $total_per_passenger = (float)$outbound->fare->total_per_passenger + (float)$inbound->fare->total_per_passenger;

                                        echo number_format($total_per_passenger, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Number of passengers</th>
                                      <td>{{$passenger_num}}</td>
                                      
                                    </tr>
                                    
                                    <tr style="background-color: #f8f8f8;color: #000;">
                                      <th scope="row"><span>Grand total</span></th>
                                      <td>
                            @php
                            
                            echo number_format(((float)$outbound->trip_fare + (float)$inbound->trip_fare)*(float)$passenger_num,2);
                            @endphp</td>
                                      
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            
                        </div>

                        <div>
                            <ul class="list-inline">
                                <li style="color: #000;font-size: 14px;font-family: Corbel;">Show taxes, fees and charges breakdown</li>
                                <li class="float-right"><i class="fas fa-chevron-down logo-color" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                                      '></i></li>
                            </ul>
                            <div style="display: none;">
                                <p><span style="font-weight: 500;font-size: 14px;font-family: Corbel;">
                                @if(!$outbound->tax || !$inbound->tax)
                                <span style="font-size: 11px;font-family: Corbel;color: #ff3345;">There is no available information</span>
                                @else
                                All prices shown in GH&#8373;
                                @endif
                                </span></p>
                                <table class="table table-bordered">
                                  <thead style="background-color: #f8f8f8;">
                                    <tr>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Taxes, fees and charges breakdown</span></th>
                                      <th scope="col"><span style="color: #000;font-size: 12px;">Adults</span></th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">Tax - NTA</th>
                                      <td>
                                        @if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php

                                        $tax_NTA = (float)$outbound->tax->tax_NTA + (float)$inbound->tax->tax_NTA;

                                        echo number_format($tax_NTA, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Passenger Service Charge</th>
                                      <td>@if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php

                                        $passenger_service_charge = (float)$outbound->tax->passenger_service_charge + (float)$inbound->tax->passenger_service_charge;

                                        echo number_format($passenger_service_charge, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Passenger Facilities Charge</th>
                                      <td>
                                        @if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php

                                        $passenger_facilities_charge = (float)$outbound->tax->passenger_facilities_charge + (float)$inbound->tax->passenger_facilites_charge;

                                        echo number_format($passenger_facilities_charge, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Advance Passenger Information Fee</th>
                                      <td>
                                        @if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php

                                        $advance_passenger_info_fee = (float)$outbound->tax->advance_passenger_info_fee + (float)$inbound->tax->advance_passenger_info_fee;

                                        echo number_format($advance_passenger_info_fee, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Station Service Charge</th>
                                      <td>
                                        @if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php

                                        $station_service_charge = (float)$outbound->tax->station_service_charge + (float)$inbound->tax->station_service_charge;

                                        echo number_format($station_service_charge, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Number of passengers</th>
                                      <td>
                                          @if(!$passenger_num)
                                          @else
                                          {{$passenger_num}}
                                          @endif
                                      </td>
                                      
                                    </tr>
                                    <tr style="background-color: #f8f8f8;color: #000;">
                                      <th scope="row"><span>Grand total</span></th>
                                      <td>
                                        @if(!$outbound->tax || !$inbound->tax)
                                        -
                                        @else
                                        @php
                                        
                                        echo number_format(((float)$outbound->tax->total + (float)$inbound->tax->total)*$passenger_num,2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                  </tbody>
                              </table>
                                
                            </div>
                            
                        </div>

                        <p>
                            <ul class="list-unstyled">
                                <li>
                            <ul class="list-inline">
                                <li style="color: #000;font-size: 14px;font-family: Corbel;">Fare conditions</li>
                                <li><i class="fas fa-info-circle logo-color"></i></li>
                            </ul>
                        </li>
                        <li style="font-size: 14px;font-family: Corbel;">
                            <ul style="margin-left: -7%;">
                                <li>Note: Upgrade prices and seat selection are only applicable to 10ondrives-operated flights.</li>
                                <li><span style="font-weight: 600;">Important:</span> Change fees will be charged in addition to any applicable fare difference.
The amounts quoted for refunds, change fees, Kilometers earned, and upgrades are per person. Upgrades with Kilometers are subject to availability.</li>
                            </ul>
                            </li>
                        </ul>
                        </p>

                        <button class="col-md-12 btn btn-lg" type="submit" style="background-color: #ff3345;">
                            <center style="color: #fff;font-size: 15px;font-weight: 700">GH&#8373;
                            @php
                            
                            echo number_format(((float)$outbound->trip_fare + (float)$inbound->trip_fare)*$passenger_num,2);
                            @endphp
                            <br>
                            Select these drives</center>
                        </button>
                        <br>
                
             </div>
            </div>
            <br>
           <center> <a href="{{URL::to('pdf/Standard Hubtel POS Verification Request.pdf')}}"><i class="fas fa-download"></i> Download receipt</a>
           </center>
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
                    <a href="{{route('return.payment.success.auth', ['booking_id' => $booking_id, 'lpos' => $outbound, 'lpis' => $inbound, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => $payment_id, 'option' => $option])}}"  style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px;color: #FFF;"><div type="button" class="btn btn-success">Login</div></a>

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
            $(document).ready(function() {
                var session_status = '{{$passenger_details}}';
                if (session_status == 'session expired')
                {
                    $('#login-modal').modal({backdrop: 'static', keyboard: false});
                    $('#login-modal').modal('show');

                }
            });
            $('#ow_contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#ow_title').val() + ' ' + $('input[name="ow_first_name"]').val() + ' ' + $('input[name="ow_last_name"]').val(); 
                this.options.add(c, 2);
            });
        </script>
    </body>
</html>

