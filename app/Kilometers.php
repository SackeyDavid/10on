<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kilometers extends Model
{
    protected $table = 'kilometers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'via', 'kilometers', 'duration_via_automobile', 'from_developer', 'for_trip' 
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    public function author() {
    	return $this->belongsTo('App\Admin', 'from_developer');
        
    }
}
