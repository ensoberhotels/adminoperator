<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_type', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'room_types';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'ceated_at', 'updated_at'
    ];
	
	// Get room name details
    public function getRoomName(){
		return $this->belongsTo('App\RoomCategory','room_type');
	}
}
