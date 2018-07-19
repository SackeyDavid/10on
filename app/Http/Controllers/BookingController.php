<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;
use App\Trips;
use App\ReturnBooking;
use App\PassengerDetails;
use App\CardDetails;
use App\MobileMoney;
use Auth;
use DB;
use OVAC\LaravelHubtelPayment\Facades\HubtelPayment;
use OVAC\HubtelPayment\Config;
use Slydepay\Order\Order;
use Slydepay\Order\OrderItem;
use Slydepay\Order\OrderItems;
use Slydepay;
use App\User;
use Illuminate\Support\Facades\Input;
use \Carbon\Carbon;
use Illuminate\Notifications\Notification;
use NotificationChannels\Hubtel\HubtelChannel;
use NotificationChannels\Hubtel\HubtelMessage;

class BookingController extends Controller
{
    public function via($notifiable)
    {
        return [HubtelChannel::class];
    }

    public function toSMS($notifiable)
    {
        return (new HubtelMessage)
            ->from("10ondrives")
            ->to("2331234567890")
                ->content("Kim Kippo... Sup with you");
    }

    public function searchTrip()
    {
    	return view('book.search-trip');
    }

    public function autocomplete(Request $request)
    {
    	$data = Station::where("name", "LIKE", "%{$request->input('query')}%")->orWhere("abbreviation", "LIKE", "%{$request->input('query')}%")->orWhere("town_or_city", "LIKE", "%{$request->input('query')}%")->orWhere("region", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    	// return Station::whee($request->get('departure_station'))->get();
    	
    }

    public function findReturnTrips(Request $request)
    {
    	// lowest price outbounds (lpos)
        $current_year = date("Y");

    	$lpos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' '. $current_year)->where('remaining_seats', '!=', 0)->orderBy('trip_fare')->get();

    	// lowest price inbounds (lpis)
    	$lpis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' '.$current_year )->where('remaining_seats', '!=', 0)->orderBy('trip_fare')->get();

    	// earliest departure outbounds (eos)
    	$eos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' '. $current_year)->orderBy('departure_time')->get();

    	// earliest departure inbounds (eis)
    	$eis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' '.$current_year)->orderBy('departure_time')->get();

    	// shortest duration outbounds (sdos)
    	$sdos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' '. $current_year)->orderBy('trip_duration_in_hrs')->get();

    	// shortest duration inbounds (sdis)
    	$sdis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' '. $current_year)->orderBy('trip_duration_in_hrs')->get();

    	// array to store total cost for each outbound and inbound trip for lowest price
    	$combined_cost = array();

    	// loop through each collection to get trip costs and append their sum to $combine_cost array 
    	foreach ($lpos as $key => $lpo) {
            foreach ($lpis as $key => $lpi) {
            	// string key instead of int used to later split key's values
                $combined_cost[$lpo->id . '-' . $lpi->id] = (float)$lpo->trip_fare + (float)$lpi->trip_fare;
            }
            
        }

        // array to store total cost for each outbound and inbound trip for earliest departure
        $combined_cost_ED = array();

        // loop through each collection to get trip costs and append their sum to $combine_cost array 
        foreach ($eos as $key => $eo) {
            foreach ($eis as $key => $ei) {
                // string key instead of int used to later split key's values
                $combined_cost_ED[$eo->id . '-' . $ei->id] = (float)$eo->trip_fare + (float)$ei->trip_fare;
            }
            
        }

        // array to store total cost for each outbound and inbound trip for shortest duration
        $combined_cost_SD = array();

        // loop through each collection to get trip costs and append their sum to $combine_cost array 
        foreach ($sdos as $key => $sdo) {
            foreach ($sdis as $key => $sdi) {
                // string key instead of int used to later split key's values
                $combined_cost_SD[$sdo->id . '-' . $sdi->id] = (float)$sdo->trip_fare + (float)$sdi->trip_fare;
            }
            
        }

        //sort combined_cost array values maintaining their keys
        asort($combined_cost);

        //sort combined_cost_ED array values maintaining their keys
        // asort($combined_cost_ED); // Don't sort the values here to ensure order of ED  

        //append combined_cost keys to a keys array
        $combined_cost_keys = array_keys($combined_cost);

        //append combined_cost_ED keys to a keys array
        $combined_cost_keys_ED = array_keys($combined_cost_ED);

        //append combined_cost_SD keys to a keys array
        $combined_cost_keys_SD = array_keys($combined_cost_SD);

        //keys for lowest price departure LPDK and lowest price return LPRK
        $key_pairs = $LPDK = $LPRK = array();

        //keys for earliest departure departure EDDK and earliest departure return EDRK
        $key_pairs_ED = $EDDK = $EDRK = array();

        //keys for shortest duration departure SDDK and earliest departure return SDRK
        $key_pairs_SD = $SDDK = $SDRK = array();

    		foreach($combined_cost_keys as $keys) {
    		    $key_pairs = explode("-", $keys);
    		    // append Lowest Price Outbound id to LPDK
    		    array_push($LPDK, $key_pairs[0]);

    		    // append Lowest Price Inbound id to LPRK
    		    array_push($LPRK, $key_pairs[1]);
    		}

            foreach($combined_cost_keys_ED as $keys) {
                $key_pairs_ED = explode("-", $keys);
                // append Earliest Departure Outbound id to EDDK
                array_push($EDDK, $key_pairs_ED[0]);

                // append Earliest Departure Inbound id to EDRK
                array_push($EDRK, $key_pairs_ED[1]);
            }

            foreach($combined_cost_keys_SD as $keys) {
                $key_pairs_SD = explode("-", $keys);
                // append Earliest Departure Outbound id to EDDK
                array_push($SDDK, $key_pairs_SD[0]);

                // append Earliest Departure Inbound id to EDRK
                array_push($SDRK, $key_pairs_SD[1]);
            }

    		// convert collections to array for interations to allow for-loop in blade
    		$lpos_array = $lpos->toArray();
    		$lpis_array = $lpis->toArray();

            // convert collections to array for interations to allow for-loop
            $eos_array = $eos->toArray();
            $eis_array = $eis->toArray();

            // convert collections to array for interations to allow for-loop
            $sdos_array = $sdos->toArray();
            $sdis_array = $sdis->toArray();

		



    	$departure_abbreviation = Station::where('name', $request->departure_location)->first();

    	$arrival_abbreviation = Station::where('name', $request->arrival_location)->first();

		$depart_abb = ""; 
		$arrive_abb = ""; 

		

     	if ($departure_abbreviation != null || $arrival_abbreviation != null ) {
    		$depart_abb = $departure_abbreviation->abbreviation;

    		$arrive_abb = $arrival_abbreviation->abbreviation;
    	}


    	// lpis - lowest price inbounds, lpos -lowest price outbounds
        // other values are obtained from http request and/or a combination with corresponding database values such as the abbreviations for station names (e.g. depart_abb)

    	return view('book.search-return-trips-results', compact(['lpos', 'lpis', 'eos', 'eis', 'sdos', 'sdis', 'combined_cost','LPDK', 'LPRK', 'combined_cost_ED','EDDK', 'EDRK',  'combined_cost_SD','SDDK', 'SDRK', 'lpos_array', 'combined_cost_keys_ED']))->with('departure_location', $request->departure_location)->with('arrival_location', $request->arrival_location)->with('departure_date', $request->departure_date)->with('passenger_num', $request->passenger_num)->with('return_date', $request->return_date)->with('departure_abbreviation', $depart_abb)->with('arrival_abbreviation', $arrive_abb);
    }


    public function tripFound($lpos, $lpis, $passenger_num)
    {
        
        
        $booking = ReturnBooking::create([
            'outbound' => $lpos,
            'inbound' => $lpis,
            
          ]);

        return redirect()->route('book.personal.details', ['booking_id' => $booking->id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num]);
    }

    public function personalDetails($booking_id, $lpos, $lpis, $passenger_num)
    {
        return view('book.provide-personal-details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num]);
    }

    public function addPassengerDetails(Request $request, $booking_id, $lpos, $lpis, $passenger_num) 
    {

        if (Auth::user()) {
            DB::table('return_booking_process')->where('id', $booking_id )->update(['user_id' => Auth::user()->id]);

             return redirect()->route('book.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => 'user' . ' ' . Auth::user()->id ]);
        }
        else
        {
            $passenger_details = PassengerDetails::create([
                'title' => $request->title,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'contact_person' => $request->contact_person,
                'country' => $request->country,
                'mobile_number' => $request->mobile_number,
                'remind_me' => $request->remind_me,
                
              ]);

            DB::table('return_booking_process')->where('id', $booking_id )->update(['passenger_id' => $passenger_details->id]);

            return redirect()->route('book.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => 'passenger' . ' ' .  $passenger_details->id]);
        }

        


    }

    public function paymentDetails($booking_id, $lpos, $lpis, $passenger_num, $traveler_id) 
    {

        $outbound = Trips::find($lpos);
        $inbound = Trips::find($lpis);
        $booking = ReturnBooking::find($booking_id);

        return view('book.provide-payment-details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'outbound' => $outbound, 'inbound' => $inbound, 'booking' => $booking]);    
    }

    public function addPaymentDetails(Request $request, $booking_id, $lpos, $lpis, $passenger_num, $traveler_id, $option)
    {
        $booking = ReturnBooking::find($booking_id); // Users booking

        $out_trip = Trips::find($lpos);

        $in_trip = Trips::find($lpis);

        $out_remaining_seats = $out_trip->remaining_seats - $passenger_num;

        $in_remaining_seats = $in_trip->remaining_seats - $passenger_num;

        if ($out_remaining_seats < 0 || $in_remaining_seats < 0) 
        {
            return redirect()->back()->withInput(Input::all())->with('msg', 'Oops, 0 seats left for the trip you chose. Kindly choose another trip.');
        }
        else
        {
        
            if ($option == 'card') 
            {

                if (Auth::user() && Auth::user()->card) {

                    DB::table('return_booking_process')->where('id', $booking_id )->update(['card_id' => Auth::user()->card->id]);   

                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->card->id, 'option' => $option]);         
                }   
                elseif (Auth::user() && !Auth::user()->card)
                {         
                    $payment = CardDetails::create([
                        'card_number' => $request->card_number,
                        'security_code' => $request->security_code,
                        'expiry_date' => $request->expiry_date,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'country' => $request->country,
                        'address_line_1' => $request->address_line_1,
                        'address_line_2' => $request->address_line_2,
                        'address_line_3' => $request->address_line_3,

                    ]);

                    // card payment codes here

                    DB::table('return_booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);

                    DB::table('users')->where('id', Auth::user()->id )->update(['card_id' => $payment->id ]);

                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);
                }
                else
                {
                    $payment = CardDetails::create([
                        'card_number' => $request->card_number,
                        'security_code' => $request->security_code,
                        'expiry_date' => $request->expiry_date,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'country' => $request->country,
                        'address_line_1' => $request->address_line_1,
                        'address_line_2' => $request->address_line_2,
                        'address_line_3' => $request->address_line_3,

                    ]);

                    // card payment method here

                    DB::table('return_booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);


                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);

                }

            }
            // for mobile money users
            else
            {
                if (Auth::user() && Auth::user()->wallet) {

                    DB::table('return_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => Auth::user()->wallet->id]); 
                      
                    $token = sprintf('%06d', mt_rand(100000,999999));

                    $payment = HubtelPayment::ReceiveMoney()
                    ->from(Auth::user()->wallet->phone_number)//- The phone number to send the prompt to. 
                    ->amount(((float)$out_trip->trip_fare + (float)$in_trip->trip_fare)*$passenger_num)                    //- The exact amount value of the transaction
                    ->description('Online Bus Booking Payment')    //- Description of the transaction.
                    ->customerName(Auth::user()->first_name . ' ' . Auth::user()->last_name)     //- Name of the person making the payment.callback after payment. 
                    ->token($token)
                    ->channel(Auth::user()->wallet->network)                 //- The mobile network Channel.configuration
                    ->run();

                    DB::table('return_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);
                    
                    $out_rem_seats = $out_trip->remaining_seats;
                    $out_rem_seats--;

                    
                    $in_rem_seats = $in_trip->remaining_seats;
                    $in_rem_seats--;

                    $kilometers_earned = (float)Auth::user()->kilometers + (float)$out_trip->kilometers + (float)$in_trip->kilometers;

                    // update trips table
                    DB::table('trips')->where('id', $lpos )->update(['remaining_seats' => $out_rem_seats ]);
                    DB::table('trips')->where('id', $lpis )->update(['remaining_seats' => $in_rem_seats ]);

                    // update users table
                    DB::table('users')->where('id', Auth::user()->id )->update(['kilometers' => $kilometers_earned ]);

                    

                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->wallet->id, 'option' => $option]);

                }
                // registered users without wallet details
                elseif (Auth::user() && !Auth::user()->wallet)
                {
                    $passenger = explode(" ", $traveler_id);
                    $bookers_id = $passenger[1];

                    
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'network' => $request->network,
                            'name' => $request->name,
                            'from_user' => Auth::user()->id,
                            'from_passenger' => null
                         ]);
                   
                $token = sprintf('%06d', mt_rand(100000,999999));

                $payment = HubtelPayment::ReceiveMoney()
                        ->from($request->phone_number) //- The phone number to send the prompt to. 
                        ->amount(((float)$out_trip->trip_fare + (float)$in_trip->trip_fare)*$passenger_num)                 //- The exact amount value of the transaction
                        ->description('Online booking payment')    //- Description of the transaction.
                        ->customerName($booking->user->first_name . ' ' . $booking->user->last_name)     //- Name of the person making the payment.callback after payment.
                        ->token($token) 
                        ->channel($request->network)    //- The mobile network Channel.configuration
                        ->run();  
                        
                        $out_rem_seats = $out_trip->remaining_seats;
                        

                        
                        $in_rem_seats = $in_trip->remaining_seats;
                        

                        if ($out_rem_seats == 0) {
                                    //refund money back to user and
                            return redirect()->back()->with('msg', 'Aww, so sorry, the last seat for '.$out_trip->departure_location . ' to '. $out_trip->arrival_location .' trip got booked just after payment. Please screenshot this and please contact us at +23324 500 4247 / +23324 669 2117 to help us book you on another trip or refund your money as soon as possible.');
                        }
                        elseif ($in_rem_seats == 0) {
                            //refund money back to user and
                            return redirect()->back()->with('msg', 'Aww, so sorry, the last seat for '.$in_trip->departure_location . ' to '. $in_trip->arrival_location .' trip got booked just after payment. Please screenshot this and please contact us at +23324 500 4247 / +23324 669 2117 to help us book you on another trip or refund your money as soon as possible.');
                        }
                        else{

                        $out_rem_seats = $out_rem_seats - $passenger_num;
                        $in_rem_seats = $in_rem_seats - $passenger_num;
                        // update trips table
                        DB::table('trips')->where('id', $lpos )->update(['remaining_seats' => $out_rem_seats ]);
                        DB::table('trips')->where('id', $lpis )->update(['remaining_seats' => $in_rem_seats ]);

                        DB::table('return_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                        // user has made payment
                        DB::table('return_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);

                        DB::table('users')->where('id', Auth::user()->id )->update(['mobile_money_id' => $wallet->id ]);
                                


                        return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . $wallet->id, 'option' => $option]);
                        }
                    }
                    // if not logged in as user
                    else
                    {
                        $passenger = explode(" ", $traveler_id);
                        $bookers_id = $passenger[1];
                        $traveler = PassengerDetails::find($bookers_id);

                    
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'network' => $request->network,
                            'name' => $request->name,
                            'from_user' => null,
                            'from_passenger' => $bookers_id
                         ]);
                   

                $token = sprintf('%06d', mt_rand(100000,999999));

                $payment = HubtelPayment::ReceiveMoney()
                        ->from($request->phone_number) //- The phone number to send the prompt to. 
                        ->amount(0.10) //((float)$out_trip->trip_fare + (float)$in_trip->trip_fare)*$passenger_num - The exact amount value of the transaction
                        ->description('Online bus booking payment')    //- Description of the transaction.
                        ->customerName($booking->passenger->first_name . ' ' . $booking->passenger->last_name)     //- Name of the person making the payment.callback after payment. 
                        ->token($token)
                        ->channel($request->network)    //- The mobile network Channel.configuration
                        ->run(); 

                DB::table('return_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                    
                        
                    
                    $out_rem_seats = $out_trip->remaining_seats;
                    $out_rem_seats--;

                    
                    $in_rem_seats = $in_trip->remaining_seats;
                    $in_rem_seats--;

                    // update trips table
                    DB::table('trips')->where('id', $lpos )->update(['remaining_seats' => $out_rem_seats ]);
                    DB::table('trips')->where('id', $lpis )->update(['remaining_seats' => $in_rem_seats ]);

                    

                        return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $wallet->id, 'option' => $option]);
                    }
                }

        }
    }

    public function showPaymentSuccess($booking_id, $lpos, $lpis, $passenger_num, $traveler_id, $payment_id, $option)
    {
        $booking = ReturnBooking::find($booking_id);

        $outbound = Trips::find($lpos);

        $inbound = Trips::find($lpis);

        $passenger_details = "";

        $payment_details = "";

        $passenger = explode(" ", $traveler_id);
        $bookers_id = $passenger[1];

        $payment = explode(" ", $payment_id);

        if ($passenger[0] == 'user') 
        { 
            if (!Auth::user()) {
                $passenger_details = "session expired";
            }
            else
            {
                $passenger_details = User::where('id', Auth::user()->id)->first();
            }
        }
        elseif ($passenger[0] == 'passenger') 
        {
            $passenger_details = PassengerDetails::find($passenger[1]);
        }

        if ($option == 'card') 
        {
            $payment_details = CardDetails::find($payment[1]);
        }
        elseif ($option == 'wallet') 
        {
            $payment_details = MobileMoney::find($payment[1]);
        }

        $depart_abb = Station::where('name', $outbound->departure_location)->first();

        $arrive_abb = Station::where('name', $outbound->arrival_location)->first();

        $departure_abbreviation = ""; 
        $arrival_abbreviation = ""; 

        

        if ($depart_abb != null || $arrive_abb != null ) {
            $departure_abbreviation = $depart_abb->abbreviation;

            $arrival_abbreviation = $arrive_abb->abbreviation;
        }

        // days left to departure
        $booking = ReturnBooking::find($booking_id);
        $outbound = Trips::find($booking->outbound);

        $inbound = Trips::find($booking->inbound);

        $date_booked = Carbon::parse($booking->created_at);

        $departing_date = Carbon::parse($outbound->departure_date);

        $arriving_date = Carbon::parse($inbound->departure_date);

        $date = explode(" ", $booking->created_at);

        $days_left_to_departure = $departing_date->diffInDays($date_booked) . ' days';

        $days_left_to_arrival = $arriving_date->diffInDays($date_booked) . ' days';

        if (explode(" ",$days_left_to_departure)[0] <= 1) {
            $days_left_to_departure = $departing_date->diffInHours($date_booked) . ' hours';
            if (explode(" ", $days_left_to_departure)[0] <= 1 ) {
                $days_left_to_departure = $departing_date->diffInMinutes($date_booked) . ' mins';    
                if (explode(" ", $days_left_to_departure)[0] <= 1 ) {
                $days_left_to_departure = $departing_date->diffInSeconds($date_booked) . ' seconds';    
            
                }
            }
        }


        $from = urlencode("10ondrives");
        $to = urlencode($passenger_details->mobile_number);
        $ClientId1 = urlencode('ahntkmmu');
        $ClientSecret1 = urlencode('anxixrrt');

        $content = "";

        if (Auth::user()) {
            $content = urlencode('Congratulations '.$passenger_details->first_name .' '.$passenger_details->last_name. '! Your return booking has been issued with booking ID: RT'. $booking_id . '. You will be notified when check-in opens in '. $days_left_to_departure. ' for your trip from '.$outbound->departure_location .' to ' .$outbound->arrival_location.'.');
        }
        else
        {
            $content = urlencode('Congratulations '.$passenger_details->first_name .' '.$passenger_details->last_name. '! Your return booking has been issued with booking ID: RT'. $booking_id . '. You will be notified when check-in opens in '. $days_left_to_departure.' for your trip from '.$outbound->departure_location .' to ' .$outbound->arrival_location.'. Kindly sign up at '. route('register').' to start earning kilometers to your credit. ');
        }


        $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
        ); 

        $json = file_get_contents("https://{$ClientId1}:{$ClientSecret1}@api.hubtel.com/v1/messages/send?From={$from}&To={$to}&Content={$content}&ClientId={$ClientId1}ifrp&ClientSecret={$ClientSecret1}nml&RegisteredDelivery=true", false, stream_context_create($arrContextOptions));      



        return view('book.return-payment-success', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => $payment_id, 'option' => $option, 'booking' => $booking, 'outbound' => $outbound, 'inbound' => $inbound, 'passenger_details' => $passenger_details, 'payment_details' => $payment_details])->with('departure_abbreviation', $departure_abbreviation)->with('arrival_abbreviation', $arrival_abbreviation);
    }

    public function driveStatusShow($booking_id)
    {
        $booking = ReturnBooking::find($booking_id);
        $outbound = Trips::find($booking->outbound);

        $inbound = Trips::find($booking->inbound);

        $date_booked = Carbon::parse($booking->created_at);

        $departing_date = Carbon::parse($outbound->departure_date);

        $arriving_date = Carbon::parse($inbound->departure_date);

        $date = explode(" ", $booking->created_at);

        $days_left_to_departure = $departing_date->diffInDays($date_booked) . ' days';

        $days_left_to_arrival = $arriving_date->diffInDays($date_booked) . ' days';

        if (explode(" ",$days_left_to_departure)[0] <= 1) {
            $days_left_to_departure = $departing_date->diffInHours($date_booked) . ' hours';
            if (explode(" ", $days_left_to_departure)[0] <= 1 ) {
                $days_left_to_departure = $departing_date->diffInMinutes($date_booked) . ' mins';    
                if (explode(" ", $days_left_to_departure)[0] <= 1 ) {
                $days_left_to_departure = $departing_date->diffInSeconds($date_booked) . ' seconds';    
            
                }
            }
        }

        if (explode(" ",$days_left_to_arrival)[0] <= 1) {
            $days_left_to_arrival = $arriving_date->diffInHours($date_booked) . ' hours';
            if (explode(" ", $days_left_to_arrival)[0] <= 1 ) {
                $days_left_to_arrival = $arriving_date->diffInMinutes($date_booked) . ' mins';    
                if (explode(" ", $days_left_to_arrival)[0] <= 1 ) {
                $days_left_to_arrival = $arriving_date->diffInSeconds($date_booked) . ' seconds';    
            
                }
            }
        }

        return view('book.return-drive-status', ['booking' => $booking, 'outbound' => $outbound, 'inbound' => $inbound, 'date' => $date, 'days_left_to_departure' => $days_left_to_departure, 'days_left_to_arrival' => $days_left_to_arrival]);

    }
    
    public function departCheckin(Request $request) {
        $booking = ReturnBooking::find($request->booking_id);

        $checked_in = "";
        if ($booking->checked_in != "yes") {
            $checked_in = "yes";
        }
        else
        {
            $checked_in = null;
        }
        DB::table('return_booking_process')->where('id', $request->booking_id)->update(['depart_checked_in'=> $checked_in]);

        return 'success';

    }

    public function returnCheckin(Request $request) {
        $booking = ReturnBooking::find($request->booking_id);

        $checked_in = "";
        if ($booking->checked_in != "yes") {
            $checked_in = "yes";
        }
        else
        {
            $checked_in = null;
        }
        DB::table('return_booking_process')->where('id', $request->booking_id)->update(['return_checked_in'=> $checked_in]);

        return 'success';

    }


}
