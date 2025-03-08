<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIHotel extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','distination','hotel','room_type','meal_plan','no_of_rooms','no_of_nights','rate','arrival_date', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_hotels';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];

    // Get hotel details
    public function getHotel(){
		return $this->belongsTo('App\Hotel','hotel');
	}

    // Get distination details
    public function getdistination(){
		return $this->belongsTo('App\City','distination');
	}

    // Get room type details
    public function getRoomType(){
		return $this->belongsTo('App\RoomTypes','room_type')->with('getRoomName');
	}
	
	

    
	
}
