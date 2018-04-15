<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportCompany;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transport_companies = TransportCompany::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin', compact('transport_companies'));
    }
}
