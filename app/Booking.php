<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking_process';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outbound', 'inbound', 'passenger_id', 'card_id', 'made_payment', 'user_id', 'mobile_money_id'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    // not all passengers would be registered users so before accessing the author object check if it exists
    
    public function author() {
    	return $this->belongsTo('App\User', 'passenger_id');
        
    }
}
