<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HotelSeasonRate extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id','room_type_id', 'room_category_id', 'start_date', 'end_date', 'discount', 'ep_price', 'cp_price', 'map_price', 'ap_price', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'hotel_season_rates';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'created_at', 'updated_at'
    ];
	
	public function hotel(){
		return $this->belongsTo('App\Hotel');
	}
	
	public function RoomCategory(){
		return $this->belongsTo('App\RoomCategory');
	}
    
    public function RoomType(){
        return $this->belongsTo('App\RoomTypes');
    }
}
