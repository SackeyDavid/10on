<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>One Way | Passenger Details</title>

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
        <link rel="stylesheet" href="{{ URL::To('css/intlTelInput.min.css') }}">

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

            .country-list {
                font-weight: 500;
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
                    <li><span class="top-center" style="margin-top: -2%;">Passenger details</span></li>
                    <!-- <li><span class="top-right links"><a href="#"> Options </a></span></li> -->
                    <li><span class="top-left links"><a href="javascript:history.back()"> <i class="fas fa-arrow-left" style="font-size: 15px;margin-top: 17%;"></i> </a></span></li>
                </ul> 
            </div>

            

        </div>
        <hr>
        <div style="margin: 5%;">
            @if(!$booking_id)
            no booking process id
            @else
            <a href="{{ route('oneway.book.personal.details.auth', ['booking_id' => $booking_id,  'passenger_num' => $passenger_num]) }}" style="color: #000;">
                <ul class="list-inline" style="border: 1px solid #DCDCDC;border-radius: 2px;padding: 4%;">
                    <li style="font-size: 38px;"><i class="fas fa-user-circle"></i></li>
                    <li>
                        <ul class="list-unstyled">
                            <li style="font-weight: 600;font-family: Century Gothic;font-size: 15px;">Login to 10ondrives</li>
                            @if(Auth::user())
                            <li style="font-weight: 300;" class="text-success">Entered your account information</li>
                            @else
                            <li style="font-weight: 300;">Enter your account information</li>
                            @endif
                        </ul>
                    </li>
                    <li class="float-right" style="margin-top: 5%;"><i class="fas fa-chevron-right logo-color"></i></li>
                </ul>
            </a>
            @endif
            </div>

            <div style="background-color: #f8f8f8;padding: 2%;border: 1px solid #E8E8E8;">
                &nbsp;&nbsp;<span style="font-weight: 300;">PASSENGER DETAILS</span>
            </div>
            <div class="col-md-12">
                <br>
            @if(!$booking_id || !$passenger_num)
            no booking process id
            @else

            <!-- ow stands for oneway -->
            <form method="POST" action="{{route('ow.passenger.details.add',['booking_id' => $booking_id, 'passenger_num' => $passenger_num])}}">
                            {{ csrf_field() }} 

                
                <span style="font-weight: 600; margin-bottom: 10%;">Personal details</span>
                @if(Auth::user())
                <select type="text" id="ow_title" name="ow_title" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" required>
                    <option value="{{Auth::user()->title}}">{{Auth::user()->title}}</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Ms">Ms</option>
                </select>
                @else
                <select type="text" id="ow_title" name="ow_title" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" required>
                    <option>Title</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                    <option>Ms</option>
                </select>
                @endif
                <br>
                @if(Auth::user())
                <input type="text" id="ow_first_name" name="ow_first_name" style="height: 8vh;"  class="form-control passenger-details-inputs" value="{{ Auth::user()->first_name}}" required>
                @else
                <input type="text" id="ow_first_name" name="ow_first_name" style="height: 8vh;"  class="form-control passenger-details-inputs" placeholder="First name(As shown on an ID)" required>
                @endif
                <br>
                @if(Auth::user())
                <input type="text" id="ow_title" name="ow_last_name" style="height: 8vh;"  class="form-control passenger-details-inputs" value ="{{ Auth::user()->last_name}}" required>
                @else
                <input type="text" id="ow_title" name="ow_last_name" style="height: 8vh;"  class="form-control passenger-details-inputs" placeholder="Last name(As shown on an ID)" required>
                @endif
                
                <span style="font-weight: 600; "><br>Contact details</span>
                @if(Auth::user())
                <input type="text" id="ow_title" name="ow_email" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" value="{{Auth::user()->email}}" required>
                @else
                <input type="text" id="ow_title" name="ow_email" style="height: 8vh;margin-top: 2%;"  class="form-control passenger-details-inputs" placeholder="Email address" required>
                @endif
                <br>
                @if(Auth::user())
                <select type="text" id="ow_contact_person" name="ow_contact_person" style="height: 8vh;"  class="form-control passenger-details-inputs" required>
                    <option value="{{Auth::user()->contact_person}}">{{Auth::user()->contact_person}}</option>
                    <option>Contact person</option>
                    <option>Travel arranger</option>
                    
                </select>
                @else
                <select type="text" id="ow_contact_person" name="ow_contact_person" style="height: 8vh;"  class="form-control passenger-details-inputs" required>
                    <option>Contact person</option>
                    <option>Travel arranger</option>
                    
                </select>
                @endif
                <br>
               
                @if(Auth::user())
                <input type="tel" id="ow_mobile_number" name="ow_mobile_number" style="height: 8vh;width: 100%;"  class="form-control passenger-details-inputs" value="{{Auth::user()->mobile_number}}" required>
                @else
                <input type="tel" id="ow_mobile_number" name="ow_mobile_number" style="height: 8vh;width: 100%;"  class="form-control passenger-details-inputs" placeholder="Mobile number" required>
                @endif
                
                @if(Auth::user())
                <input type="hidden" id="ow_country" name="ow_country" style="height: 8vh;"  class="form-control passenger-details-inputs" value="{{Auth::user()->country}}" required>
                @else
                <input type="hidden" id="ow_country" name="ow_country" style="height: 8vh;"  class="form-control passenger-details-inputs" value ="Ghana(+233)" required>
                @endif 
                <br><br>

                 
                 <div class="input-group"> 
                @if(Auth::user())
                    @if(Auth::user()->remind_me == "yes")
                <input type="checkbox" id="ow_remind_me" name="ow_remind_me" style="height: 4vh;width: 10%;"  class="form-control passenger-details-inputs" placeholder="Title" checked required>
                    @else
                <input type="checkbox" id="ow_remind_me" name="ow_remind_me" style="height: 4vh;width: 10%;"  class="form-control passenger-details-inputs" placeholder="Title" required> 
                    @endif
                @else 
                 <input type="checkbox" id="ow_remind_me" name="ow_remind_me" style="height: 4vh;width: 10%;"  class="form-control passenger-details-inputs" checked>
                 @endif

                <span style="font-size: 11px;color: #000;font-weight: 500;"> I'd like to receive sms reminder when check-in opens?</span>
                    
                </div>
                <br>
                <button id="ow-personal-submit" class="col-md-12 btn btn-lg" style="background-color: #ff3345;color: #fff;">Continue</button>
            </form>
            @endif
                <br>
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
                    <a href="" onclick="sessionExpiredRedirect()" type="button" class="btn btn-success" style="padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; border: 1px solid transparent; border-radius: 4px; background-color: #428bca; color: #FFF;">Login</a>

                </div>

            </div>

        </div>

    </div>
        <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>

        <script type="text/javascript">
            $('#ow_contact_person').focus(function(){
                var c  = document.createElement("option");
                c.text = $('#ow_title').val() + ' ' + $('input[name="ow_first_name"]').val() + ' ' + $('input[name="ow_last_name"]').val(); 
                this.options.add(c, 2);
            });

            $("#ow_mobile_number").intlTelInput({
              preferredCountries: ["gh", "ke", "ng", "tg", "ci", "bf", "us", "gb"],
              nationalMode: true,
              utilsScript: "js/utils.js"
            });

            $("#ow-personal-submit").click(function(){
               
              let country = $('#ow_mobile_number').intlTelInput('getSelectedCountryData');

               $('#ow_country').val(country['name']);
            
              $("#ow_mobile_number").val($("#ow_mobile_number").intlTelInput("getNumber"));
              document.forms[0].submit();
            });
        </script>
    </body>
</html>
