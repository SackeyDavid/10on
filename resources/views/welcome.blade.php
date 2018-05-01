<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>10ondrives</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <!-- styles -->
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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                /*height: 100vh;*/
                margin: 0;
            }

            .full-height {
                height: 9999;

            }

            .flex-center {
                align-items: center;
                display: flex;
                /*justify-content: center;*/
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
                margin-top: 6%;
                
            }

            @media (max-width: 600px)
            {
                .content {
                    margin-top: 40%;
                }
            }

            .title {
                font-size: 25px;
                
                font-weight: 600;
                padding-left: 2%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                color: #ff3345;
                font-weight: 600;
            }

            .d-b-md {
                color: #484848;
                font-weight: 600;
            }
           

            .img-explore {
                height: 15vh;
                width: 100%;
                border-bottom: 2px solid #484848;
            }


        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="col-md-12 content">
                <h3 class="margin  m-b-md">
                    <!-- <img src="/images/IMG-20180322-WA0015.jpg" height="100px" width="250px"><br> -->
                10ondrives</h3>
                @php
                echo phpinfo();
                @endphp
                <span class="brand-name">Book trips all over Ghana.</span>
                <br><br>
                <ul class="nav nav-tabs justify-content  margin" style="border-bottom: none;">
                    <li><a href="{{ route('search.trips') }}" style="font-weight: 600;color: #484848;"><i class="fa fa-bus"></i><strong> Book a drive</strong></a></li>
                    <li><a href="#manage-bookingTab" style="color: #484848;"><i class="fa fa-tag"></i><strong>  Booking </strong></a></li>
                    <li><a href="#whats-on-busTab" style="color: #484848;"><i class="fas fa-wifi"></i> <strong> Your bus</strong></a></li>
                    <li><a href="#flight-status" style="color: #484848;"><i class="fa fa-clock"></i><strong> Drive status </strong></a></li>
                </ul>
                <br>
                <div class="tab-content margin">
                    <div class="well tab-pane active" id="search-busTab">
                       <form role="form" method="GET"  action="" class="navbar-form"> <br>

                        <div class="input-group" style="margin-top: 1%;">

                        <ul class="list-inline">
                            <div class="col-md-12">
                            <li><input type="text" id="search-input" name="departure_location" data-provide="typeahead"  autocomplete="off" class="typeahead form-control welcome-search-bar" placeholder="Departure Station"></li>

                            <li> <input type="text" id="search-input" name="arrival_location" data-provide="typeahead"  autocomplete="off" class="typeahead form-control welcome-search-bar" placeholder="Arrival Station"></li>

                            <li> <button type="submit" class="btn btn-lg btn-warning" style=" height: 8vh;">continue</button></li>
                            </div>
                        </ul>
                        

                       
                        </div>
                        </form> 
                    </div>

                    <div class="well tab-pane" id="manage-bookingTab">
                    
                    </div>

                    <div class="well tab-pane" id="whats-on-busTab">
                        
                    </div>

                    <div class="well tab-pane" id="flight-status">
                        
                    </div>
                </div>
                


          		<br><br><br>
          		<h3 class="d-b-md margin">Explore 10ondrives</h3>
                <!-- this view holds horizontal items -->
                <div class="surround">
                <div class="surround-container margin">
                    <!-- <div class="zerogrid"> -->
                <!-- <div class="row wrap-box"><!--Start Box--> 
                    <div class="hpage col-1-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/2.jpg" class="img-explore">
                                <h5>Stations</h5>
                                <!-- <div class="upload">
                                    <p>April 14, 2015</p>
                                    <p>Uploaded by <a href="#">John Doe</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="hpage col-1-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/3.jpg" class="img-explore">
                                <h5>Cities</h5>
                                <!-- <div class="upload">
                                    <p>April 14, 2015</p>
                                    <p>Uploaded by <a href="#">John Doe</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="hpage col-1-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/4.jpg" class="img-explore">
                                <h5>Experiences</h5>
                                <!-- <div class="upload">
                                    <p>April 14, 2015</p>
                                    <p>Uploaded by <a href="#">John Doe</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="hpage col-1-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/5.jpg" class="img-explore">
                                <h5>Tourist Sites</h5>
                                <!-- <div class="upload">
                                    <p>April 14, 2015</p>
                                    <p>Uploaded by <a href="#">John Doe</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                

                

                <!-- <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> -->
                <br><br><br>
                <h3 class="d-b-md margin">Explore Cities</h3>
                

            </div>


                
            
        </div>
        <div class="container">
            
                    <div class="hpage vpage col-md-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/2.jpg" class="img-explore">
                                <span>
                                <span class="region" style="color: #faf25f;">Greater Accra</span>
                                <div class="upload">
                                    <strong class="cities">Accra</strong><br>
                                    <span class="amount">GH&#8373; 10.00*</span>
                                    <p class="ratings"><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 678 &#183; Majorcity</a></p>
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hpage vpage col-md-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/3.jpg" class="img-explore">
                                <span>
                                <span class="region">Central</span>
                                <div class="upload">
                                    <strong class="cities">Cape Coast</strong><br>
                                    <span class="amount">GH&#8373; 20.00*</span>
                                    <p class="ratings"><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 522 &#183; Majorcity</a></p>
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hpage vpage col-md-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/4.jpg" class="img-explore">
                                <span>
                                <span class="region" style="color: #008489;">Ashanti</span>
                                <div class="upload">
                                    <strong class="cities">Kumasi</strong><br>
                                    <span class="amount">GH&#8373; 50.00*</span>
                                    <p class="ratings"><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 808 &#183; Majorcity</a></p>
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hpage vpage col-md-3">
                        <div class="wrap-col">
                            <div class="post">
                                <img src="images/2.jpg" class="img-explore">
                                <span>
                                <span class="region" style="color: #faf25f;">Western</span>
                                <div class="upload">
                                    <strong class="cities">Axim</strong><br>
                                    <span class="amount">GH&#8373; 150.00*</span>
                                    <p class="ratings"><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 378 &#183; </a></p>
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-lg btn-default show-all">Show all (222+)</button>
                    </center>

                    <br><br>
                <h3 class="d-b-md margin">Explore Stations</h3>
        </div>

        

        <div class="footer">
                <hr>
                © 10ondrives, Inc. <br>
                <ul class="list-inline">
                    <li>Terms</li>
                    <li>Privacy</li>
                    <li>Site Map</li>
                    <li><i class="fab fa-facebook-square"></i></li>
                    <li><i class="fab fa-twitter"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                </ul>
        </div>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    </body>
</html>
