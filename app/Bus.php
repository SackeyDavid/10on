<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'buses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_client', 'bus_number', 'capacity', 'photo', 'brand_name', 'driver'
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
