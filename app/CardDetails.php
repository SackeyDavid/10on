<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    protected $table = 'card_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_number', 'expiry_date', 'security_code', 'for_user', 'first_name', 'for_passenger', 'last_name', 'country', 'address_line_1', 'address_line_2', 'address_line_3'
      ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'security_code'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    public function author() {
    	return $this->belongsTo('App\User', 'from_user');
        
    }

    public function owner() {
    	return $this->belongsTo('App\PassengerDetails', 'from_passenger');
    }

    public function setSecurityCodeAttribute($value)
    {
        $this->attributes['security_code'] = bcrypt($value);
    }
}
