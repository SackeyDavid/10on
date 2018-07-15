<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trips;
use DB;
use Pagination;
use App\OneWayBookingProcess;
use App\ReturnBooking;
use Auth;
use App\MobileMoney;
use OVAC\LaravelHubtelPayment\Facades\HubtelPayment;
use App\User;
use \Carbon\Carbon;
use App\PassengerDetails;
use Input;

class SearchController extends Controller
{
    public function search(Request $request) {

    	$search_item = $request->ow_arrival_station;

        $departure = $request->ow_departure_station;

        $passenger_num = $request->ow_passenger_num;

        if($request->ajax())
        {
            
            
            // $output = Trips::all();
            // foreach ($output as $key => $value) {
            //     $dep_date = $value->departure_date;

            //     $id = $value->id;
                
            //     $dep_date = $dep_date . ' ' . date('Y'); 
            //     DB::table('trips')->where('id', $id )->update(['departure_date' => $dep_date]);

            //     $arr_date = $value->arrival_date;

            
                
            //     $arr_date = $arr_date . ' ' . date('Y'); 
            //     DB::table('trips')->where('id', $id )->update(['arrival_date' => $arr_date]);
            // }

            $trips = Trips::where('departure_location', $request->ow_departure_station)->where('arrival_location', $request->ow_arrival_station)->where('departure_date', $request->ow_date)->orderBy('trip_fare')->paginate(12); 

            return view('book.one-way-search-results', compact('trips','search_item','departure', 'passenger_num'))->render();
            }


            	
		
    }

    public function tripFound($trip_id, $passenger_num)
    {
                

                $trip = Trips::find($trip_id);
                $remaining_seats = $trip->remaining_seats - $passenger_num;
                if ($remaining_seats < 0) {
                     return redirect()->back()->withInput(Input::all())->with('msg', 'Oops, 0 seats left for the trip you chose');
                 } 
                 else
                 {
                    $booking = OneWayBookingProcess::create([
                        'trip_id' => $trip_id,
                        ]);
                    return view('book.oneway.ow-provide-personal-details')->with('booking_id', $booking->id)->with('passenger_num', $passenger_num);
                 }
    }

    public function onewayPersonalDetails($booking_id, $passenger_num)
    {
        return view('book.oneway.ow-provide-personal-details', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num]);
    }

    public function addPassengerDetails(Request $request, $booking_id, $passenger_num) 
    {
        // get trip from booking_id parameter
        $booking = OneWayBookingProcess::find($booking_id);

        $trip = Trips::find($booking->trip_id);

        $remaining_seats = $trip->remaining_seats - $passenger_num;

        if ($remaining_seats < 0) {

            return redirect()->back()->withInput(Input::all())->with('msg', 'Oops, 0 seats left for the trip you chose. Kindly choose another trip.');

        }
        else
        {

        if (Auth::user()) {
            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['user_id' => Auth::user()->id]);

             return redirect()->route('oneway.book.payment.details', ['booking_id' => $booking_id,'passenger_num' => $passenger_num, 'traveler_id' => 'user' . ' ' . Auth::user()->id ]);
        }
        else
        {
            $passenger_details = PassengerDetails::create([
                'title' => $request->ow_title,
                'first_name' => $request->ow_first_name,
                'last_name' => $request->ow_last_name,
                'email' => $request->ow_email,
                'contact_person' => $request->ow_contact_person,
                'country' => $request->ow_country,
                'mobile_number' => $request->ow_mobile_number,
                'remind_me' => $request->ow_remind_me,
                
              ]);

            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['passenger_id' => $passenger_details->id]);

            // we refer to unregistered users as passengers 
            return redirect()->route('oneway.book.payment.details', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => 'passenger' . ' ' .  $passenger_details->id]);
        }

        
        }

    }

    public function paymentDetails($booking_id, $passenger_num, $traveler_id) {

        $booking = OneWayBookingProcess::find($booking_id);
        $trip = Trips::find($booking->trip_id);

        return view('book.oneway.ow-provide-payment-details', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'trip' => $trip]);    
    }

    public function addPaymentDetails(Request $request, $booking_id, $passenger_num, $traveler_id, $option)
    {
        $booking = OneWayBookingProcess::find($booking_id);

        $trip = Trips::find($booking->trip_id);

        $remaining_seats = $trip->remaining_seats - $passenger_num;

        if ($remaining_seats < 0) 
        {
            return redirect()->back()->withInput(Input::all())->with('msg', 'Oops, 0 seats left for the trip you chose. Kindly choose another trip.');
        }
        else
        {
            // if payment option is card
            if ($option == 'card') 
            {
                // if logged in as user and with card id
                if (Auth::user() && Auth::user()->card) {

                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['card_id' => Auth::user()->card->id]);   

                    return redirect()->route('oneway.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->card->id, 'option' => $option]);         
                }  
                // if logged in as user and with no card id 
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


                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);

                    //card payment processing goes here


                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);

                    DB::table('users')->where('id', Auth::user()->id )->update(['card_id' => $payment->id ]);

                    return redirect()->route('oneway.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);
                }
                // if not logged in as user 
                elseif (!Auth::user())
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

                    // card payment processing goes here

                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['card_id' => $payment->id ]);

                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);

                    return redirect()->route('oneway.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $payment->id, 'option' => $option]);
                }
                // otherwise do nothing
                else {
                    return redirect()->back()->withInput(Input::all());
                }

            }
            // else payment option is wallet
            else
            {
                // if logged in as user and has wallet details already
                if (Auth::user() && Auth::user()->wallet) 
                {

                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => Auth::user()->wallet->id]); 
                      

                    // $payment = HubtelPayment::ReceiveMoney()
                    // ->from(Auth::user()->wallet->phone_number)//- The phone number to send the prompt to. 
                    // ->amount($trip->trip_fare*$passenger_num)                    //- The exact amount value of the transaction
                    // ->description('Online Booking Payment')    //- Description of the transaction.
                    // ->customerName(Auth::user()->first_name . ' ' . Auth::user()->last_name)     //- Name of the person making the payment.callback after payment. 
                    // ->channel(Auth::user()->wallet->network)                 //- The mobile network Channel.configuration
                    // ->run();  

                    DB::table('one_way_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);

                    return redirect()->route('one_way.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'user' . ' ' . Auth::user()->wallet->id, 'option' => $option]);

                } 
                // else if logged in as user but has no wallet details  
                elseif (Auth::user() && !Auth::user()->wallet) 
                {
                    $passenger = explode(" ", $traveler_id);
                    $bookers_id = $passenger[1];
                    $wallet = "";
                    
                    // probably user wasn't logged in during the provision of passenger details
                    if ($booking->user->email) 
                    {

                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'name' => $request->name,
                            'email' => $booking->user->email,
                            'network' => $request->network,
                            'from_user' => Auth::user()->id,
                            'from_passenger' => null
                         ]);
                    }
                    else
                    {
                    
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'name' => $request->name,
                            'email' => $booking->passenger->email,
                            'network' => $request->network,
                            'from_user' => Auth::user()->id,
                            'from_passenger' => null
                         ]);
                    }
                    

                    // $payment = HubtelPayment::ReceiveMoney()
                    //         ->from($request->phone_number) //- The phone number to send the prompt to. 
                    //         ->amount($trip->trip_fare*$passenger_num)                 //- The exact amount value of the transaction
                    //         ->description('Online booking payment')    //- Description of the transaction.
                    //         ->customerName(Auth::user()->first_name . ' ' . Auth::user()->last_name)     //- Name of the person making the payment.callback after payment. 
                    //         ->channel($request->network)    //- The mobile network Channel.configuration
                    //         ->run();  
                            
                            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);

                            DB::table('users')->where('id', Auth::user()->id )->update(['mobile_money_id' => $wallet->id ]);
                                
                                    $rem_seats = $trip->remaining_seats;
                                    $rem_seats = $rem_seats - $passenger_num;

                                if ($rem_seats < 0) {
                                        //refund money back to user and
                                    return redirect()->back()->with('msg', 'Oops, so sorry, all seats booked just after payment. Your money is being refunded');
                                }
                                else{

                                    // update trips table
                                    DB::table('trips')->where('id', $trip->id )->update(['remaining_seats' => $rem_seats ]);
                                    
                                    
                                    //passenger means concerned details are not 

                                return redirect()->route('one_way.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $wallet->id, 'option' => $option]);
                                }
                }
                else // if not logged in as a user
                {
                    $passenger = explode(" ", $traveler_id);
                    $bookers_id = $passenger[1];

                    // $passenger = explode(" ", $traveler_id);
                    // $bookers_id = $passenger[1];

                    // if user is not logged in at this instance then they weren't logged in the the previous instance
                   
                        $wallet = MobileMoney::create([
                            'phone_number' => $request->phone_number,
                            'name' => $request->name,
                            'email' => $booking->passenger->email,
                            'network' => $request->network,
                            'from_user' => null,
                            'from_passenger' => $bookers_id
                         ]);
                    

                    

                    // $payment = HubtelPayment::ReceiveMoney()
                    //         ->from($request->phone_number) //- The phone number to send the prompt to. 
                    //         ->amount($trip->trip_fare*$passenger_num)                 //- The exact amount value of the transaction
                    //         ->description('Online booking payment')    //- Description of the transaction.
                    //         ->customerName($booking->passenger->first_name . ' ' . $booking->passenger->last_name)     //- Name of the person making the payment.callback after payment. 
                    //         ->channel($request->network)    //- The mobile network Channel.configuration
                    //         ->run();  
                            
                            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['mobile_money_id' => $wallet->id ]);

                            DB::table('one_way_booking_process')->where('id', $booking_id )->update(['made_payment' => 'yes']);
                                
                                    
                                    $rem_seats = $trip->remaining_seats;
                                    $rem_seats = $rem_seats - $passenger_num;

                                if ($rem_seats < 0) {
                                        //refund money back to user
                                    return redirect()->back()->with('msg', 'Oops, so sorry, all seats booked just after payment. Your money is being refunded');
                                }
                                else
                                {

                                    // update trips table
                                    DB::table('trips')->where('id', $trip->id )->update(['remaining_seats' => $rem_seats ]);
                                    

                                    return redirect()->route('one_way.payment.success.show', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => 'passenger' . ' ' . $wallet->id, 'option' => $option]);
                                }
                    }//end of else for user not logged in and is paying using mobile money
                }// end of else for wallet option
            }//end of else for availablity of seats

    }// end of add payment function

    public function showPaymentSuccess($booking_id, $passenger_num, $traveler_id, $payment_id, $option)
    {
                $booking = OneWayBookingProcess::find($booking_id);

                $trip = Trips::find($booking->trip_id);

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
                    $passenger_details = PassengerDetails::find($passenger[1])->first();
                }

                if ($option == 'card') 
                {
                    $payment_details = CardDetails::find($payment[1]);
                }
                elseif ($option == 'wallet') 
                {
                    $payment_details = MobileMoney::find($payment[1]);
                }

                $date_booked = Carbon::parse($booking->created_at);
                $departing_date = Carbon::parse($trip->departure_date);

                $days_left = $departing_date->diffInDays($date_booked) . ' days';
                if (explode(" ",$days_left)[0] <= 1) {
                    $days_left = $departing_date->diffInHours($date_booked) . ' hours';
                    if (explode(" ", $days_left)[0] <= 1 ) {
                        $days_left = $departing_date->diffInMinutes($date_booked) . ' mins';    
                        if (explode(" ", $days_left)[0] <= 1 ) {
                        $days_left = $departing_date->diffInSeconds($date_booked) . ' seconds';    
                    
                        }
                    }
                }




                return view('book.oneway.payment-success', ['booking_id' => $booking_id, 'passenger_num' => $passenger_num, 'traveler_id' => $traveler_id, 'payment_id' => $payment_id, 'option' => $option, 'booking' => $booking, 'trip' => $trip, 'passenger_details' => $passenger_details, 'payment_details' => $payment_details, 'days_left' => $days_left]);
    }

    public function driveStatusShow()
    {
        if (Auth::user()) {

            $ow_bookings = OneWayBookingProcess::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            $rt_bookings = ReturnBooking::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            $ow_trip_dates = array();

            foreach ($ow_bookings as $value) {
                // array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[3] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
                
            }

            $rt_outbound_dates = array();

            $rt_inbound_dates = array();

            foreach ($rt_bookings as $value) {
                // array_push($rt_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->departing->departure_date)[3] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }

                $trip_date = explode(" ", $value->returning->departure_date)[3] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
                
            }

            
            // merge both rt future trip dates
            $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);

            // merge both ow and rt futures trip dates
            $combined_trip_dates = array_merge($ow_trip_dates, $combined_return_trip_dates); 

            $combined_trip_dates = array_unique($combined_trip_dates);

            // sort both ow and rt future trip dates in descencing(ie most recent) order
            usort($combined_trip_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });


            
            return view('book.oneway.drive-status', compact('ow_bookings', 'rt_bookings', 'combined_trip_dates'));
 
        }
        else {
            return redirect()->back()->with('msg', "Sorry, you're not logged in");
        }
        
    }

    public function showMyTrips() {

        
        $owbookings = '';
        $rtbookings = '';
        $traveler_user = '';
        $traveler_passenger = '';

        if (Auth::user()) {

            $traveler_user_email = Auth::user()->email;
            $traveler_user_mobile_number = Auth::user()->mobile_number;

            // oneway-bookings
            $onewaybookings = OneWayBookingProcess::orderBy('created_at', 'DESC')->get();

            $owbookings_for_email = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $owbookings_for_mobile_number = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $owbookings = $owbookings_for_email->merge($owbookings_for_mobile_number);

            $owbookings->all();

            $uniqueOWs = $owbookings;

            $ow_dates_array = array();

            $ow_trip_dates = array();

            foreach ($uniqueOWs as $value) {
                //array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[3] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
                if ($diffDays >= 1) {
                   array_push($ow_dates_array, date('Ymd', $trip_date));
                }
                
            }

            $ow_dates_array = array_unique($ow_dates_array);


            // Return-bookings
            $returnbookings = ReturnBooking::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            $rtbookings_for_email = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $rtbookings_for_mobile_number = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $rtbookings = $rtbookings_for_email->merge($rtbookings_for_mobile_number);

            $rtbookings->all();

            $uniqueRTs = $returnbookings;

            $rt_dates_array = array();

            $rt_outbound_dates = array();

            $rt_inbound_dates = array();
            $test = '';

            foreach ($uniqueRTs as $value) {
                

                $trip_date = explode(" ", $value->departing->departure_date)[1] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[3];
                
                $trip_date = strtotime($trip_date);

                // $trip_date+= 1209600; // add two weeks to get actual date
                $test = date('Ymd', $trip_date);

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }
                if ($diffDays >= 1) {
                   array_push($rt_dates_array, date('Ymd', $trip_date));
                }

                $trip_date = explode(" ", $value->returning->departure_date)[1] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[3];
                $trip_date = strtotime($trip_date);
                // $trip_date+= 1209600; // add two weeks to get actual date

                
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
                if ($diffDays >= 1) {
                   array_push($rt_dates_array, date('Ymd', $trip_date));
                }
                
            }

            $rt_dates_array = array_unique($rt_dates_array);

            $combined_past_trips = array_merge($rt_dates_array, $ow_dates_array);

            // avoid duplicates
            $combined_past_trips = array_unique($combined_past_trips);

            // sort both dates in ascending order
            usort($combined_past_trips, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });

            // merge both rt future trip dates
            $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);

            // merge both ow and rt futures trip dates
            $combined_trip_dates = array_merge($combined_return_trip_dates, $ow_trip_dates); 

            // avoid duplicates in future dates
            $combined_trip_dates = array_unique($combined_trip_dates);

            // sort both ow and rt future trip dates in descencing(ie most recent) order
            usort($combined_trip_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });

            return view('book.oneway.my-trips', ['uniqueOWs' => $uniqueOWs, 'uniqueRTs' => $uniqueRTs, 'combined_trip_dates' => $combined_trip_dates, 'combined_past_trips' => $combined_past_trips, 'rt_inbound_dates' => $rt_inbound_dates, 'test' => $test]);  

        }
        else {

        return redirect()->back()->with('msg', "Oops, you're logged out.");

        }

        
        
    }

    // delete history function also works for deleting oneway bookings from manage-booking view
    public function deleteHistory(Request $request) {
        $toDelete = OneWayBookingProcess::find($request->booking_id);
        $toDelete->delete();
        return 'success';
    }

    public function deleteReturnBooking(Request $request) {
        $toDelete = ReturnBooking::find($request->booking_id);
        $toDelete->delete();
        return 'success';
    }

    // public function deleteReturnTrip(Request $request) {
    //     $toDelete = ReturnBooking::find($request->booking_id);
    //     $toDelete->delete();
    //     return 'success';
    // }

    public function manageBooking() {


        if (Auth::user()) {

            $traveler_user_email = Auth::user()->email;
            $traveler_user_mobile_number = Auth::user()->mobile_number;

            // oneway-bookings
            $onewaybookings = OneWayBookingProcess::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            $owbookings_for_email = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $owbookings_for_mobile_number = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $owbookings = $owbookings_for_email->merge($owbookings_for_mobile_number);

            $owbookings->all();

            $uniqueOWs = $owbookings;

            $ow_dates_array = array();


            $ow_trip_dates = array(); 
            // represents one way booked trip dates whose departure date is either today or in the future

            foreach ($uniqueOWs as $value) {
                // array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[1] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[3];
                $trip_date = strtotime($trip_date);
                // $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
                
            }

            // $ow_dates_array = array_unique($ow_dates_array);

            // rt bookings
                // Return-bookings
            $returnbookings = ReturnBooking::orderBy('created_at', 'DESC')->get();
            $rtbookings_for_email = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $rtbookings_for_mobile_number = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $rtbookings = $rtbookings_for_email->merge($rtbookings_for_mobile_number);

            $rtbookings->all();

            $uniqueRTs = $rtbookings;

            // $rt_dates_array = array();

            $rt_outbound_dates = array();

            $rt_inbound_dates = array();

            foreach ($uniqueRTs as $value) {
                // array_push($rt_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->departing->departure_date)[1] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[3];
                $trip_date = strtotime($trip_date);
                // $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }

                $trip_date = explode(" ", $value->returning->departure_date)[1] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[3];
                $trip_date = strtotime($trip_date);
                // $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
                
            }

            // $rt_dates_array = array_unique($rt_dates_array);

            // $combined_booking_dates = array_merge($rt_dates_array, $ow_dates_array);

            // // avoid duplicates
            // $combined_booking_dates = array_unique($combined_booking_dates);

            // // sort both dates in ascending order
            // usort($combined_booking_dates, function($a, $b) {
            //     return strtotime($b) - strtotime($a);
            // });

            // merge both rt future trip dates
            $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);

            // merge both ow and rt futures trip dates
            $combined_trip_dates = array_merge($combined_return_trip_dates, $ow_trip_dates); 

            $combined_trip_dates = array_unique($combined_trip_dates);

            // sort both ow and rt future trip dates in descencing(ie most recent) order
            usort($combined_trip_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });

            // rt bookings

            return view('book.manage-booking', ['uniqueOWs' => $uniqueOWs, 'uniqueRTs' => $uniqueRTs, 'combined_trip_dates' => $combined_trip_dates]);

        }
        else
        {
            return redirect()->back()->with('msg', "Oops, You're currently logged out.");
        }

        
    }

    public function searchHistory(Request $request) {

        $search_history = $request->search_history;
        
        // $departure = $request->ow_departure_station;

        // $passenger_num = $request->ow_passenger_num;

        if ($search_history == "") {

            $traveler_user_email = Auth::user()->email;
            $traveler_user_mobile_number = Auth::user()->mobile_number;

            // oneway-bookings
            $onewaybookings = OneWayBookingProcess::orderBy('created_at', 'DESC')->get();

            $owbookings_for_email = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $owbookings_for_mobile_number = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $owbookings = $owbookings_for_email->merge($owbookings_for_mobile_number);

            $owbookings->all();

            $uniqueOWs = $owbookings;

            $ow_dates_array = array();

            $ow_trip_dates = array();

            foreach ($uniqueOWs as $value) {
                array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[3] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
                
            }

           $ow_dates_array = array_unique($ow_dates_array);


            // Return-bookings
            $returnbookings = ReturnBooking::orderBy('created_at', 'DESC')->get();
            $rtbookings_for_email = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $rtbookings_for_mobile_number = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $rtbookings = $rtbookings_for_email->merge($rtbookings_for_mobile_number);

            $rtbookings->all();

            $uniqueRTs = $rtbookings;

            $rt_dates_array = array();

            $rt_outbound_dates = array();

            $rt_inbound_dates = array();

            foreach ($uniqueRTs as $value) {
                array_push($rt_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->departing->departure_date)[3] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }

                $trip_date = explode(" ", $value->returning->departure_date)[3] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
                
            }

            $rt_dates_array = array_unique($rt_dates_array);

            $combined_booking_dates = array_merge($rt_dates_array, $ow_dates_array);

            // avoid duplicates
            $combined_booking_dates = array_unique($combined_booking_dates);

            // sort both dates in ascending order
            usort($combined_booking_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });

            // merge both rt future trip dates
            $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);

            // merge both ow and rt futures trip dates
            $combined_trip_dates = array_merge($ow_trip_dates, $combined_return_trip_dates); 

            // sort both ow and rt future trip dates in descencing(ie most recent) order
            usort($combined_trip_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });


            return view('book.one-way-history-results-for-no-input', ['uniqueOWs' => $uniqueOWs, 'uniqueRTs' => $uniqueRTs, 'combined_trip_dates' => $combined_trip_dates, 'combined_booking_dates' => $combined_booking_dates]);  

        }

        if($request->ajax())
        {
            
            
            // ow bookings
            $owbookings = OneWayBookingProcess::where('user_id', Auth::user()->id)->whereHas('trip', function ($query) use ($search_history){
                    $query->where('departure_location', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_location', 'LIKE', '%'. $search_history . '%')->orWhere('departure_date', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_date', 'LIKE', '%'. $search_history . '%')->orWhere('departure_time', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_time', 'LIKE', '%'. $search_history . '%')->orWhere('kilometers', 'LIKE', '%'.  $search_history . '%')->orWhere('trip_duration_in_hrs', 'LIKE', '%'. $search_history . '%')->orWhere('trip_fare', 'LIKE', '%'. $search_history . '%')->orderBy('trip_fare');
                })->get(); 

            // return bookings
            $rtbookings_departing = ReturnBooking::where('user_id', Auth::user()->id)->whereHas('departing', function ($query) use ($search_history){
                    $query->where('departure_location', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_location', 'LIKE', '%'. $search_history . '%')->orWhere('departure_date', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_date', 'LIKE', '%'. $search_history . '%')->orWhere('departure_time', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_time', 'LIKE', '%'. $search_history . '%')->orWhere('kilometers', 'LIKE', '%'.  $search_history . '%')->orWhere('trip_duration_in_hrs', 'LIKE', '%'. $search_history . '%')->orWhere('trip_fare', 'LIKE', '%'. $search_history . '%')->orderBy('trip_fare');
                })->get();

            $rtbookings_returning = ReturnBooking::where('user_id', Auth::user()->id)->whereHas('returning', function ($query) use ($search_history){
                    $query->where('departure_location', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_location', 'LIKE', '%'. $search_history . '%')->orWhere('departure_date', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_date', 'LIKE', '%'. $search_history . '%')->orWhere('departure_time', 'LIKE', '%'. $search_history . '%')->orWhere('arrival_time', 'LIKE', '%'. $search_history . '%')->orWhere('kilometers', 'LIKE', '%'.  $search_history . '%')->orWhere('trip_duration_in_hrs', 'LIKE', '%'. $search_history . '%')->orWhere('trip_fare', 'LIKE', '%'. $search_history . '%')->orderBy('trip_fare');
                })->get(); 

           $rtbookings = $rtbookings_departing->merge($rtbookings_returning);

            // get owbookings dates
            $ow_dates_array = array();

            foreach ($owbookings as $value) {
                array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));
                
            }

            // get rtbookings dates
            $rt_dates_array = array();

            foreach ($owbookings as $value) {
                array_push($rt_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));
                
            }

            $rt_dates_array = array_unique($rt_dates_array);

            $combined_booking_dates = array_merge($rt_dates_array, $ow_dates_array);

            // avoid duplicates
            $combined_booking_dates = array_unique($combined_booking_dates);

            // sort both dates in ascending order
            usort($combined_booking_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });

            // $owbookings = $trips->filter(function(Trips $entry) {
            //                     return $entry['user_id'] == Auth::user()->id;
            // });

            $owbookings = $owbookings->unique();

            // $owbookings->paginate(12);

            // foreach ($trips as $trip) {
            //     foreach ($trip->owbookings as $owbooking) {
            //         if ($owbooking->user_id == Auth::user()->id) {
                        
            //         }
            //     }
                
            // }

            return view('book.one-way-history-results', compact('owbookings', 'rtbookings', 'search_history', 'combined_booking_dates'))->render();
            }


                
        
    }

    public function editBooking(Request $request) {

        $input['title'] = $request->title;
        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['email'] = $request->email;
        $input['country'] = $request->country;
        $input['mobile_number'] = $request->mobile_number;
        $input['contact_person'] = $request->contact_person;
        $input['remind_me'] = $request->remind_me;

        // update personal info
        DB::table('users')->where('id', Auth::user()->id)->update($input);


        $input1['phone_number'] = $request->mobile_number;
        $input1['network'] = $request->network;


        // update payment info
        DB::table('mobile_money_details')->where('from_user', Auth::user()->id)->update($input1);

        //set flash data with success message
        // Session::flash('success', 'Your booking info has been successfully edited');



        // redirect with flash data to showProfile
        return redirect()->back()->with('msg', 'Booking Info has been edited');
        
    }

    // this function shows the bus travelers will used for the active trips
    public function showBus() {

        if (Auth::user()) {

            $traveler_user_email = Auth::user()->email;
            $traveler_user_mobile_number = Auth::user()->mobile_number;

            // oneway-bookings
            $onewaybookings = OneWayBookingProcess::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            $owbookings_for_email = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $owbookings_for_mobile_number = $onewaybookings->filter(function(OneWayBookingProcess $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $owbookings = $owbookings_for_email->merge($owbookings_for_mobile_number);

            $owbookings->all();

            $uniqueOWs = $owbookings;

            //$ow_dates_array = array();


            $ow_trip_dates = array(); // represents one way booked trip dates whose departure date is either today or in the future

            foreach ($uniqueOWs as $value) {
                // array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[3] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
                
            }

            // $ow_dates_array = array_unique($ow_dates_array);    

            // Return-bookings
            $returnbookings = ReturnBooking::orderBy('created_at', 'DESC')->get();
            $rtbookings_for_email = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_email){
                                return $entry->user['email'] == $traveler_user_email;
            });

            $rtbookings_for_mobile_number = $returnbookings->filter(function(ReturnBooking $entry) use ($traveler_user_mobile_number){
                                return $entry->user['mobile_number'] == $traveler_user_mobile_number;
            });

            $rtbookings = $rtbookings_for_email->merge($rtbookings_for_mobile_number);

            $rtbookings->all();

            $uniqueRTs = $rtbookings;

    

            $rt_outbound_dates = array();

            $rt_inbound_dates = array();

            foreach ($uniqueRTs as $value) {
                
                $trip_date = explode(" ", $value->departing->departure_date)[3] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }

                $trip_date = explode(" ", $value->returning->departure_date)[3] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[1];
                $trip_date = strtotime($trip_date);
                $trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
                
            }


            // merge both rt future trip dates
            $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);

            // merge both ow and rt futures trip dates
            $combined_trip_dates = array_merge($combined_return_trip_dates, $ow_trip_dates); 

            // sort both ow and rt future trip dates in descencing(ie most recent) order
            usort($combined_trip_dates, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });



            return view('bus', ['uniqueOWs' => $uniqueOWs, 'uniqueRTs' => $uniqueRTs, 'combined_trip_dates' => $combined_trip_dates]);

        }
        else
        {
            return redirect()->back()->with('msg', "Oops, You're currently logged out.");
        }
        
    }



}
