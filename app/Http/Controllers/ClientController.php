<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Fare;
use App\Bus;
use App\Trips;
use App\SpecialFeatures;
use App\Station;
use Auth;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client');
    }

    public function addTrip(Request $request)
    {
        $fare = Trips::create([
            'from_client' => Auth::user()->id,
            'departure_location' => $request->departure_location,
            'arrival_location' => $request->arrival_location,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'departure_date' => $request->departure_date,
            'arrival_date' => $request->arrival_date,
            'remaining_seats' => $request->remaining_seats,
            'via' => $request->via,
            'trip_duration_in_hrs' => $request->trip_duration_in_hrs,
            'trip_cost_id' => $request->trip_cost_id,
            'trip_cost' => $request->trip_cost,
            'bus_id' => $request->bus_id,
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Trip has been saved!');
    }

    public function addFare(Request $request)
    {
        $fare = Fare::create([
            'from_client' => Auth::user()->id,
            'start_point' => $request->start_point,
            'destination' => $request->destination,
            'road_fare' => $request->road_fare,
            'carrier_imposed_charges' => $request->carrier_imposed_charges,
            'total_tax' => $request->total_tax,
            'total_per_passenger' => $request->total_per_passenger
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Fare has been saved!');
    }

    public function addBus(Request $request)
    {
        $fare = Bus::create([
            'from_client' => Auth::user()->id,
            'bus_number' => $request->bus_number,
            'capacity' => $request->capacity,
            'photo' => $request->photo,
            'brand_name' => $request->brand_name,
            'driver' => $request->driver
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Bus has been saved!');
    }

    public function addSpecialFeatures(Request $request)
    {
        $fare = SpecialFeatures::create([
            'from_client' => Auth::user()->id,
            'bus_number' => $request->bus_number,
            'fuel' => $request->fuel,
            'television' => $request->television,
            'wifi' => $request->wifi,
            'ac' => $request->ac,
            'wheel_lift' => $request->wheel_lift,
            'articulation' => $request->articulation,
            'decker' => $request->decker
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Special Feature has been saved!');
    }

    public function addStation(Request $request)
    {

        $fare = Station::create([
            'from_client' => Auth::user()->id,
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'town_or_city' => $request->town_or_city,
            'region' => $request->region
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Station has been saved!');
    }



}
