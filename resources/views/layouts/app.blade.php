<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>10ondrives</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::To('images/logo-big.jpg') }}" type="image/jpg" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ URL::To('css/intlTelInput.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> -->
   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/search-trips.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/material-icons.css') }}">
    <style type="text/css">
        .footer-styles {
                color: #ccc; font-weight: 400; opacity: 0.5;
            }
    </style>
</head>
<body style="background-color: #fff;width: 100%;">
    <div id="app">
        <nav  class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo-big.jpg" height="50px" width="50px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="background-color: #fafafa">
                        <!-- Authentication Links -->
                        @guest
                            <li><center><a style="font-weight: 200;color: #000;" class="nav-link" href="{{ route('login') }}">Login</a></center></li>
                            <li><center><a style="font-weight: 200;color: #000;" class="nav-link" href="{{ route('register') }}">Register</a></center></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
     <!-- <div style="height: 40%; width: 100%; background-color: #333333;">
                    <div class="col-md-12">
                        <br>
                       <span class="footer-heads">Site tools</span> 
                       
                       <ul class="list-inline" class="footer-styles" >
                           <li>Book a bus</li>
                           <li>Manage a booking</li>
                       </ul>
                       
                       <ul class="list-inline" class="footer-styles" >
                           <li>Online Check-in</li>
                           <li>Country</li>
                       </ul>
                       <span class="footer-styles">Full website</span>
                       <br>
                       <ul class="list-inline" class="footer-styles">
                           <li>Home</li>
                           <li>Contact us</li>
                           <li>Privacy policy</li>

                       </ul>
                       <span class="footer-styles">Terms and conditions</span>
                       <br>
                       <br>
                       <span class="footer-heads" style="font-family: cursive;">© 10ondrives, Inc. All rights reserved</span>
                    </div>
                     </div> -->
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="/js/script.js"></script>
    <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
    

    <script type="text/javascript">
            $('#contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#title').val() + ' ' + $('input[name="first_name"]').val() + ' ' + $('input[name="last_name"]').val(); 
                this.options.add(c, 2);
            });

            $("#mobile_number").intlTelInput({
              preferredCountries: ["gh", "ke", "ng", "tg", "ci", "bf", "us", "gb"],
              nationalMode: true,
              utilsScript: "js/utils.js"
            });

            

            $("#register-submit").click(function(){
              $("#mobile_number").val($("#mobile_number").intlTelInput("getNumber"));
              document.forms[0].submit();
            });

            
    </script>

</body>
</html>
