<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Online bus booking system in Ghana">
        <meta name="author" content="10ondrives">
        <meta name="keyword" content="Bus, Online, Book, Ghana, 10ondrives, Transport">

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

        <script>
            window.Laravel = {
                csrfToken: '{{csrf_token()}}'
            }
        </script>

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
                    <!-- <li><span class="top-right links"><a href="#"> Options </a></span></li> -->
                    <li><span class="top-left links"><a href="javascript:history.back()"> <i class="fas fa-arrow-left" style="font-size: 15px; margin-top: 30%;"></i> </a></span></li>
                </ul> 
            </div>

        </div>
        <hr>

        <div class="col-md-12" style="margin-bottom: -6%;">
            <div class="tab-heading"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                      
                      <li class="nav-item">
                        <a href="#returnTab" data-toggle="tab">Return</a>
                      </li>
                      <li class="nav-item active">
                        <a href="#onewayTab" data-toggle="tab">One Way</a>
                      </li>
                      <li class="nav-item">
                        <a href="#multicityTab" data-toggle="tab">Multicity</a>
                      </li>
                    </ul>

                    

            </div>

        </div>
        <hr>
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}</center></p>
            </div>
            @endif
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

        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
      
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
        <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
        <script src="{{ asset('js/handlebars.js') }}"></script>

        
        
        <script>
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            

            $('body').on('click', '#oneway-search', function(){
              // alert('Hi');
               $value = $('#ow_search_arrival_station').val(); // arrival station

               $departure_station = $('input[name="ow_departure_station"]').val();
               $date = $('input[name="ow_date"]').val();
               $passenger_num = $('input[name="ow_passenger_num"]').val();
               
                $.ajax({
                    type : 'GET',
                    url  : '{{ route('trips.search') }}',
                    data : {'ow_arrival_station': $value, 'ow_departure_station': $departure_station,'ow_date': $date, 'ow_passenger_num': $passenger_num},
                    success:function(data){
                        /*console.log(data);*/
                        if($value != ""){
                              $('.results').html(data);
                          }
                        else
                        {
                            $('.results').html('');
                        }
                    }
                }); 

                });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                //console.log($(this).attr('href').split('page='));
                var page = $(this).attr('href').split('page=')[1];
                getTrip(page, $('#search_arrival_station').val(), $('input[name="ow_departure_station"]').val(), $('input[name="ow_date"]').val(), $('input[name="ow_passenger_num"]').val());
            })
            function getTrip(page, ow_arrival_station, ow_departure_station, ow_date, ow_passenger_num)
            {

                var url = "{{ route('trips.search') }}";

                $.ajax({
                    type : 'GET',
                    url  : url + '?page=' + page,
                    data : {'ow_arrival_station': $value, 'ow_departure_station': $departure_station,'ow_date': $date, 'ow_passenger_num': $passenger_num},
                }).done(function(data) {
                    $('.results').html(data);
                })
            }

            // (function() {
            //   var foo = document.getElementById("foo");
            //   foo.addEventListener("click", function() {
            //     display("Clicked");
            //   }, false);
            //   setTimeout(function() {
            //     display("Artificial click:");
            //     foo.click(); // <==================== The artificial click
            //   }, 500);
            //   function display(msg) {
            //     var p = document.createElement('p');
            //     p.innerHTML = String(msg);
            //     document.body.appendChild(p);
            //   }
            // })();

            $('#departure_station').focus(function(){
                //open bootsrap modal
                $('#searchstation').modal('show');
                $('.custom-templates .typeahead').focus();
            });

            $('#ow_departure_station').focus(function(){
                //open bootsrap modal
                $('#ow_searchstation').modal('show');
                $('.custom-templates .typeahead').focus();
            });


            $('#arrival_station').focus(function(){
                //open bootsrap modal
                $('#search-arrival-station').modal('show');
                $('.custom-templates .typeahead').focus();
            });

            $('#ow_arrival_station').focus(function(){
                //open bootsrap modal
                $('#ow_search_results').modal('show');
                $('.custom-templates .typeahead').focus();
            });

            $('#select-oneway-date').click(function(){
                //open bootsrap modal
                $('#selectDates2').modal('show');
                $('input-daterange #from2').focus();
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
                 minLength: 0

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

                    
                       return '<div id="typeahead-result" class="col-md-12" style="width: 26em;background-color: #fafafa;"><ul style="" class="list-unstyled"> <li><ul class="list-inline"> <li><i class="fas fa-map-marker-alt"></i><strong> '+ data.name +',</strong> '+ data.town_or_city +'</li><li class="pull-right"><span style="padding: 1%;background-color: cyan;">'+ data.abbreviation + '</span></li></ul></li><li><span>'+ data.region +'</span></li>                             </ul></div>';
                         
                    }
                     
                    
                        
                    }
                
                }
                
                
            );

            
            });

            

            $('.custom-templates .typeahead').on('typeahead:selected', function(evt, item) {
                if ($('#searchstation').is(':visible')) {
                   $('#departure_station').val($('#search_departure_station').val());

                   $('#searchstation').modal('hide'); 

                   
                }
                else if ($('#search-arrival-station').is(':visible')) 
                {
                   $('#arrival_station').val($('#search_arrival_station').val());

                   $('#search-arrival-station').modal('hide');
                   
                }
                else if ($('#ow_searchstation').is(':visible')) 
                {
                   $('#ow_departure_station').val($('#ow_search_departure_station').val());

                   $('#ow_searchstation').modal('hide');
                }
                
                else if ($('#ow_search_results').is(':visible')) {
                   $('#oneway-results-modal-body').css('background-color', '#f8f8f8');
                   $('.well .tab-pane').css('background-color', '#f8f8f8');
                   $('#arrival-tabs .nav-tabs .active a').css('background-color', '#E61F1F');
                   $('#arrival-tabs .nav-tabs').css('background-color', '#ff3333');
                   document.getElementById("oneway-search").click();
                }

                

                 
            });

            

            $('#search_departure_station').keyup(function() {
              $search_value = $('#search_departure_station').val();

            if($search_value != "")
               {
                $('#departure-submit').css('background-color', '#ff3345');
               }  
           });

            
            $('#ow_search_departure_station').keyup(function() {
              $search_value = $('#ow_search_departure_station').val();

            if($search_value != "")
               {
                $('#ow_departure-submit').css('background-color', '#ff3345');
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

           $('#ow_departure-submit').on('click', function() {
                

            $('#ow_departure_station').val($('#ow_search_departure_station').val());

            $('#ow_searchstation').modal('hide');

           }); 

           $('#arrival-submit').on('click', function() {
                

            $('#arrival_station').val($('#search_arrival_station').val());

            $('#search-arrival-station').modal('hide');

           }); 


            $('#passenger_num_plus').on('click',function(){
                var $qty= $('#passenger_num');
                var currentVal = parseInt($qty.val());
                if (currentVal > 4) {
                  alert('maximum number of passengers reached')
                }
                if (!isNaN(currentVal) && currentVal <= 4) {
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

            $('#ow_passenger_num_plus').on('click',function(){
                var $qty= $('#ow_passenger_num');
                var currentVal = parseInt($qty.val());
                if (currentVal > 4) {
                  alert('maximum number of passengers reached')
                }
                if (!isNaN(currentVal) && currentVal <= 4) {
                    $qty.val(currentVal + 1);
                    if($qty.val() == 1){
                     $('#ow_passenger_label').text('passenger');   
                    }
                    else if ($qty.val() > 1) {
                     $('#ow_passenger_label').text('passengers');   
                    }
                    
                }
            });
            $('#ow_passenger_num_minus').on('click',function(){
                var $qty=$('#ow_passenger_num');
                var currentVal = parseInt($qty.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    $qty.val(currentVal - 1);
                    if($qty.val() == 1){
                     $('#ow_passenger_label').text('passenger');   
                    }
                    else if ($qty.val() > 1) {
                     $('#ow_passenger_label').text('passengers');   
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
                // startDate: new Date(),
                maxViewMode: 2,
                autoclose: true,
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
                    // $value2 = $('#from2').val();

               if($value != "")
               {
                
                $('#resultsBtn').css('background-color', '#ff3345');

               }
                   // if($value2 != "")
                   // {
                   //  $('#resultsBtn2').css('background-color', '#ff3345');

                   // }

                if ($('#selectDates2').is(':visible')) 
                {
                    var getdate = $('#from2').val();
                    var thedate = $('#from2').datepicker('getDate');
                    var getdateFormat = getdate.split(" ");
                    var weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                    $('#ow_day span').text(getdateFormat[0]);
                    $('#ow_mnt_year span').text(getdateFormat[1] + ' ' + thedate.getFullYear());
                    $('#week_day span').text(weekday[thedate.getDay()]);

                    $('input[name="ow_date"]').val(weekday[thedate.getDay()] + ' ' + getdateFormat[0] + ' ' + getdateFormat[1] + ' ' + thedate.getFullYear());

                    // for the arrival input modal
                    var toSplite = thedate.toDateString();
                    var splitedFormat = toSplite.split(" ");

                    $('#selected_day_tab span').text(splitedFormat[0] + ',' + splitedFormat[1] + ' ' +splitedFormat[2]);
                    var previous = new Date(thedate);

                    previous.setDate(thedate.getDate() - 1);
                    toSplite = previous.toDateString();
                    splitedFormat = toSplite.split(" ");
                    $('#previous_day_tab span').text(splitedFormat[1] + ' ' + splitedFormat[2]);

                    var next = new Date(thedate);
                    next.setDate(thedate.getDate() + 1);
                    toSplite = next.toDateString();
                    splitedFormat = toSplite.split(" ");
                    $('#next_day_tab span').text(splitedFormat[1] + ' ' + splitedFormat[2] );
                    
                    $('#selectDates2').modal('hide');

                }
            });

            });

            // ow stands for oneway and from2 is the name of the date input for the oneway tab

            

            
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
