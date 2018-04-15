<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{


	protected $table = 'trips';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'departure_location', 'arrival_location', 'departure_time', 'arrival_time', 'departure_date', 'arrival_date', 'trip_duration_in_hrs', 'trip_cost', 'fare_id', 'bus_id', 'remaining_seats', 'via', 'published', 'from_client', 'kilometers' 
    ];

    
    protected $primaryKey = 'id';

    public function host() {
    	return $this->belongsTo('App\Client', 'from_client');
        
    }


}
