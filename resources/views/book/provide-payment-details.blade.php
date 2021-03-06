<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Payment Details</title>

        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });
        </script>
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
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

        <link rel="stylesheet" href="{{ URL::To('css/intlTelInput.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/search-trips.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/material-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/provide-personal-details.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/provide-payment-details.css') }}">        

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
                right: 20px;
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
                right: 31%;
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

            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('{{URL::To("images/loading-gifs/loader-64x/Preloader_8.gif")}}') center no-repeat #fff;
            }

        </style>
    </head>
    <body>
        <div class="se-pre-con"></div>
            @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}</center></p>
            </div>
            @endif
         <div class="modal" id="credit-card-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <ul class="list-inline" style="margin-top: -4%">
                    <li><span class="top-center" style="margin-top: -2%;">Payment Option</span></li>
                    
                    <li id="close-credit-card-modal"><span class="top-right links" style="margin-top: -4%;"> <span arial-label="Close" onclick="$('#credit-card-modal').hide();"><b style="opacity: 1;font-weight: 500;font-size: 25px;color: #ff3345;">x</b></span> </span></li>
                    </ul> 
                                    
                </div>
                <div class="modal-body">
                    <center><i style="font-size: 32px;font-weight: 500;color: #000;" class="fas fa-credit-card"></i> <br> <span style="font-size: 24px;font-weight: 500;color: #000;">Credit or Debit Card</span>
                    </center>
                


                <div style="background-color: #f8f8f8;padding: 2%;margin-left: -4.5%;margin-right: -4.5%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">CARD DETAILS</span>
                </div> 

                <br>
                
                <form id="credit-card-form" method="POST" action="{{route('payment.details.add',['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'option' => 'card'])}}">
                            @csrf
                <div class="append">
                <input type="text" id="card_number" name="card_number" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Card number" required>

               <br>
                
                <input type="text" id="expiry_date" name="expiry_date" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Expiry date" required>

                <br>
                
                <input type="text" id="mobile-first-name" name="first_name" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="First name(As shown on card)" required>

                <br>                
                
                <input type="text" id="mobile-last-name" name="last_name" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Last name(As shown on card)" required>
                <br>
                <div style="background-color: #f8f8f8;padding: 2%;margin-left: -4.5%;margin-right: -4.5%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">BILLING ADDRESS</span>
                </div> 
                <br>                
                
                <input type="text" id="country" name="country" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Country" required>

                <br>
                
                <input type="text" id="address_line_1" name="address_line_1" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Address" required>
                <br>
                </div>
                <br>
                <center>
                <ul class="list-inline">
                <li>
            <button id="passenger_num_minus" type="button" class="passenger_num_buttons" style="border-radius: 45%;color: #777;"><i class="fas fa-minus"></i></button>
            </li>
                <li style="width: 60%;">
                    <span id="passenger_label" style="font-weight:500;font-size: 15px;color: #777;">Add address line</span>
                </li>
                <li>
                   <button id="passenger_num_plus" type="button" class="passenger_num_buttons" style="border-radius: 45%;color: #777;"><i class="fas fa-plus"></i></button> 
                </li>
               
                </ul>
            </center>
                <br>
                
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" class="col-md-12 btn btn-lg" style="background-color: #ff3345;color: #fff;">Confirm</button>
                    <br><br>
                    <p style="font-family: Corbel; font-weight: 500;text-align: center;">You won't be charged until you confirm your drive in the next step </p>
                <br>

                
                <br>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="modal" id="mobile-money-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                
                     <ul class="list-inline" style="margin-top: -4%">
                    <li><span class="top-center" style="margin-top: -2%;">Payment Option</span></li>
                    
                    <li id="close-credit-card-modal"><span class="top-right links" style="margin-top: -4%;"> <span arial-label="Close" onclick="$('#mobile-money-modal').hide();"><b style="opacity: 1;font-weight: 500;font-size: 25px;color: #ff3345;">x</b></span> </span></li>
                    </ul>  
                                    <!-- <br>

                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close" onclick="$('#mobile-money-modal').hide();">x</button> -->
                            </div>
            <div class="modal-body">
                    <center><i class="fa fa-mobile-alt" style="font-size: 32px;font-weight: 500;color: #000;" ></i> <br> <span style="font-size: 24px;font-weight: 500;color: #000;">Mobile Money</span>
                    </center>
                


                <div style="background-color: #f8f8f8;padding: 2%;margin-left: -4.5%;margin-right: -4.5%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">WALLET DETAILS</span>
                </div> 

                <br>
                
                <form id="mobile-money-form" method="POST" action="{{route('payment.details.add',['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'option' => 'wallet'])}}">
                            @csrf
                @if(Auth::user())
                    @if(Auth::user()->wallet)
                <input type="text" id="phone_number" name="phone_number" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" value="{{Auth::user()->wallet->phone_number}}" required>
                    @else
                        @if($booking)
                    <input type="tel" id="phone_number" name="phone_number" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Phone number"  value="{{$booking->user->mobile_number}}" required>
                        @endif
                    @endif
                @else
                    @if($booking)
                <input type="tel" id="phone_number" name="phone_number" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder ="Phone number" value="{{$booking->passenger->mobile_number}}" required>
                    @endif
                @endif
               <br><br>
                
                @if(Auth::user())
                <input type="text" id="name" name="name" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" value ="{{ Auth::user()->first_name}} {{Auth::user()->last_name}}" required>
                @else
                    @if($booking)
                <input type="text" id="name" name="name" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder="Name" value="{{$booking->passenger->first_name}} {{$booking->passenger->last_name}}" required>
                    @else
                <input type="text" id="name" name="name" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder="Name" required>
                    @endif
                @endif


                <br>
                <input type="hidden" id="network" name="network" value="">
               
               
                
                <b>Select network operator <i class="fa fa-caret-down"></i></b> <br>
                <ul class="list-inline">
                    <li><img src="{{ URL::to('/images/mtn-momo.jpg') }}" id="mtn" height="70" width="70" class="img-responsive img-thumbnail"></li>
                    <li><img src="{{ URL::to('/images/vod-momo.png') }}" id="vodafone" height="70" width="70" class="img-responsive img-thumbnail"></li>
                    <li><img src="{{ URL::to('/images/airtel-momo.jpg') }}" id="airtel" height="70" width="70" class="img-responsive img-responsive img-thumbnail"></li>
                    <li><img src="{{ URL::to('/images/tigo-momo.png') }}" id="tigo" height="70" width="70" class="img-responsive img-responsive img-thumbnail"></li>
                </ul>

               
                </form>

                </div>
                
            </div>
            </div>
        </div>



        <div class="col-md-12">
            <div>
                <ul class="list-inline" style="">
                    <li><span class="top-center" style="margin-top: -2%;">Payment details</span></li>
                    <!-- <li><span class="top-right links"><a href="#"> Options </a></span></li> -->
                    <li><span class="top-left links"><a href="javascript:history.back()"> <i class="fas fa-arrow-left" style="font-size: 15px;margin-top: 17%;"></i> </a></span></li>
                </ul> 
            </div>

            

        </div>
        <hr>
        <div style="margin: 5%;padding: 4%;border-radius: 2px;border: 1px solid #DCDCDC;">
            @if(!$booking_id || !$lpos || !$lpis || !$passenger_num || !$traveler_id)
            no booking process id
            @else
            <a href="{{ route('book.payment.details.auth', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id]) }}" style="color: #000;">
                <div style="">
                <table style="margin-bottom: 0%;">
                    <tbody style="">
                    <tr style="font-size: 38px;width: 15%;">
                    <td><i class="fas fa-user-circle"></i></td>
                    <td  style="width: 80%;padding-left: 1%;padding-right: 1.5%;">
                        <ul class="list-unstyled">
                            
                            @if(Auth::user())
                            <li style="font-weight: 600;font-family: Century Gothic;font-size: 15px;">{{Auth::user()->first_name}} : 
                                @if(Auth::user()->kilometers > 0) 
                                {{Auth::user()->kilometers}}
                                @else
                                0
                                @endif
                                 km</li>
                            <li style="font-weight: 300;font-size: 15px;" class="text-success">Logged in. You will earn <b style="font-family: Arial;">
                                @if(!$outbound || !$inbound)
                                0
                                @else
                                @php echo  $outbound->kilometers + $inbound->kilometers; @endphp more kilometers
                                @endif
                            </b> .</li>
                            @else
                            <li style="font-weight: 600;font-family: Century Gothic;font-size: 15px;">Pay with Cash + Kilometers</li>
                            <li style="font-weight: 300;"><p style="font-size: 12px;">Log in to your account to pay with cash + kilometers and access your daved cards or wallets</p></li>
                            @endif
                        </ul>
                    </td>
                    <td class="float-right" style="font-size: 13px;padding-left: 0%;"><div style="margin-top: 0%;"><br><i class="fas fa-chevron-right logo-color"></i></div></td>
                </tr>
                </tbody>
                </table>
            </div>
            </a>
            @endif
            </div>

            <div style="background-color: #f8f8f8;padding: 2%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">PAYMENT DETAILS</span>
            </div>
            <div class="col-md-12">
                <br>
            @if(!$booking_id || !$lpos || !$lpis || !$passenger_num || !$traveler_id || !$outbound ||!$inbound)
            no booking process id
            @else
            <form method="POST" action="{{route('payment.details.add',['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'option' => 'wallet'])}}">
                            {{ csrf_field() }} 

                
                <div class="card card-default">
                    <div class="card-header" style="background-color: #fff;">
                        <ul class="list-unstyled" style="margin-bottom: 0%;">
                            <li style="font-weight: 300;color: #000;">Total Drive Cost</li>
                            <li><span style="font-size: 16px;font-weight: 300">GH&#8373; 
                                @php
                                $total = (float)$outbound->fare->total_per_passenger + (float)$inbound->fare->total_per_passenger;
                                echo '<span style="font-size: 24px;font-weight: 500;">' . number_format($total, 2) . '</span>';

                                @endphp
                            </span> </li>
                        </ul> 
                    </div>
                    <div class="card-body" style="background-color: #f8f8f8;">
                        <a id="open-mobile-money-modal"><div class="col-md-12" style="border: 1px solid #DCDCDC;padding: 7%;background-color: #fff;">
                        <ul class="list-inline" style="margin-bottom: 0%;">
                            <li style="font-size: 20px; font-weight: 500;color: #000;"><i class="fas fa-mobile-alt"></i></li> 
                            @if(!Auth::user())
                            <li style="font-size: 15px;font-weight: 800;color: #000;">Mobile Money</li>
                            @else
                            <li style="font-size: 15px;font-weight: 800;color: #000;">
                            <ul class="list-unstyled">
                                <li> Mobile Money</li>
                                <li style="font-size: 12px;" class="text-success">
                                @if(Auth::user()->wallet)
                                Ready
                                @else
                                <!-- <span style="color: #fff;">Ready</span> -->
                                @endif
                            </li>
                            </ul>
                            </li>
                            @endif

                            <li class="float-right"><i class="fas fa-chevron-right logo-color"></i></li>
                        </ul>
                        </div>
                        </a>
                    </div>

                </div>

            
            <br>
                
                @if(!Auth::user())
                <p style="font-family: Corbel; font-weight: 500;text-align: center;">You won't be charged until you confirm your drive in the next step </p>
                <br>

                <button class="col-md-12 btn btn-lg" style="background-color: #DCDCDC;color: #fff;" disabled><i class="fas fa-mobile-alt"></i> Proceed to Verify</button>
                @else
                    @if(Auth::user()->wallet)
                <button type="submit" class="col-md-12 btn btn-lg" style="background-color: #ff3345;color: #fff;"><i class="fas fa-mobile-alt"></i> Proceed to Pay</button>
                    @else
                <button type="submit" class="col-md-12 btn btn-lg" style="background-color: #DCDCDC;color: #fff;"  disabled><i class="fas fa-mobile-alt"></i> Proceed to Pay</button>
                    @endif

                @endif
                <br>
            </form>
            <br>
            <hr>
            <br>
            <form method="POST" action="{{route('payment.details.add',['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'option' => 'card'])}}">
                            {{ csrf_field() }} 

                
                <div class="card card-default">
                    <div class="card-header" style="background-color: #fff;">
                        <ul class="list-unstyled" style="margin-bottom: 0%;">
                            <li style="font-weight: 300;color: #000;">Total Drive Cost</li>
                            <li><span style="font-size: 16px;font-weight: 300">GH&#8373; 
                                @php
                                $total = (float)$outbound->fare->total_per_passenger + (float)$inbound->fare->total_per_passenger;
                                echo '<span style="font-size: 24px;font-weight: 500;">' . number_format($total, 2) . '</span>';

                                @endphp
                            </span> 
                            </li>
                        </ul> 
                    </div>
                    <div class="card-body" style="background-color: #f8f8f8;">
                        <!-- href is #credit-card-modal for credit card madal to show -->
                        <a href="" data-toggle="modal"><div class="col-md-12" style="border: 1px solid #DCDCDC;padding: 7%;background-color: #fff;">
                        <ul class="list-inline" style="margin-bottom: 0%;">
                            <li style="font-size: 20px; font-weight: 500;color: #000;"><i class="fas fa-credit-card"></i></li> 
                            @if(!Auth::user())
                            <li style="font-size: 15px;font-weight: 800;color: #000;line-height: 10px;">Credit or Debit card
                                <ul class="list-inline">
                                <li><span class="text-danger" style="font-size: 10px;">not supported yet</span>
                                </li>
                                </ul></li>
                            @else
                            <li style="font-size: 15px;font-weight: 800;color: #000;">
                            <ul class="list-unstyled">
                                <li>Credit or Debit card</li>
                                <li style="font-size: 12px;" class="text-success">
                                @if(Auth::user()->card)
                                Ready
                                @else
                                <span class="text-danger">not supported yet</span>
                                @endif
                            </li>
                            </ul>
                            </li>
                            @endif
                            <li class="float-right"><i class="fas fa-chevron-right" style="color: #fff;"></i></li>
                        </ul>
                        </div>
                        </a>
                    </div>
                    

                </div>
                <br>
                <!-- credit card button disabled for now -->
                @if(!Auth::user())
                <p style="font-family: Corbel; font-weight: 500;text-align: center;">You won't be charged until you confirm your drive in the next step </p>
                <br>
                <button class="col-md-12 btn btn-lg" style="background-color: #DCDCDC;color: #fff;" disabled><i class="fas fa-credit-card"></i> Proceed to verify</button>
                @else
                <button type="submit" class="col-md-12 btn btn-lg" style="background-color: #DCDCDC;color: #fff;" disabled><i class="fas fa-credit-card"></i> Proceed to Pay</button>
                @endif
                <br>

            </form>

            <br>
            
            @endif

            </div>
            <br>

        
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>

        <script type="text/javascript">
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });

            $('#open-mobile-money-modal').click(function(){
                $('#mobile-money-modal').show();
                
            });

            $("#phone_number").intlTelInput({
              preferredCountries: ["gh", "tg", "ci", "bf", "ng", "us", "gb"],
              nationalMode: true,
              utilsScript: "{{ asset('js/utils.js') }}"
            });

            $("#momo-submit").click(function(){
              $("#phone_number").val($("#phone_number").intlTelInput("getNumber"));
              document.getElementById("mobile-money-form").submit();
            });

            $('input[name="network"]').focus(function() {
                alert('Hi');
                var c  = document.createElement("option");
                var channel = $('input[name="phone_number"]').val();
                channel = channel.substring(0,3);
                switch(channel)
                {
                    case 024:
                        
                    case 055:
                        
                    case 054:
                        
                        c.text = "Mtn" ;
                        c.value = "mtn-gh";
                        break;
                    case 027:
                        
                    case 057:
                        c.text = "Tigo" ;
                        c.value = "tigo-gh";
                        break;
                    case 026:
                        
                    case 056:
                        c.text = "Airtel" ;
                        c.value = "airtel-gh";
                        break;
                    case 050:
                        
                    case 020:
                        c.text = "Vodafone" ;
                        c.value = "vodafone-gh";
                        break;
                }
                 
                this.options.add(c, 0);
            });

            var counter = 2;

            $('#passenger_num_plus').click(function() {
                
                if (counter <=3) 
                {
                var x = document.createElement("INPUT");
                var y = document.createElement("BR");
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control passenger-details-inputs");
                x.setAttribute("style", "height: 8vh;");
                
                x.setAttribute("name", "address_line_"+ counter);
                x.setAttribute("placeholder", "Address Line "+counter);
                $('#credit-card-modal .modal-content .modal-body .append').append(x, y);
                counter++;
                }
                else
                {
                    alert('maximum number of address lines reached')
                }
            });
               
            $('#passenger_num_minus').click(function() {
                
                var r = $('input[name="address_line_' + (counter - 1) +'"]');
                r.prev('br').remove()
                r.remove();
                counter--;
                
            });

            $('#close-credit-card-modal').click(function(){
                $('#credit-card-modal').hide();
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
            });

            $('#mtn').click(function(){

                $("#phone_number").val($("#phone_number").intlTelInput("getNumber"));
                $("#network").val('mtn-gh');
                // alert($("#network").val());
                document.getElementById("mobile-money-form").submit();
                $('#mobile-money-modal').hide();
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
                
            });

            $('#vodafone').click(function(){
                $("#phone_number").val($("#phone_number").intlTelInput("getNumber"));
                $("#network").val('vodafone-gh');
                document.getElementById("mobile-money-form").submit();
                $('#mobile-money-modal').hide();
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
               
            });

            $('#airtel').click(function(){
                $("#phone_number").val($("#phone_number").intlTelInput("getNumber"));
                $("#network").val('airtel-gh');
                document.getElementById("mobile-money-form").submit();
                $('#mobile-money-modal').hide();
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
                
            });

            $('#tigo').click(function(){
                $("#phone_number").val($("#phone_number").intlTelInput("getNumber"));
                $("#network").val('tigo-gh');
                document.getElementById("mobile-money-form").submit();
                $('#mobile-money-modal').hide();
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
                
            });



        </script>
    </body>
</html>
