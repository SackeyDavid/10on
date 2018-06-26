<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Myaccount | Home</title>

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
                right: 35%;
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
                    <li><span class="top-center" style="margin-top: -2%;">My Account</span></li>
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
            <div id="mySidenav" class="sidenav" style="background-image: url('images/3.jpg');opacity: 0.;">
                <a href="javascript:void(0)" style="font-size: 25px;font-weight: 900;color: #fff;" class="closebtn top-right" onclick="
                document.getElementById('mySidenav').style.width = '0';">&times;</a>
                <div class="col-md-12" style="color: #fff;font-weight: 700;font-size: 20px;">
                    <hr> <a href="{{ route('my.trips.oneway') }}" style="color: #fff;cursor: pointer;">
                    My Trips <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                     <a href="{{ route('oneway.drive.status') }}" style="color: #fff;cursor: pointer;">
                    Drive Status </a> <br>
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

            

        </div>
        <hr style="margin-bottom: 0%;">
        <div style="margin: 0%;height: 36vh;background-image: url('images/korean_city.png');font-weight: 400;">
            <div class="col-md-12" style="color: #fff;font-weight: 600">
                <br><br><br>
                Access a host of exclusive benefits and privileges as a member of 10ondrives and experience the full features of the app
            </div>
            <center>
                <ul class="list-inline" style="border-radius: 1px;padding: 4%;">
                    <li>
                        @if(Auth::user())
                        <a href="{{route('client.dashboard') }}" class="btn" style="background-color: #777;color: #fff;">Client</a>
                        @else
                        <a href="/register" class="btn" style="background-color: #ff3345;color: #fff;">Join now</a>
                        @endif
                    </li>
                   
                    <li><button class="btn" style="background-color: #ff3345;"><a href="{{ route('search.trips')}}" style="color: #fff;"> Book drive</a></button></li>
                    
                </ul>
            </center>
            
            </div>
            <ul class="list-group" >
                <li class="list-group-item" style="border-radius: 1px;font-weight: 400;">
                    <ul class="list-inline"> 
                        <li>About 10ndrives</li>
                        <li class="float-right"><i class="fas fa-chevron-down"></i></li>
                    </ul>
                </li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;">
                    <ul class="list-inline"> 
                        <li>About trips</li>
                        <li class="float-right"><i class="fas fa-chevron-down"></i></li>
                    </ul>
                </li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;background-color: #FFFF99;">My statement</li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;background-color: #FFFF99;">My personal details</li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;background-color: #FFFF99;">My contact details</li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;background-color: #FFFF99;">My preferences</li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;background-color: #FFFF99;">My friends & Family</li>
                <li class="list-group-item"  style="border-radius: 1px;font-weight: 400;"> 
                    <ul class="list-inline"> 
                        <li>My app settings</li>
                        <li class="float-right"><i class="fas fa-chevron-down"></i></li>
                    </ul>
                </li>
            </ul>
            <br>


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
