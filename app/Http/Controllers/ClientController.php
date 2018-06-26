<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Fare;
use App\Bus;
use App\Trips;
use App\Tax;
use App\SpecialFeatures;
use App\Station;
use Auth;
use DB;

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
        $departure_location = Station::find($request->departure_station_id);
        $arrival_location = Station::find($request->arrival_station_id);

        $fare = Trips::create([
            'from_client' => Auth::user()->id,
            'departure_station_id' => $request->departure_station_id,
            'arrival_station_id' => $request->arrival_station_id,
            'departure_location' => $departure_location->name,
            'arrival_location' => $arrival_location->name,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'departure_date' => $request->departure_date,
            'arrival_date' => $request->arrival_date,
            'remaining_seats' => $request->remaining_seats,
            'via' => $request->via,
            'trip_duration_in_hrs' => $request->trip_duration_in_hrs,
            'trip_fare' => $request->trip_fare,
            'bus_id' => $request->bus_id,
        ]);

        return redirect()->route('client.dashboard')->with(['msg' => 'Trip has been saved! Add fare breakdown']);
    }

    
    public function addTax(Request $request)
    {
        $tax = Tax::create([
            'from_client' => Auth::user()->id,
            'tax_NTA' => $request->tax_NTA,
            'passenger_service_charge' => $request->passenger_service_charge,
            'passenger_facilities_charge' => $request->passenger_facilities_charge,
            'advance_passenger_info_fee' => $request->advance_passenger_info_fee,
            'station_service_charge' => $request->station_service_charge,
            'for_trip' => $request->trip_id,
            'total' => $request->total,
        ]);

        DB::table('trips')->where('id', $request->trip_id )->update(['tax_id' => $tax->id]);

        return redirect()->route('client.dashboard')->with('msg', 'Tax has been saved to the specifed trip!');
    }

    public function addFare(Request $request)
    {
        $fare = Fare::create([
            'from_client' => Auth::user()->id,
            'for_trip' => $request->trip_id,
            'road_fare' => $request->road_fare,
            'carrier_imposed_charges' => $request->carrier_imposed_charges,
            'total_tax' => $request->total_tax,
            'total_per_passenger' => number_format($request->total_per_passenger, 2)
        ]);

        DB::table('trips')->where('id', $request->trip_id )->update(['fare_id' => $fare->id]);

        return redirect()->route('client.dashboard')->with('msg', 'Fare has been saved to the specifed trip! Add Tax breakdown');
    }

    public function addBus(Request $request)
    {
        $fare = Bus::create([
            'from_client' => Auth::user()->id,
            'bus_number' => $request->bus_number,
            'capacity' => $request->capacity,
            'photo' => $request->photo,
            'brand_name' => $request->brand_name,
            'driver' => $request->driver,
        ]);

        return redirect()->route('client.dashboard')->with('msg', 'Bus has been saved!');
    }

    public function addSpecialFeatures(Request $request)
    {
        $spFeature = SpecialFeatures::create([
            'from_client' => Auth::user()->id,
            'bus_id' => $request->bus_id,
            'fuel' => $request->fuel,
            'television' => $request->television,
            'wifi' => $request->wifi,
            'ac' => $request->ac,
            'wheel_lift' => $request->wheel_lift,
            'articulation' => $request->articulation,
            'decker' => $request->decker
        ]);

         DB::table('buses')->where('id', $request->bus_id)->update(['special_feature_id' => $spFeature->id]);

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

    public function deleteFare($id, $for_trip) 
    {
            $fare = Fare::find($id);

            $fare->delete();
            

            DB::table('trips')->where('id', $for_trip)->update(['fare_id' => null]);

        return redirect()->route('client.dashboard')->with('msg', 'Fare has been deleted and Trip updated!');

    }

    public function deleteTax($id, $for_trip) 
    {
            $tax = Tax::find($id);

            $tax->delete();
            

            DB::table('trips')->where('id', $for_trip)->update(['tax_id' => null]);

        return redirect()->route('client.dashboard')->with('msg', 'Tax has been deleted and Trip updated!');

    }

    public function deleteTrip($id) 
    {
            $trip = Trips::find($id);
            $trip->delete();

            $tax = Tax::where('for_trip', $id);
            if ($tax) {
                $tax->delete();
            }

            $fare = Fare::where('for_trip', $id);
            if ($fare) {
                $fare->delete();
            }
            
            

            

        return redirect()->route('client.dashboard')->with('msg', 'Trip has been deleted and its Tax and/or Fare breakdown deleted!');

    }



}
