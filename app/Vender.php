<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Vender extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vender_type', 'country_id', 'region_id', 'city_id', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'venders';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];
	
	
	
	public function countryName(){
		return $this->belongsTo('App\Country', 'country_id');
	}
	
	public function stateName(){
		return $this->belongsTo('App\Region', 'region_id');
	}
	
	public function cityName(){
		return $this->belongsTo('App\City', 'city_id');
	}
}
