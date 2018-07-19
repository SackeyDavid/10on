<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnBooking extends Model
{
    protected $table = 'return_booking_process';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outbound', 'inbound', 'passenger_id', 'card_id', 'made_payment', 'user_id', 'mobile_money_id', 'depart_checked_in', 'return_checked_in',
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

    public function departing() {
        return $this->belongsTo('App\Trips', 'outbound');
        
    }

    public function returning() {
        return $this->belongsTo('App\Trips', 'inbound');
        
    }

    public function mobileMoney() {
        return $this->belongsTo('App\MobileMoney', 'mobile_money_id');
        
    }
    
}
