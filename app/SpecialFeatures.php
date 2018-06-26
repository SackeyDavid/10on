<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialFeatures extends Model
{
    protected $table = 'special_features';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bus_id', 'fuel', 'television', 'wifi', 'ac', 'wheel_lift', 'articulation', 'decker', 'from_client'
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
