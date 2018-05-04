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

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
        </style>
    </head>
    <body>
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
                    Drive Status <br>
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
                    @stack('open-login-modal')
                    @endif
                </span> <br>
                <span>Your booking has been <span style="font-weight: 800">submitted.</span> You will receive notification when check-in opens</span>
            </center>
            </div>
            
            <br>
            <div>
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
                        
                    <li style="margin-right: -10%;" class="pull-right"><i class="fas fa-chevron-down" onclick='

                        if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        ' 
                        style="color: #ff3345;font-size: 28px;font-weight: 600;cursor: pointer;"></i></li>
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
            </div>
            <br>
           <center> <a href="{{URL::to('pdf/Standard Hubtel POS Verification Request.pdf')}}"><i class="fas fa-download"></i> Download receipt</a>
           </center>
            </div>
            
            <br>
        <div class="modal" id="login-modal" tabindex="-1">
            <div class="modal-content">
                <div class="modal-dialog">
                    <div class="modal-header">
                        alfls;f
                    </div>
                    <div class="modal-body">
                            a;lfal;f
                    </div>
                    <div class="modal-footer">
                        al;;laf
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
        </script>
    </body>
</html>
@push('open-login-modal')
<script type="text/javascript">
    if (!Auth::user())
    {
        $('#login-modal').modal('show');
    }
</script>
@endpush