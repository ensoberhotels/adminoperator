<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HotelGroupSeasonRate extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id','room_type_id', 'start_date', 'end_date', 'from_no_person', 'to_no_person', 'single_sharing', 'double_sharing', 'triple_sharing', 'quad_sharing', 'penta_sharing', 'group_rate', 'per_person_rate', 'per_night_rate', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'group_rate_hotels';

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
  public function room_category(){
        return $this->belongsTo('App\RoomCategory','room_type_id');
    }
}
