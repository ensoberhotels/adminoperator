<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HotelAmenity extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amenity_id', 'hotel_id', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'hotel_amenities';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];
	
	public function getAmenity(){
		return $this->hasMany('App\Amenity', 'id', 'amenity_id');
	}
}
