<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
    protected $fillable = [
            'title','first_name', 'last_name','email', 'contact_person', 'country', 'mobile_number', 'remind_me', 'membership_number', 'agree', 'password', 'card_id', 'mobile_money_id', 'kilometers',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'id';

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function card() {
        return $this->belongsTo('App\CardDetails', 'card_id');
        
    }

    public function wallet() {
        return $this->belongsTo('App\MobileMoney', 'mobile_money_id');
        
    }

    public function routeNotificationForSMS()
    {
        return $this->mobile_number; 
    }
    
}
