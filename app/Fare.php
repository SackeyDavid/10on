<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    protected $table = 'fares';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_point', 'destination', 'road_fare', 'carrier_imposed_charges', 'total_tax', 'total_per_passenger', 'from_client'
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

}
