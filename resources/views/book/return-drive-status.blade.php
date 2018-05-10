<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Drive Status | Return Trip</title>

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
                    My Trips <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                    <a href="{{ route('return.drive.status', ['booking_id' => $booking->id]) }}" style="color: #fff;cursor: pointer;">
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
                    </div>
                </div>
            </div>
           <br><br> 
           <div class="col-md-12">
            <div class="card card-default" style="font-weight: 400;">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item"><span style="font-family: Arial;">Booking(RT-{{$booking->id}}) on <span style="font-size: 12px;font-family: Arial;">{{$date[0]}} at {{$date[1]}}</span></span></li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;" class="fas fa-chevron-down" onclick='
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
                        <td>{{$booking->created_at->diffForHumans()}}</td>
                        <td>{{$days_left_to_departure}} left</td>
                    </tr>
                </tbody>
            </table>
                    </div>
                    <br><br>
                    <div class="card-header" style="background-color: #7FFFD4;">
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
                        <td>{{$booking->created_at->diffForHumans()}}</td>
                        <td>{{$days_left_to_arrival}} left</td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
            </div>
            
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
                    <a href="{{route('auth.return.drive.status', ['booking_id' => $booking->id])}}" onclick="sessionExpiredRedirect()" type="button" class="btn btn-success" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Login</a>

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
                // var session_status = '';
                // if (session_status == 'session expired')
                // {
                //     $('#login-modal').modal({backdrop: 'static', keyboard: false});
                //     $('#login-modal').modal('show');

                // }
            });

            $('#ow_contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#ow_title').val() + ' ' + $('input[name="ow_first_name"]').val() + ' ' + $('input[name="ow_last_name"]').val(); 
                this.options.add(c, 2);
            });

            
        </script>
        
        
           

    </body>
</html>
