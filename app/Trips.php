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
        'departure_location', 'arrival_location', 'departure_time', 'arrival_time', 'departure_date', 'arrival_date', 'trip_duration_in_hrs', 'trip_fare', 'fare_id', 'bus_id', 'remaining_seats', 'via', 'published', 'from_client', 'kilometers', 'tax_id', 'departure_station_id', 'arrival_station_id' 
    ];

    
    protected $primaryKey = 'id';

    public function host() {
    	return $this->belongsTo('App\Client', 'from_client');
        
    }

    public function fare() {
        return $this->belongsTo('App\Fare', 'fare_id');
        
    }

    public function tax() {
        return $this->belongsTo('App\Tax', 'tax_id');
        
    }

    public function bus() {
        return $this->belongsTo('App\Bus', 'bus_id');
        
    }

    public function departure() {
        return $this->belongsTo('App\Station', 'departure_station_id');
        
    }

    public function arrival() {
        return $this->belongsTo('App\Station', 'arrival_station_id');
        
    }

    public function owbookings() {
        return $this->hasMany('App\OneWayBookingProcess', 'trip_id');
        
    }



}
