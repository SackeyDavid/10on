<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileMoney extends Model
{
    protected $table = 'mobile_money_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number', 'email', 'from_user', 'from_passenger', 'name', 'network'
      ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
