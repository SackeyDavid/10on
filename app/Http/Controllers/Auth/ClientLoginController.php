<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ClientLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:client', ['except'=> ['logout']]);
    }
    public function showLoginForm()
    {
        return view('auth.client-login');
    }

    public function login(Request $request)
    {
      //validate the form
    	$this->validate($request, [
    		'username' => 'required|string|max:255',
    		'password' => 'required|min:6'
    		]);

    	//attempt to log user in
    	if(Auth::guard('client')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
    	{

    		return redirect()->intended(route('client.dashboard'));
    	}


    	return redirect()->back()->withInput($request->only('username','remember'));
    }

    public function logout()
    {
      Auth::guard('client')->logout();

      return redirect('/');
    }
}
