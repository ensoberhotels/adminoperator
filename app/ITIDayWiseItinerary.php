<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class ITIDayWiseItinerary extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		  'itinerary_no','day','image','description','distination','pickup','dropup','change_des'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_daywiseitineraries';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function getDistination(){ 
		return $this->belongsTo('App\City', 'distination');
	}
}
