<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;
use App\Trips;
use App\Booking;
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

class BookingController extends Controller
{
    

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
    	$lpos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' 2018')->orderBy('trip_fare')->get();

    	// lowest price inbounds (lpis)
    	$lpis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' 2018')->orderBy('trip_fare')->get();

    	// earliest departure outbounds (eos)
    	$eos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' 2018')->orderBy('departure_time')->get();

    	// earlest departure inbounds (eis)
    	$eis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' 2018')->orderBy('departure_time')->get();

    	// shortest duration outbounds (sdos)
    	$sdos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date . ' 2018')->orderBy('trip_duration_in_hrs')->get();

    	// sshortest duration inbounds (sdis)
    	$sdis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date . ' 2018')->orderBy('trip_duration_in_hrs')->get();

    	// array to store total cost for each outbound and inbound trip  
    	$combined_cost = array();

    	// loop through each collection to get trip costs and append their sum to $combine_cost array 
    	foreach ($lpos as $key => $lpo) {
            foreach ($lpis as $key => $lpi) {
            	// string key instead of int used to later split key's values
                 $combined_cost[$lpo->id . '-' . $lpi->id] = (float)$lpo->trip_fare + (float)$lpi->trip_fare;
            }
            
        }

        //sort combined_cost array values maintaining their keys
        asort($combined_cost);

        //append combined_cost keys to a keys array
        $combined_cost_keys = array_keys($combined_cost);

        //keys for lowest price departure LPDK and lowest price return LPRK
        $key_pairs = $LPDK = $LPRK = array();

    		foreach($combined_cost_keys as $keys) {
    		    $key_pairs = explode("-", $keys);
    		    // append EO id to EDK
    		    array_push($LPDK, $key_pairs[0]);

    		    // append EI id to ERK
    		    array_push($LPRK, $key_pairs[1]);
    		}

    		// convert collections to array for interations
    		$lpos_array = $lpos->toArray();
    		$lpis_array = $lpis->toArray();

		



    	$departure_abbreviation = Station::where('name', $request->departure_location)->first();

    	$arrival_abbreviation = Station::where('name', $request->arrival_location)->first();

		$depart_abb = ""; 
		$arrive_abb = ""; 

		

     	if ($departure_abbreviation != null || $arrival_abbreviation != null ) {
    		$depart_abb = $departure_abbreviation->abbreviation;

    		$arrive_abb = $arrival_abbreviation->abbreviation;
    	}


    	

    	return view('book.search-return-trips-results', compact(['lpos', 'lpis', 'combined_cost','LPDK', 'LPRK', 'lpos_array', 'combined_cost_keys']))->with('departure_location', $request->departure_location)->with('arrival_location', $request->arrival_location)->with('departure_date', $request->departure_date)->with('passenger_num', $request->passenger_num)->with('return_date', $request->return_date)->with('departure_abbreviation', $depart_abb)->with('arrival_abbreviation', $arrive_abb);
    }


    public function tripFound($lpos, $lpis, $passenger_num)
    {
        
        
        $booking = Booking::create([
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
            DB::table('booking_process')->where('id', $booking_id )->update(['user_id' => Auth::user()->id]);

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

            DB::table('booking_process')->where('id', $booking_id )->update(['passenger_id' => $passenger_details->id]);

            return redirect()->route('book.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => 'passenger' . ' ' .  $passenger_details->id]);
        }

        


    }

    public function paymentDetails($booking_id, $lpos, $lpis, $passenger_num, $traveler_id) 
    {

        $outbound = Trips::find($lpos);
        $inbound = Trips::find($lpis);

        return view('book.provide-payment-details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'outbound' => $outbound, 'inbound' => $inbound]);    
    }

    public function addPaymentDetails(Request $request, $booking_id, $lpos, $lpis, $passenger_num, $traveler_id, $option)
    {
        $booking = Booking::find($booking_id);

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

                    DB::table('booking_process')->where('id', $booking_id )->update(['card_id' => Auth::user()->card->id]);   

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

                    DB::table('booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);

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

                    DB::table('booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);


                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);

                }

            }
            // for mobile money users
            else
            {
                if (Auth::user() && Auth::user()->wallet) {

                    DB::table('booking_process')->where('id', $booking_id )->update(['mobile_money_id' => Auth::user()->wallet->id]); 
                      

                    // $payment = HubtelPayment::ReceiveMoney()
                    // ->from(Auth::user()->wallet->phone_number)//- The phone number to send the prompt to. 
                    // ->amount(1.00)                    //- The exact amount value of the transaction
                    // ->description('Online Booking Payment')    //- Description of the transaction.
                    // ->customerName(Auth::user()->first_name . ' ' . Auth::user()->last_name)     //- Name of the person making the payment.callback after payment. 
                    // ->channel('mtn-gh')                 //- The mobile network Channel.configuration
                    // ->run();  

                    

                    return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->wallet->id, 'option' => $option]);

                }
                elseif (Auth::user() && !Auth::user()->wallet)
                {


                    $passenger = explode(" ", $traveler_id);
                    $bookers_id = $passenger[1];

                    
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'email' => $request->email,
                            'password' => $request->password,
                            'from_user' => Auth::user()->id,
                            'from_passenger' => null
                         ]);
                   

                

                // $payment = HubtelPayment::ReceiveMoney()
                //         ->from($request->phone_number) //- The phone number to send the prompt to. 
                //         ->amount(0.20)                 //- The exact amount value of the transaction
                //         ->description('Online booking payment')    //- Description of the transaction.
                //         ->customerName($booking->passenger->first_name . ' ' . $booking->passenger->last_name)     //- Name of the person making the payment.callback after payment. 
                //         ->channel($request->network)    //- The mobile network Channel.configuration
                //         ->run();  
                        
                        DB::table('booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                        DB::table('users')->where('id', Auth::user()->id )->update(['mobile_money_id' => $wallet->id ]);
                            
                                $out_trip = Trips::find($lpos);
                                $out_rem_seats = $out_trip->remaining_seats;
                                $out_rem_seats--;

                                $in_trip = Trips::find($lpis);
                                $in_rem_seats = $in_trip->remaining_seats;
                                $in_rem_seats--;

                                // update trips table
                                DB::table('trips')->where('id', $lpos )->update(['remaining_seats' => $out_rem_seats ]);
                                DB::table('trips')->where('id', $lpis )->update(['remaining_seats' => $in_rem_seats ]);

                                


                                return redirect()->route('return.payment.success.show', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . $wallet->id, 'option' => $option]);
                    }
                    // if not logged in as user
                    else
                    {
                        $passenger = explode(" ", $traveler_id);
                        $bookers_id = $passenger[1];

                    
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'email' => $request->email,
                            'password' => $request->password,
                            'from_user' => null,
                            'from_passenger' => $bookers_id
                         ]);
                   

                

                // $payment = HubtelPayment::ReceiveMoney()
                //         ->from($request->phone_number) //- The phone number to send the prompt to. 
                //         ->amount(0.20)                 //- The exact amount value of the transaction
                //         ->description('Online booking payment')    //- Description of the transaction.
                //         ->customerName($booking->passenger->first_name . ' ' . $booking->passenger->last_name)     //- Name of the person making the payment.callback after payment. 
                //         ->channel($request->network)    //- The mobile network Channel.configuration
                //         ->run();  
                        
                        DB::table('booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                        
                            
                                $out_trip = Trips::find($lpos);
                                $out_rem_seats = $out_trip->remaining_seats;
                                $out_rem_seats--;

                                $in_trip = Trips::find($lpis);
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
        $booking = Booking::find($booking_id);

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


        return view('book.return-payment-success', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => $payment_id, 'option' => $option, 'booking' => $booking, 'outbound' => $outbound, 'inbound' => $inbound, 'passenger_details' => $passenger_details, 'payment_details' => $payment_details])->with('departure_abbreviation', $departure_abbreviation)->with('arrival_abbreviation', $arrival_abbreviation);
    }

    public function driveStatusShow($booking_id)
    {
        $booking = Booking::find($booking_id);
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
    



}
