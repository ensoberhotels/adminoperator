<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vender_id','vender_approved', 'hotel_name', 'hotel_image', 'address', 'googleaddress', 'country_id', 'region_id', 'city_id', 'lat', 'long', 'contact_name', 'contact_number', 'contact_email', 'total_room', 'amenities_ids', 'start_category', 'property_type', 'child_age', 'per_night', 'per_person', 'group_rate', 'hotel_gallery_id', 'gallery_link', 'group_min_person','status','payment_details','cancelation_policy','child_extra_cost_wod','hotel_logo','company_id','property_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'hotels';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];
	
	public function seasonRate(){
		return $this->hasMany('App\HotelSeasonRate');
	}
	
	public function RoomCategory(){
		return $this->hasMany('App\RoomCategory');
	}
	
	public function HotelAmenity(){
		return $this->hasMany('App\HotelAmenity')->with('getAmenity');
	}
	
	public function HotelGallery(){
		return $this->hasMany('App\HotelGallery');
	}
	
	
	public function city(){		
		return $this->belongsTo('App\City');	
	}
}
