<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ActivitySubCat extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_cat_id', 'activity_name_id', 'activity_subcat', 'country_id', 'region_id', 'city_id', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'activity_subcats';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function activityCat(){
		return $this->belongsTo('App\ActivityCat', 'activity_cat_id');
	}
	
	public function activityName(){
		return $this->belongsTo('App\ActivityName', 'activity_name_id');
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
