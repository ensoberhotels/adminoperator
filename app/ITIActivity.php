<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIActivity extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','city_id', 'activity_id', 'price', 'status','activity_date','activity_time'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_activities';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];

    // Get city name
    public function cityName(){
        return $this->belongsTo('App\City', 'city_id');
    }

    // Get activity details
    public function getActivity(){
        return $this->belongsTo('App\Activity', 'activity_id')->with('activityCat')->with('activitySubCat')->with('activityName')->with('stateName')->with('cityName')->with('venderName');
    }
	
}
