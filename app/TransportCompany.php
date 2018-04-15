<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportCompany extends Model
{
    protected $table = 'transport_companies';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'photo', 'number_of_admins', 'from_developer'
    ];

    
    protected $primaryKey = 'id';

    public function author() {
    	return $this->belongsTo('App\Admin', 'from_developer');
        
    }

}
