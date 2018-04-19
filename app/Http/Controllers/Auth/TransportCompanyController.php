<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
use App\TransportCompany;
use App\Admin;
use Mail;
use App\Client;
use App\Kilometers;
use Storage;
use Auth;
use DB;

class TransportCompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addTransportCompany(Request $request) 
    {
    	
    	$input['from_developer'] = Auth::user()->id;
    
        $input['name'] = $request->get('name');  
        $input['photo'] = $request->get('photo');  
    
        if ($request->hasFile('photo')){
        	 request()->validate([

            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);
            $featured_image = $request->file('photo');
            $filename = $featured_image->getClientOriginalName();
            $featured_image->move(public_path('/images/transport_companies_logo'), $filename);
            $input['photo'] = $filename;
         }

    	TransportCompany::create( $input );

    	
        return redirect()->back()->with('msg', 'Transport Company has been saved!');

    
    	
    }

    public function addClient(Request $request) 
    {

    	$password = str_random(10);

    	$client = CLient::create([
            'super_admin' => $request->super_admin,
            'username' => $request->username,
            'email' => $request->email,
            'for_transport_company' => $request->for_transport_company,
            'password' => $password
        ]);
    	
    	
  
		$id = $request->for_transport_company;


        $transport_company = TransportCompany::find($request->for_transport_company);

        $name = $transport_company->name;

        $email = $request->email;

        
    	$customer = $client;

    	

    	$data = array('email'=> $email, 'name' => $name, 'from' => 'davidkofiahensackey@gmail.com', 'from_name' => '10ondrives.com');

    	Mail::send('mail.client-registered', ['transport_company' => $transport_company, 'customer' => $customer, 'password' => $password ], function($message) use ($data)
    	{

    		$message->to($data['email'], $data['name'])->subject('10ondrives.com :: Your Account Information');
    		$message->from($data['from'], $data['from_name']);
    	});

    	return redirect()->route('admin.dashboard')->with('msg', 'Client has been saved!');
        
	}

    public function addKilometer(Request $request, $id) 
    {
        
        $duration_via_automobile = "";

            if ($request->duration_via_automobile_hrs <= 1 && $request->duration_via_automobile_mins <= 0) 
            {
                 $duration_via_automobile = $request->duration_via_automobile_hrs . ' hr ' . $request->duration_via_automobile_mins . ' min';
            }
            else 
            {
               
                 $duration_via_automobile = $request->duration_via_automobile_hrs . ' hrs ' . $request->duration_via_automobile_mins . ' mins';
            }

            $kilometer = Kilometers::create([
            'from' => $request->from,
            'from_developer' => Auth::user()->id,
            'to' => $request->to,
            'via' => $request->via,
            'kilometers' => $request->kilometers,
            'duration_via_automobile' => $duration_via_automobile,
            'for_trip' => $id

            ]);

            DB::table('trips')->where('id', $id)->update(['kilometers' => $request->kilometers]);

        return redirect()->route('admin.dashboard')->with('msg', 'Kilometer has been saved and Trip updated!');

    }

    public function deleteKilometer($id, $for_trip) 
    {
            $kilometer = Kilometers::find($id);

            $kilometer->delete();
            

            DB::table('trips')->where('id', $for_trip)->update(['kilometers' => null]);

        return redirect()->route('admin.dashboard')->with('msg', 'Kilometer has been deleted and Trip updated!');

    }

}
