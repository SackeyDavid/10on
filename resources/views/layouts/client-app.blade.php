<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 
        @guest
        Client Login | 10ondrive
        @else
        {{ Auth::user()->username }} Dashboard | 10ondrives
        @endguest
    </title>

    <!-- Styles -->
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

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::To('img/logo-big.png') }}" type="image/jpg" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client-dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client-app.css') }}">

    
</head>
<body style="background-color: #f5f8fa;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- <img src="/images/IMG-20180322-WA0015.jpg" height="50px" width="120px"> -->
                    10ondrives
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('client.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="/js/script.js"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <!-- <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/typeahead.js') }}"></script> -->

    <script type="text/javascript">
    
        $depart_day = "";

        $depart_date = "";

        $return_day = "";

        $return_date = "";

        
     
    $('.clockpicker').clockpicker({
        donetext: 'Done',
        twelvehour: true,
        autoclose:  true
    });

    function calculateTime() {
            //get values
            var valuestart = $("input[name='departure_time']").val();
            var valuestop = $("input[name='arrival_time']").val();
              
             //create date format          
             var timeStart = new Date("01/01/2007 " + valuestart).getHours();
             var timeEnd = new Date("01/01/2007 " + valuestop).getHours();
             
             var hourDiff = timeEnd - timeStart; 

            var startTime=moment(valuestart, "HH:mm a");
            var endTime=moment(valuestop, "HH:mm a");
            var duration = moment.duration(endTime.diff(startTime));
            //var hours = parseInt(duration.asHours());
            //var minutes = parseInt(duration.asMinutes())-hours*60;
            // alert (hours + ' hour and '+ minutes+' minutes.');  
            var minutes = moment.utc(moment(endTime, "HH:mm").diff(moment(startTime, "HH:mm"))).format("mm")

            var hours = endTime.diff(startTime, 'hours') + " hrs and " + minutes + " mins";


             // $("p").html("<b>Hour Difference:</b> " + hourDiff ) 
             if(valuestop != "")
             { 
                $("input[name='trip_duration_in_hrs']").val(hours);//does not calculate correctly with an end time at 12 pm

             }           
             
    }
    $(".clockpicker").change(calculateTime);
    calculateTime();

    

    
    $('.input-daterange').datepicker({
        format: "dd MM",
        startDate: new Date(),
        maxViewMode: 2
    }).on('changeDate', function(e) {
            var start = $('input[name ="departure_date"]').datepicker('getDate');;
            var end   = $('input[name ="arrival_date"]').datepicker('getDate');
            var weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

            if (start) {
            //var diff = Math.floor((end.getTime() - start.getTime()) / 86400000); 
            
                depart_day = weekday[start.getDay()];
                depart_date = $('input[name ="departure_date"]').val();
        }   
            if (end) {
            //var diff = Math.floor((end.getTime() - start.getTime()) / 86400000); 
            
                return_day = weekday[end.getDay()];
                return_date = $('input[name ="arrival_date"]').val();
        }
            
        
            //$('#trip_duration input').val(diff +' days'); 
    });

     
      $('input[name ="departure_time"]').focus(function() {
        $('input[name ="departure_date"]').val( depart_day+ ' ' + depart_date);
        $('input[name ="arrival_date"]').val( return_day+ ' ' + return_date);
      }); 
     
     

    

    $("select[name='trip_cost_id']").change(function(){
       var trip_cost = $("#trip_cost_id").val();
       $("input[name='trip_cost']").val(trip_cost); 

    });

    var path = "{{ route('search.trips.autocomplete') }}";
    // $('input').tagsinput({
    //   typeahead: {
    //     source: function (query, process) {
    //                 return $.get(path, { query: query }, function (data) {
    //                     return process(data);
    //                 });
    //             }
    //   }
    // });

    

    $('#fare_btn_submit').click(function(){
        // this.value = parseFloat(this.value).toFixed(2);
        $('input[name="total_per_passenger"]').val(parseFloat($("input[name='road_fare']").val()) + parseFloat($("input[name='carrier_imposed_charges']").val()) + parseFloat($("input[name='total_tax']").val())).toFixed(2); 

        if ($('input[name="total_per_passenger"]').val() == "") {
            @guest
            @else
            alert('Sorry '+{{Auth::user()->username}}+ ', you provided no fare breakdown');
            @endguest
        
        }
        else {
            @if(!Auth::user())
            @else
            document.forms[{{$ones_fares->count()}}+3].submit();
            @endif
        }
    });

    $('#tax_btn_submit').click(function(){
        // this.value = parseFloat(this.value).toFixed(2);
        $('input[name="total"]').val(parseFloat($("input[name='tax_NTA']").val()) + parseFloat($("input[name='passenger_service_charge']").val()) + parseFloat($("input[name='passenger_facilities_charge']").val()) + parseFloat($("input[name='advance_passenger_info_fee']").val()) + parseFloat($("input[name='station_service_charge']").val())).toFixed(2); 

        if ($('input[name="total"]').val() == "") {
            
            
            @guest
            @else
            alert('Sorry '+{{Auth::user()->username}}+ ', you provided no tax breakdown');
            @endguest
            
        }
        else {
            @if(!Auth::user())
            @else
            document.forms[{{$ones_fares->count()}}+6+{{$ones_taxes->count()}}].submit();
            @endif
        }
    });
    // for taxes
    $('#tax_trip_id').focus(function(){
        var text = $("#tax_trip_id option:selected").text();
        var textFormat = text.split(" ");
        var cost = textFormat[textFormat.length - 1];
        $('input[name="total"]').val(cost);

    });

    $('#tax_trip_id').change(function(){
        var text = $("#tax_trip_id option:selected").text();
        var textFormat = text.split(" ");
        var cost = textFormat[textFormat.length - 1];
        $('input[name="total"]').val(cost);

    });

    // for fares
    $('#fare_trip_id').focus(function(){
        var text = $("#fare_trip_id option:selected").text();
        var textFormat = text.split(" ");
        var cost = textFormat[textFormat.length - 1];
        $('input[name="total_per_passenger"]').val(cost);

    });

    $('#fare_trip_id').change(function(){
        var text = $("#fare_trip_id option:selected").text();
        var textFormat = text.split(" ");
        var cost = textFormat[textFormat.length - 1];
        $('input[name="total_per_passenger"]').val(cost);

    });



    </script>
</body>
</html>
