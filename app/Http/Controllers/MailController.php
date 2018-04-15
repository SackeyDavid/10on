<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\TransportCompany;

class MailController extends Controller
{
    public function send($email, $name, $id, $client)
    {
    	$email_address = $email;
    	$recipient_name = $name;

    	

    	$transport_company = TransportCompany::find($id);

    	$customer = $client;

    	

    	$data = array('email'=> $email, 'name' => $name, 'from' => 'davidkofiahensackey@gmail.com', 'from_name' => '10ondrives.com');

    	Mail::send(['text' => 'mail.client-registered'], ['transport_company' => $transport_company, 'customer' => $customer], function($message) use ($data)
    	{

    		$message->to($data['email'], $data['name'])->subject('10ondrives.com :: Your Account Information');
    		$message->from($data['from'], $data['from_name']);
    	});

    	return redirect()->route('admin.dashboard')->with('msg', 'Client has been saved!');
    }
}
