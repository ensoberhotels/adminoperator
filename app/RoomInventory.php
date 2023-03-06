<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RoomInventory extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'room_booked_id', 'year', 'month','date', 'hotel_id', 'room_cat_id', 'no_of_room', 'staying_day','parent_booking_no','booking_status','source'
    ];

    /**
     * difine table name
     */
    protected $table = 'room_inventory';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function RoomBookedDetails(){
		return $this->hasOne('App\RoomBookedDetails', 'booked_no', 'room_booked_id');
	}
}
