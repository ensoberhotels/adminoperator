<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIBasicInfo extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','adult', 'kids', 'infant', 'tour_type', 'arrival_date', 'arrival_time', 'arrival_city', 'drop_date', 'drop_time', 'drop_city', 'created_by', 'status','total_night','rate_show','name','mobile','comment'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_basic_info';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];

    // Get arrival city name
    public function arrivalCity(){
		return $this->belongsTo('App\City','arrival_city');
	}
	
    // Get arrival city name
    public function dropCity(){
		return $this->belongsTo('App\City','drop_city');
	}
}
