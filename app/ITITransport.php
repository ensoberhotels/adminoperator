<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITITransport extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','transport_id', 'status','fare', 'perday_km', 'perkm_fare'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_transports';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];

    // Get transport details
    public function getTransport(){
		return $this->belongsTo('App\Transport','transport_id')->with('car')->with('car_segment')->with('car_model')->with('car_seats')->with('venderName');
	}

    // Get transport details
    public function getPrice(){
		return $this->belongsTo('App\ITIPrice','itinerary_no','itinerary_no')->where('price_type','transport');
	}
	
}
