<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneWayBookingProcess extends Model
{
    protected $table = 'one_way_booking_process';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trip_id', 'passenger_id', 'card_id', 'made_payment', 'user_id', 'mobile_money_id', 'checked_in'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    // not all passengers would be registered users so before accessing the author object check if it exists
    
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
        
    }

    public function passenger() {
        return $this->belongsTo('App\PassengerDetails', 'passenger_id');
        
    }

    public function trip() {
        return $this->belongsTo('App\Trips', 'trip_id');
        
    }

    public function mobileMoney() {
        return $this->belongsTo('App\MobileMoney', 'mobile_money_id');
        
    }

    
}
