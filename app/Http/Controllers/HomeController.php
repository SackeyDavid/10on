<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CardDetails;
use App\MobileMoney;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

   

    public function showPaymentDetailsForm()
    {
        return view('auth.payment-details-register', ['msg' => 'Welcome ' . Auth::user()->first_name . '! An email has been sent to you.']);
    }

    public function registerPaymentDetails(Request $request)
    {
         $card = CardDetails::create([
            'card_number' => $request->card_number,
            'security_code' => $request->security_code,
            'expiry_date' => $request->expiry_date,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'address_line_3' => $request->address_line_3

         ]); 

         DB::table('users')->where('id', Auth::user()->id )->update(['card_id' => $card->id]);

         return redirect('/payment/mobile/register'); 
    }

    public function showRegisterMobileDetails()
    {
        return view('auth.mobile-money-register', ['msg' => 'Thanks ' . Auth::user()->first_name . '! Card details have been saved']);
    }

    public function registerMobileDetails(Request $request)
    {
        $wallet = MobileMoney::create([
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'name' => $request->name,
            'network' => $request->network,
            'from_user' => Auth::user()->id,
            'from_passenger' => null
        ]);

        DB::table('users')->where('id', Auth::user()->id )->update(['wallet_id' => $wallet->id]);

        return redirect('/');
    }

    
}
