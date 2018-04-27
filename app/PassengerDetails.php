<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengerDetails extends Model
{
    protected $table = 'passenger_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'first_name', 'last_name', 'email', 'contact_person', 'country', 'mobile_number', 'remind_me'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    
}
