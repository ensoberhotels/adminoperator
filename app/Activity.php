<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class Activity extends Model 
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_cat_id','vender_id', 'vender_approved', 'activity_name_id', 'activity_subcat_id', 'country_id', 'region_id', 'city_id', 'price', 'status','image','morning_slot','evening_slot','activity_name','actual_price'
    ];

    /**
     * difine table name
     */
    protected $table = 'activities';

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
	
	public function activitySubCat(){
		return $this->belongsTo('App\ActivitySubCat', 'activity_subcat_id');
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
    public function venderName(){
        return $this->belongsTo('App\Vender', 'vender_id');
    }
}
