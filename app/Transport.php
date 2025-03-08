<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id','vender_id','vender_approved', 'available_seat', 'country_id', 'region_id', 'city_id', 'car_segment_id', 'car_model_id', 'car_seats_id', 'type', 'fare', 'perday_km', 'perkm_fare', 'status','toll','tax','parking','allowance'
    ];

    /**
     * difine table name
     */
    protected $table = 'transports';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function car(){
		return $this->belongsTo('App\Car');
	}
    public function venderName(){
        return $this->belongsTo('App\Vender', 'vender_id');
    }
    
    public function car_segment(){
        return $this->belongsTo('App\CarSegment');
    }
    
    public function car_model(){
        return $this->belongsTo('App\CarModel');
    }
    
    public function car_seats(){
        return $this->belongsTo('App\CarSeats');
    }
    
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
