<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
use App\TransportCompany;
use App\Admin;
use Mail;
use App\Client;
use Storage;
use Auth;

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


    	
    	
  //   	$input['super_admin'] = $request->super_admin;
    
  //       $input['username'] = $request->username;

  //       $input['email'] = $request->email;

  //       $input['for_transport_company'] = $request->for_transport_company;  

  //   	$input['password'] = str_random(10);

    	
         
		// Client::create($input);

		

		$id = $request->for_transport_company;

		// View::composer('mail.client-registered', function ($view) use ($id) {
  //            $transport_company = App\TransportCompany::find($id);
  //            $view->with('transport_company', $transport_company);
  // 		});

        $transport_company = TransportCompany::find($request->for_transport_company);

        $name = $transport_company->name;

        $email = $request->email;

        //$transport_company = TransportCompany::find($id);

    	$customer = $client;

    	

    	$data = array('email'=> $email, 'name' => $name, 'from' => 'davidkofiahensackey@gmail.com', 'from_name' => '10ondrives.com');

    	Mail::send('mail.client-registered', ['transport_company' => $transport_company, 'customer' => $customer, 'password' => $password ], function($message) use ($data)
    	{

    		$message->to($data['email'], $data['name'])->subject('10ondrives.com :: Your Account Information');
    		$message->from($data['from'], $data['from_name']);
    	});

    	return redirect()->route('admin.dashboard')->with('msg', 'Client has been saved!');
        //return redirect()->route('mail.send', $email, $name, $id, serialize($client));
	}


}
