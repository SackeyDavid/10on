<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search Results</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/material-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/search-return-trips-results.css') }}">
        <!-- Styles -->
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

            .logo-color {
                color: #ff3345;
            }


        </style>
    </head>
    <body style="width: 100%;">
        <div class="col-md-12" style="background-color: #f9f9f9;padding: 0px;">
         <div class="col-md-12">
            <div>
                <ul class="list-inline" style="padding-bottom: 2%;">
                    <li><span class="top-center" style="margin-top: 0%;font-weight: 900;color: #000;">Seach results</span></li>
                    <!-- <li><span class="top-left links"><a href="javascript:history.back()"> <i class="fas fa-arrow-left" style="font-size: 15px; margin-top: 30%;"></i> </a></span></li> -->
                </ul> 
            </div>

        </div>
        <hr>

        <div class="col-md-12" style="background-color: #f9f9f9;">
            <ul class="list-unstyled">
                
                <li><ul class="list-inline">
                    <li style="font-weight: 900;color: #000;">Your search</li>
                    <li class="pull-right"><span><a style="color: #777;" href="javascript:history.back()"> Change search <i style="color: #ff3345;" class="fas fa-chevron-right"></i> </a></span>
                    </ul>
                </li>
                
                @if (!$passenger_num)
                @else
                <li>Return, {{$passenger_num}}
                    @if($passenger_num > 1)
                    passengers
                    @else
                    passenger
                    @endif
                </li>
                @endif

                @if (!$departure_location || !$arrival_location || !$departure_date || !$return_date || !$departure_abbreviation || !$arrival_abbreviation)
                @else
                <li>{{ $departure_location }} (<span style="font-size: 14px;color: #000;"><strong>{{ $departure_abbreviation }}</strong></span>) to {{ $arrival_location }} (<span style="font-size: 14px;color: #000;"><strong>{{ $arrival_abbreviation }}</strong></span>)</li>

                <li>{{ $departure_date }} to {{ $return_date }} </li>
                @endif
                
            </ul>

        </div>
        <hr>
    </div>

                            <!-- Tab panes -->
<div class="col-md-12" style="padding: 0px;">
    <h4 style="color: #000;font-weight: 900">&nbsp;&nbsp;&nbsp;Choose drives</h4>

    <center>
    <div class="input-group">
        <input id="filter_drives" placeholder="filter by drives" type="text" class="form-control" style="height: 6vh;color: #000;border: 1px solid #777;border-radius: 5px;">
        
    </div>
    
    </center>
    <br>
    <div class="col-md-12">
        <br>
        <div class="tab-heading">
        <table class="table table-bordered" style="border: 1px solid #000;">
             <thead>
               <tr>
                 <th>
                    <center>Sort by:</center>
                </th>

                 <th class="nav-item active">
                    <center><a style="text-decoration: none;" class="nav_item_anchor_tags" href="#lowestPriceTab" data-toggle="tab">Lowest <span class="nav_item_links">Price</span></a></center>
                </th>

                 <th class="nav-item">
                    <center>
                        <a style="text-decoration: none;" class="nav_item_anchor_tags" href="#earliestDepartureTab" data-toggle="tab">Earliest <span class="nav_item_links">Departure</span></a></center>
                </th>
                 <th class="nav-item">
                    <center><a style="text-decoration: none;" class="nav_item_anchor_tags" href="#shortestDurationTab" data-toggle="tab">Shortest <span class="nav_item_links">Duration</span></a></center>
                </th>
               </tr>
             </thead>
        </table>
        
        </div>
        <br>
        <div class="tab-content">
            <div class="well tab-pane active" id="lowestPriceTab">
            @if(!$LPDK || !$LPRK || !$lpos || !$lpis)
            no search result, <a style="color: #ff3345;" href="javascript:history.back()">please try searching again</a>
            @else
            @for($i = 0; $i < count($LPDK); $i++)
            @for($n = 0; $n < count($lpos); $n++)
                
                @if( $lpos[$n]->id == $LPDK[$i])
                    @for($m = 0; $m < count($lpis); $m++)
                        @if($lpis[$m]->id  != $LPRK[$i])
                        @continue
                        @endif
                @if(($lpos[$n]->remaining_seats - (int)$passenger_num) < 0 && ($lpis[$m]->remaining_seats - (int)$passenger_num) < 0 )
                @continue
                @else
                    
        <form id="form_{{ $lpos[$n]->id }}_{{ $lpis[$m]->id }}" method="POST" action="{{route('trip.search.found', ['lpos' => $lpos[$n]->id, 'lpis' => $lpis[$m]->id, 'passenger_num' => $passenger_num])}}">
                            {{ csrf_field() }} 
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <input type="hidden" name="outbound" value="{{ $lpos[$n]->id }}">
            <input type="hidden" name="inbound" value="{{ $lpis[$m]->id }}">

           
            <div class="card-body" style="border: 1px solid #ccc;">
                <div style="width: 90%;">

                <ul class="list-unstyled">
                    <li>
                        <ul class="list-inline">
                          <li>Depart: <span class="trip_details">{{ $lpos[$n]->departure_time }} - {{ $lpos[$n]->arrival_time }}</span></li>  
                          <li class="pull-right"><span class="trip_details">GH&#8373; 

                            <!-- display lowest price stored in combined cost using the LPDK and LPRK values -->
                            @php
                            
                            echo number_format((float)$combined_cost[$LPDK[$i] . '-' . $LPRK[$i]]*(float)$passenger_num,2);
                            @endphp
                          </span> </li>
                        </ul>
                    </li>
                    <li>
                    <ul class="list-inline">
                        
                    <li>Return: <span class="trip_details">{{ $lpis[$m]->departure_time }} - {{ $lpis[$m]->arrival_time }}</span><br></li>
                        
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
                            $out_duration =  $lpos[$n]->trip_duration_in_hrs ;
                            $in_duration =  $lpis[$m]->trip_duration_in_hrs ;
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
                             <span style="color: #777;font-size: 13px;font-weight: 600;"> via {{ $lpos[$n]->via }}</span>  </span></li>  
                          <li class="pull-right"><strong><span class="trip_host">{{ $lpos[$n]->host->username }} &nbsp;&nbsp;{{ $lpis[$m]->host->username }}</span></strong></li>
                        </ul>
                         
                    </li>
                    
                </ul>
                </div>

            <div style="display: none;">
                <p><i class="material-icons" style="font-size: 15px;color: #B0E0E6;">flight_takeoff</i> Outbound</p>
                <div class="card card-default">
                    @if (!$departure_location || !$arrival_location || !$combined_cost)
                    @else
                    
                    
                        <table class="table table-bordered"  style="border: 0.5px solid #ccc;margin-bottom: 0%;">
                          <thead style="background-color: #B0E0E6">
                            <tr>
                              <th colspan="4">{{ $departure_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $departure_abbreviation }}</strong></span>) to {{ $arrival_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $arrival_abbreviation }}</strong></span>)</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th rowspan="3">
                              <center>
                                {{ $lpos[$n]->host->represents->name }}  
                              </center></th>
                              <td>Depart</td>
                              <td>Arrive</td>
                              <td>Duration</td>
                            </tr>
                            <tr>
                              
                              <td rowspan="2" style="padding: 1%;">
                                  
                                      <span style="color: #000;font-size: 13px;padding: 5%;">{{ $lpos[$n]->departure_time }} </span>
                                      
                                    @php
                                    $depart_date =   $lpos[$n]->departure_date;
                                    $data_depart_date = explode(" ", $depart_date);
                                    $week_day = $data_depart_date[0];
                                    $day = $data_depart_date[1];
                                    $month = $data_depart_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  
                              </td>
                              <td rowspan="2" style="padding: 1%;">
                                    <span style="color: #000;font-size: 13px;padding: 5%;">{{ $lpos[$n]->arrival_time }} </span>
                                      
                                    @php
                                    $arrival_date =   $lpos[$n]->arrival_date;
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
                              <th colspan="4">{{ $arrival_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $arrival_abbreviation }}</strong></span>) to {{ $departure_location }} (<span style="font-size: 16px;color: #000;"><strong>{{ $departure_abbreviation }}</strong></span>)
                              </th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th rowspan="3">
                              <center>
                                {{ $lpis[$m]->host->represents->name }}  
                              </center></th>
                              <td>Depart</td>
                              <td>Arrive</td>
                              <td>Duration</td>
                            </tr>
                            <tr>
                              
                              <td rowspan="2" style="padding: 1%;">
                                  
                                      <span style="color: #000;font-size: 13px;padding: 5%;">{{ $lpis[$m]->departure_time }} </span>
                                      
                                    @php
                                    $depart_date =   $lpis[$m]->departure_date;
                                    $data_depart_date = explode(" ", $depart_date);
                                    $week_day = $data_depart_date[0];
                                    $day = $data_depart_date[1];
                                    $month = $data_depart_date[2];
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $week_day . '</span> <br>';
                                    echo '<span style="padding: 5%;font-weight: 500;">' . $day . ' ' . $month . '</span>';
                                    @endphp
                                  
                              </td>
                              <td rowspan="2" style="padding: 1%;">
                                    <span style="color: #000;font-size: 13px;padding: 5%;">{{ $lpis[$m]->arrival_time }} </span>
                                      
                                    @php
                                    $arrival_date =   $lpis[$m]->arrival_date;
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
                          <thead  style="background-color: #f8f8f8;border-top: 5px solid blue;">
                            <tr>
                              <th colspan="2">
                                  <ul class="list-inline">
                                      <li style="color: #000;font-size: 16px;">You will earn</li>
                                      <li class="pull-right"><span style="font-weight: 600;font-size: 13px;font-family: Corbel;color: #777">Kilometer breakdown&nbsp;&nbsp; </span><i style="color: #ff3345;cursor: pointer;" class="fas fa-chevron-down" onclick='
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
                                $kilometers = (float)$lpos[$n]->kilometers + (float)$lpis[$m]->kilometers;

                                echo '<ul class="list-unstyled"><li><span style="color: #000;font-weight: 700">' . $kilometers . '</span></li><li>
                                   <span style="font-weight: 500;font-size: 15px;"> Landwards kilometers <br> <span style="font-size: 12px;font-family: Segoe UI;">(plus any applicable tier bonuses)</span></span>
                                </li></ul>';
                                @endphp 
                              </td>
                              <td style="padding: 5%; ">
                                @php
                                $kilometers = (float)$lpos[$n]->kilometers + (float)$lpis[$m]->kilometers;

                                echo '<ul class="list-unstyled"><li><span style="color: #000;font-weight: 700">' . $kilometers . '</span></li><li>
                                   <span style="font-weight: 500;font-size: 15px;"> Tier kilometers</span>
                                </li></ul>';
                                @endphp 
                              </td>
                              </div>
                            </tr>
                           
                          </tbody>
                        </table>
                        <hr>
                        <p><span style="color: #000;">Total fare: GH&#8373;
                            @php
                            
                            echo number_format((float)$combined_cost[$LPDK[$i] . '-' . $LPRK[$i]]*$passenger_num,2);
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
                                @if(!$lpos[$n]->fare || !$lpis[$m]->fare)
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
                                        @if(!$lpos[$n]->fare || !$lpis[$m]->fare)
                                        -
                                        @else
                                        @php

                                        $road_fare = (float)$lpos[$n]->fare->road_fare + (float)$lpis[$m]->fare->road_fare;

                                        echo number_format($road_fare, 2);
                                        @endphp
                                        @endif
                                     </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Carrier-imposed charges</th>
                                      <td>
                                        @if(!$lpos[$n]->fare || !$lpis[$m]->fare)
                                        -
                                        @else
                                        @php

                                        $carrier_imposed_charges = (float)$lpos[$n]->fare->carrier_imposed_charges + (float)$lpis[$m]->fare->carrier_imposed_charges;

                                        echo number_format($carrier_imposed_charges, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Taxes, fees and charges</th>
                                      <td>
                                        @if(!$lpos[$n]->fare || !$lpis[$m]->fare)
                                        -
                                        @else
                                        @php

                                        $total_tax = (float)$lpos[$n]->fare->total_tax + (float)$lpis[$m]->fare->total_tax;

                                        echo number_format($total_tax, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Total per passenger</th>
                                      <td>
                                        @if(!$lpos[$n]->fare || !$lpis[$m]->fare)
                                        -
                                        @else
                                        @php

                                        $total_per_passenger = (float)$lpos[$n]->fare->total_per_passenger + (float)$lpis[$m]->fare->total_per_passenger;

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
                            
                            echo number_format((float)$combined_cost[$LPDK[$i] . '-' . $LPRK[$i]]*(float)$passenger_num,2);
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
                                @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
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
                                        @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php

                                        $tax_NTA = (float)$lpos[$n]->tax->tax_NTA + (float)$lpis[$m]->tax->tax_NTA;

                                        echo number_format($tax_NTA, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Passenger Service Charge</th>
                                      <td>@if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php

                                        $passenger_service_charge = (float)$lpos[$n]->tax->passenger_service_charge + (float)$lpis[$m]->tax->passenger_service_charge;

                                        echo number_format($passenger_service_charge, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Passenger Facilities Charge</th>
                                      <td>
                                        @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php

                                        $passenger_facilities_charge = (float)$lpos[$n]->tax->passenger_facilities_charge + (float)$lpis[$m]->tax->passenger_facilites_charge;

                                        echo number_format($passenger_facilities_charge, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Advance Passenger Information Fee</th>
                                      <td>
                                        @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php

                                        $advance_passenger_info_fee = (float)$lpos[$n]->tax->advance_passenger_info_fee + (float)$lpis[$m]->tax->advance_passenger_info_fee;

                                        echo number_format($advance_passenger_info_fee, 2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Station Service Charge</th>
                                      <td>
                                        @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php

                                        $station_service_charge = (float)$lpos[$n]->tax->station_service_charge + (float)$lpis[$m]->tax->station_service_charge;

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
                                        @if(!$lpos[$n]->tax || !$lpis[$m]->tax)
                                        -
                                        @else
                                        @php
                                        
                                        echo number_format(((float)$lpos[$n]->tax->total + (float)$lpis[$m]->tax->total)*$passenger_num,2);
                                        @endphp
                                        @endif
                                    </td>
                                      
                                    </tr>
                                  </tbody>
                              </table>
                                
                            </div>
                            
                        </div>

                        <p>
                            <ul class="list-inline">
                                <li style="color: #000;font-size: 14px;font-family: Corbel;">Fare conditions</li>
                                <li><i class="fas fa-info-circle logo-color"></i></li>
                            </ul>
                            
                        </p>

                        <button class="col-md-12 btn btn-lg" type="submit" style="background-color: #ff3345;">
                            <center style="color: #fff;font-size: 15px;font-weight: 700">GH&#8373;
                            @php
                            
                            echo number_format((float)$combined_cost[$LPDK[$i] . '-' . $LPRK[$i]]*$passenger_num,2);
                            @endphp
                            <br>
                            Select these drives</center>
                        </button>
                        <br>
                <!-- <div class="card card-default">
                    <div class="card-header">
                        <ul class="list-inline">
                           <li>You will earn</li> 
                        </ul>
                    </div>
                    <div class="card-body">
                       @if(!$LPDK || !$LPRK ||!$combined_cost ||!$combined_cost_keys || !$lpos->count() || !$lpis->count())
                                  no lpdk
                                  @else
                                  @for($z= 0; $z < count($LPDK); $z++)
                                  {{$LPDK[$z]}} 
                                  @endfor
                                  <br>
                                  @for($z= 0; $z < count($LPRK); $z++)
                                  {{$LPRK[$z]}} 
                                  @endfor
                                  <br>
                                  @for($z= 0; $z < count($combined_cost_keys); $z++)
                                  {{$combined_cost_keys[$z]}}
                                  @endfor
                                  <br>
                                  @for($z= 0; $z < count($lpos); $z++)
                                  {{$lpos[$z]}} <br>
                                  @endfor
                                  <br>
                                  @for($z= 0; $z < count($lpis); $z++)
                                  {{$lpis[$z]}} <br>
                                  @endfor
                                  <br>
                                  @foreach($combined_cost as $key => $cc)
                                  {{ $key }}: <span style="color: red">{{ $cc }}</span>
                                  @endforeach
                        @endif
                        @if (!$combined_cost || !$LPDK)
                        no combined cost
                        @else
                        @foreach($combined_cost as $key => $cc)
                        {{ $key }}: <span style="color: red">{{ $cc }}</span>
                        @endforeach
                        @endif
                    </div>
                
                </div> -->

             </div>
                
            </div>
        </form>
            <br>
                        @endif
                        @endfor
                    @endif
                    @endfor
                @endfor
                @endif
            

        </div>

        <div class="well tab-pane" id="earliestDepartureTab">
            <div class="card-body" style="border: 1px solid #ccc;">
                kfg;k
            </div>
        </div>
        
        <div class="well tab-pane" id="shortestDurationTab">    
            <div class="card-body" style="border: 1px solid #ccc;">
                kfgafgoja
                gka
            </div>
        </div>

        </div>
    </div>
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
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

        <script type="text/javascript">
            
        </script>
        
    </body>
</html>
