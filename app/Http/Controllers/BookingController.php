<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;
use App\Trips;

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
    	$lpos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date)->orderBy('trip_cost')->get();

    	// lowest price inbounds (lpis)
    	$lpis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date)->orderBy('trip_cost')->get();

    	// earliest departure outbounds (eos)
    	$eos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date)->orderBy('departure_time')->get();

    	// earlest departure inbounds (eis)
    	$eis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date)->orderBy('departure_time')->get();

    	// shortest duration outbounds (sdos)
    	$sdos = Trips::where('departure_location', $request->departure_location)->where('arrival_location', $request->arrival_location)->where('departure_date', $request->departure_date)->orderBy('trip_duration_in_hrs')->get();

    	// sshortest duration inbounds (sdis)
    	$sdis = Trips::where('departure_location', $request->arrival_location)->where('arrival_location', $request->departure_location)->where('departure_date', $request->return_date)->orderBy('trip_duration_in_hrs')->get();

    	// array to store total cost for each outbound and inbound trip  
    	$combined_cost = array();

    	// loop through each collection to get trip costs and append their sum to $combine_cost array 
    	foreach ($lpos as $key => $lpo) {
            foreach ($lpis as $key => $lpi) {
            	// string key instead of int used to later split key's values
                 $combined_cost[$lpo->id . '-' . $lpi->id] = (float)$lpo->trip_cost + (float)$lpi->trip_cost;
            }
            
        }

        //sort combined_cost array values maintaining their keys
        asort($combined_cost);

        //append combined_cost keys to a keys array
        $combined_cost_keys = array_keys($combined_cost);

        //keys for earlisest departure EDK and earliest return ERK
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


    	

    	return view('book.search-return-trips-results', compact(['lpos', 'lpis', 'combined_cost','LPDK', 'LPRK', 'lpos_array']))->with('departure_location', $request->departure_location)->with('arrival_location', $request->arrival_location)->with('departure_date', $request->departure_date)->with('passenger_num', $request->passenger_num)->with('return_date', $request->return_date)->with('departure_abbreviation', $depart_abb)->with('arrival_abbreviation', $arrive_abb);
    }

}
