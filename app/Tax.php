<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_NTA', 'passenger_service_charge', 'passenger_facilities_charge', 'advance_passenger_info_fee', 'station_service_charge', 'total', 'from_client', 'for_trip'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    public function author() {
    	return $this->belongsTo('App\Client', 'from_client');
        
    }

    public function trip() {
    	return $this->belongsTo('App\Trip', 'for_trip');
        
    }

}
