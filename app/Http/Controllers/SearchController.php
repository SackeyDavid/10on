<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trips;
use DB;
use Pagination;

class SearchController extends Controller
{
    public function search(Request $request) {

    	$search_item = $request->ow_arrival_location;

        $departure = $request->ow_departure_station;

        $passenger_num = $request->passenger_num;

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
}
