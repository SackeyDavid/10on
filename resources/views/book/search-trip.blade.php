<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Plan and book | 10ondrives</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/search-trips.css') }}">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 700;
                height: 100vh;
                margin: 0%;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                left: -1%;
                margin-top: -4%;
            }

            .top-center {
                font-size: 18px;
                position: absolute;
                right: 37%;
                
            } 

            .links > a {
                color: #ff3345;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                /*text-transform: lowercase;*/
            }

            a {
                color: #777;
            }
            
        </style>

        
    </head>
    <body>
        
        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="padding-bottom: 2%;">
                    <li><span class="top-center" style="margin-top: 0%;">Seach drives</span></li>
                    <li><span class="top-right links"><a href="#"> Options </a></span></li>
                    <li><span class="top-left links"><a href="javascript:history.back()"> <i class="fas fa-arrow-left" style="font-size: 15px; margin-top: 30%;"></i> </a></span></li>
                </ul> 
            </div>

        </div>
        <hr>

        <div class="col-md-12" style="margin-bottom: -6%;">
            <div class="tab-heading"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                      
                      <li class="nav-item active">
                        <a href="#returnTab" data-toggle="tab">Return</a>
                      </li>
                      <li class="nav-item">
                        <a href="#onewayTab" data-toggle="tab">One Way</a>
                      </li>
                      <li class="nav-item">
                        <a href="#multicityTab" data-toggle="tab">Multicity</a>
                      </li>
                    </ul>

                    

            </div>

        </div>
        <hr>

                            <!-- Tab panes -->
<div class="tab-content">
                            <!-- Return trips -->
    @component('book.components.returnTab')
    @endcomponent
                            <!-- onewayTab -->
    @component('book.components.onewayTab')
    @endcomponent
                           <!-- multicityTab -->
    @component('book.components.multicityTab')
    @endcomponent
</div>

                    <div style="height: 40%; width: 100%; background-color: #333333;">
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
                     </div>

        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
        <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
        <script src="{{ asset('js/handlebars.js') }}"></script>
        
        <script>
            $('#departure_station').focus(function(){
                //open bootsrap modal
                $('#searchstation').modal('show');
                $('.custom-templates .typeahead').focus();
            });

            $('#arrival_station').focus(function(){
                //open bootsrap modal
                $('#search-arrival-station').modal('show');
                $('.custom-templates .typeahead').focus();
            });


            jQuery(document).ready(function($) {

            var path = "{{ route('search.trips.autocomplete') }}";

            var stations = new Bloodhound({
                prefetch: path, //very important for fetching array data
                remote: {
                    url: path 
                    // wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                identify: function(obj) { return obj.name; },

            });

            

            stations.initialize();

            function stationsWithDefaults(q, sync) {
              if (q === '') {
                sync(stations.get('Neoplan Station', 'Tema Station', 'Kaneshie'));
              }

              else {
                stations.search(q, sync);
              }
            }


            $('.custom-templates .typeahead').typeahead( {
                // hint: true,
                // highlight: true,
                // minLength: 1

                // source: function (query, process) {
                //     return $.get(path, { query: query }, function (data) {
                //         return process(data);
                //     });
                // }
            }, {
                source: stations,

                name: 'stationList',

                display: 'name',

                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ].join('\n'),
                    suggestion: function (data) {

                    
                       return '<div class="col-md-12" style="width: 26em;background-color: #fafafa;"><ul style="" class="list-unstyled"> <li><ul class="list-inline"> <li><i class="fas fa-map-marker-alt"></i><strong> '+ data.name +',</strong> '+ data.town_or_city +'</li><li class="pull-right"><span style="padding: 1%;background-color: cyan;">'+ data.abbreviation + '</span></li></ul></li><li><span>'+ data.region +'</span></li>                             </ul></div>';
                         
                    }
                     
                    
                        
                    }
                
                }
                
                
            );

            
            });

            $('#search_departure_station').keyup(function() {
              $search_value = $('#search_departure_station').val();

            if($search_value != "")
               {
                $('#departure-submit').css('background-color', '#ff3345');
               }  
           });

            $('#search_arrival_station').keyup(function() {
              $search_value_2 = $('#search_arrival_station').val();

            if($search_value_2 != "")
               {
                $('#arrival-submit').css('background-color', '#ff3345');
               }  
           });

            

           $('#departure-submit').on('click', function() {
                

            $('#departure_station').val($('#search_departure_station').val());

            $('#searchstation').modal('hide');

           }); 

           $('#arrival-submit').on('click', function() {
                

            $('#arrival_station').val($('#search_arrival_station').val());

            $('#search-arrival-station').modal('hide');

           }); 


            $('#passenger_num_plus').on('click',function(){
                var $qty= $('#passenger_num');
                var currentVal = parseInt($qty.val());
                if (!isNaN(currentVal)) {
                    $qty.val(currentVal + 1);
                    if($qty.val() == 1){
                     $('#passenger_label').text('passenger');   
                    }
                    else if ($qty.val() > 1) {
                     $('#passenger_label').text('passengers');   
                    }
                    
                }
            });
            $('#passenger_num_minus').on('click',function(){
                var $qty=$('#passenger_num');
                var currentVal = parseInt($qty.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    $qty.val(currentVal - 1);
                    if($qty.val() == 1){
                     $('#passenger_label').text('passenger');   
                    }
                    else if ($qty.val() > 1) {
                     $('#passenger_label').text('passengers');   
                    }
                }
            });


           // $('#passenger_num_plus').on('click', function() {
                

           //  $('#passenger_num').val('2 passengers');
           var departDate = "";

           var returnDate = "";

           var depart_day = "";

           var return_day = "";

           // }); 

            $(function() {
            $('.input-daterange').datepicker({
                format: "dd MM",
                startDate: new Date(),
                maxViewMode: 2,
                onSelect: function(dateText, inst) {
                    $('#to').focus();
                }
            }).on('changeDate', function(e) {
                    var start = $('#from').datepicker('getDate');
                    var end   = $('#to').datepicker('getDate');
                    if (start && end) {
                    var diff = Math.floor((end.getTime() - start.getTime()) / 86400000); 


                    departDate = $('#from').val();
                    var depart_dateElement = departDate.split(" ");

                    //var returnDate = dateElement[0] + '-' + dateElement[1] + '-' + '2018';

                    returnDate = $('#to').val();
                    //var date = new Date(dateFormat); //To avoid timezone issues

                    var return_dateElement = returnDate.split(" ");

                    //get weekday from datepicker input
                    var weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                    depart_day = weekday[start.getDay()];
                    return_day = weekday[end.getDay()];

                    //display chosen date on travel dates tabs
                    $('#depart_tab span').text(depart_dateElement[0]);
                    $('#depart_day span').text(depart_day);
                    $('#depart_month span').text(depart_dateElement[1]);

                    $('#return_tab span').text(return_dateElement[0]);
                    $('#return_day span').text(return_day);
                    $('#return_month span').text(return_dateElement[1]);
                    
                }

                if(diff == 0)
                {
                  $('#trip-duration span').text('Returning the same day');  
                }
                else if(diff == 1)
                {
                  $('#trip-duration span').text(diff+ ' day');  
                }
                else{
                   $('#trip-duration span').text(diff+ ' Days'); 
                }
                     // doesn't seem to have any effect
                    $value = $('#to').val();
                    $value2 = $('#from2').val();
               if($value != "")
               {
                
                $('#resultsBtn').css('background-color', '#ff3345');

               }
                   if($value2 != "")
                   {
                    $('#resultsBtn2').css('background-color', '#ff3345');

                   }
            });

            });

            
            $('#to').focus(function(){
                $(this).css('border-color', '#ccc');
                $('#return_tab').css('border-bottom', '4px solid #ff3345');
                $('#depart_tab').css('border-bottom', 'none');
            }); 
            
            $('#from').focus(function(){
                $(this).css('border-color', '#ccc');
                $('#depart_tab').css('border-bottom', '4px solid #ff3345');
                $('#return_tab').css('border-bottom', 'none');
            });

            $('#resultsBtn').click(function() {
                $('#from').val(depart_day + ' ' + departDate);
                $('#to').val(return_day + ' ' + returnDate);
                document.forms[0].submit();
            })
            // $('.input-daterange').on('changeDate', function() {
            // $('#my_hidden_input').val(
            //     $('.input-daterange').datepicker('getFormattedDate')
            //     );
            // });

            // $('.input-daterange input').each(function() {
            //     $(this).datepicker('clearDates');
            // });

            
        </script>
    </body>
</html>
