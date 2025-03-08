<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id','room_type_id', 'type', 'name', 'room_count', 'adult_extra_cost', 'kid_extra_cost', 'one_occupancy_cost', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'room_categorys';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];
}
