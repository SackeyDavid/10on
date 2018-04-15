<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Station extends Model
{
    use SearchableTrait;

    protected $table = 'stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_client', 'name', 'abbreviation', 'town_or_city', 'region'
    ];

    /**
     * The attribute is autoincremented.
     *
     * @var int
     */
    

    protected $primaryKey = 'id';

    protected $searchable = [
        'columns' => [
            'name' => 10,
            'abbreviation' => 5,
            'town_or_city' => 3,
            'region' => 2,
            
        ],
        // 'joins' => [
        //     'profiles' => ['users.id','profiles.user_id'],
        // ],
    ];

    // protected $stations = Station::where("name", "LIKE", "%{$request->input($query)}%")->get();


    public function author() {
    	return $this->belongsTo('App\Client', 'from_client');
        
    }
}
