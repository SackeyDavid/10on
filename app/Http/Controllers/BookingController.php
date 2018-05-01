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

		// for($i=0; $i<$LPDK->count(); $i++)
  //           {
  //               for($j=0; $j<$lpos->count(); $j++)
  //               {
  //                   if($LPDK[i] == $lpos[j]->id)
  //                   for($m=0; $m<$LPRK->count(); $m++)
  //                   {
  //                       	for($n=0; $n<$lpis->count(); $n++)
  //                       	if($LPRK[i] == $lpos[j]->id$lr == $lpi->id)
  //                       	{

  //                       	}
  //                   }
  //               }
                
  //           }



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

    public function paymentDetails($booking_id, $lpos, $lpis, $passenger_num, $traveler_id) {

        $outbound = Trips::find($lpos);
        $inbound = Trips::find($lpis);

        return view('book.provide-payment-details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'outbound' => $outbound, 'inbound' => $inbound]);    
    }

    public function addPaymentDetails(Request $request, $booking_id, $lpos, $lpis, $passenger_num, $traveler_id, $option)
    {
        $config = new Config('HM2604180034', 'ahntkmmu', 'anxixrrt');
        if ($option == 'card') {

            if (Auth::user()) {

                DB::table('booking_process')->where('id', $booking_id )->update(['card_id' => Auth::user()->card->id]);   

                return redirect()->route('confirm.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->card->id, 'option' => $option]);         
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

                DB::table('booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);

                return redirect()->route('confirm.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);
            }

        }
        else
        {
            if (Auth::user()) {

                DB::table('booking_process')->where('id', $booking_id )->update(['mobile_money_id' => Auth::user()->wallet->id]); 
                  

                $payment = HubtelPayment::ReceiveMoney()
                ->from(Auth::user()->wallet->phone_number)                //- The phone number to send the prompt to. 
                ->amount(1.00)                    //- The exact amount value of the transaction
                ->description('Online Booking Payment')    //- Description of the transaction.
                ->customerName(Auth::user()->first_name . ' ' . Auth::user()->last_name)     //- Name of the person making the payment.callback after payment. 
                ->channel('mtn-gh')                 //- The mobile network Channel.configuration
                ->run();  

                return redirect()->route('confirm.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->card->id, 'option' => $option]);

            }
            else
            {
                    $passenger = explode(" ", $traveler_id);
                    $bookers_id = $passenger[1];

                    if ($passenger[0] == 'user') {
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'email' => $request->email,
                            'password' => $request->password,
                            'from_user' => Auth::user()->id,
                            'from_passenger' => null
                         ]);
                    }
                    else
                    {
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'email' => $request->email,
                            'password' => $request->password,
                            'from_user' => null,
                            'from_passenger' => $bookers_id
                         ]);
                    }

//                     $payment = HubtelPayment::ReceiveMoney()
//                             ->from()                //- The phone number to send the prompt to. 
//                             ->amount(0.20)                    //- The exact amount value of the transaction
//                             ->description('')    //- Description of the transaction.
//                             ->customerName()     //- Name of the person making the payment.callback after payment. 
//                             ->channel($request->network)                 //- The mobile network Channel.configuration
//                             ->run();  
//                     HUBTEL_ACCOUNT_NUMBER= 
// HUBTEL_CLIENT_ID=     
// HUBTEL_CLIENT_SECRET= 
// HUBTEL_CALLBACK_URL=http://10.18.222.165/10ondrives/public
// HUBTEL_SECONDARY_CALLBACK_URL=http://10.18.222.165/10ondrives/public/login
 DB::table('booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);
                        $receive_momo_request = array(
                              'CustomerName' => $request->name,
                              'CustomerMsisdn'=> '0246692117',
                              'CustomerEmail'=> 'davidkofiahensackey@gmail.com',
                              'Channel'=> 'mtn-gh',
                              'Amount'=> 1.00,
                              'PrimaryCallbackUrl'=> 'http://197.255.71.75/10ondrives/public',
                              'SecondaryCallbackUrl'=> 'http://197.255.71.75/10ondrives/public/login',
                              'Description'=> 'Online Booking Payment',
                              'ClientReference'=> '23213',
                        );

                        //API Keys

                        $clientId = 'ahntkmmu';
                        $clientSecret = 'anxixrrt';
                        $basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
                        $request_url = 'https://api.hubtel.com/v1/merchantaccount/merchants/HM2604180034/receive/mobilemoney';
                        $receive_momo_request = json_encode($receive_momo_request);

                        $ch =  curl_init($request_url);  
                                curl_setopt( $ch, CURLOPT_POST, true );  
                                curl_setopt( $ch, CURLOPT_POSTFIELDS, $receive_momo_request);  
                                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
                                curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                                    'Authorization: '.$basic_auth_key,
                                    'Cache-Control: no-cache',
                                    'Content-Type: application/json',
                                  ));

                        $result = curl_exec($ch); 
                        $err = curl_error($ch);
                        curl_close($ch);

                        if($err){
                            echo $err;
                             return view('errors', ['err' => $err, 'result' => null]);
                        }else{

                            // reduce number of remaining seats
    // $data  = array(
    //               'CustomerName' => $request->name,
    //               'CustomerMsisdn'=> '0246692117',
    //               'CustomerEmail'=> 'davidkofiahensackey@gmail.com',
    //               'Channel'=> 'mtn-gh',
    //               'Amount'=> 1.00,
    //               'PrimaryCallbackUrl'=> 'http://10.20.84.113/10ondrives/public',
    //               'SecondaryCallbackUrl'=> 'http://10.20.84.113/10ondrives/public/login',
    //               'Description'=> 'Online Booking Payment',
    //               'ClientReference'=> '23213',
    //                 );
                            $out_trip = Trips::find($lpos);
                            $out_rem_seats = $out_trip->remaining_seats;
                            $out_rem_seats--;

                            $in_trip = Trips::find($lpis);
                            $in_rem_seats = $in_trip->remaining_seats;
                            $in_rem_seats--;

                            // update trips table
                            DB::table('trips')->where('id', $lpos )->update(['remaining_seats' => $out_rem_seats ]);
                            DB::table('trips')->where('id', $lpis )->update(['remaining_seats' => $in_rem_seats ]);

                            $slydepay = new Slydepay\Slydepay("nafiu1994@gmail.com", "1490789001082");

                            // Create a list of OrderItems with OrderItem objects
                            $orderItems = new OrderItems([
                            new OrderItem("1234", "Test Product", 10, 2),
                            new OrderItem("1284", "Test Product2", 20, 2),
                            ]);

                            // Shipping and tax pulled either from ini/properties file. Hard coded here for illustration
                            $shippingCost = 20; 
                            $tax = 10;

                            // Create the Order object for this transaction. 
                            $order = Order::createWithId(
                            $orderItems,
                            "order_id_1", 
                            $shippingCost,
                            $tax,
                            "description",
                            "no comment"
                            );

                            $err = "";
                            try {
                            // Make request to Slydepay and get the response object for the redirect url
                            $response = $slydepay->processPaymentOrder($order);
                            echo $response->redirectUrl();
                            } catch (Slydepay\Exception\ProcessPayment $e) {
                            $err = $e->getMessage();
                            }


                             return view('errors', ['result' => $result ,'err' => $err]);
                        }
                    }

               

               

                // return redirect()->route('confirm.payment.details', ['booking_id' => $booking_id, 'lpos' => $lpos, 'lpis' => $lpis, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $wallet->id]);


            


        }

    }



}
