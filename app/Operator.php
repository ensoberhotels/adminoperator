<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country_id', 'region_id', 'city_id', 'status','hotel','room_inventory','view_only','room_status','assigned_hotels'
    ];

    /**
     * difine table name
     */
    protected $table = 'operators';

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
	
	public function hotelName(){
        return $this->belongsTo('App\Hotel', 'hotel');
    }
}
