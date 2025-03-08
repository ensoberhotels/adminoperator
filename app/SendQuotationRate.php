<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SendQuotationRate extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'send_quotation_no', 'send_quotation_id', 'check_in','hotel_id', 'room_type_id', 'per_night_cost', 'adult_extra_cost', 'one_occupancy_cost', 'child_extra_cost_wd', 'child_extra_cost_wod', 'meal_type','cost','discount','offer_cost'
    ];

    /**
     * difine table name
     */
    protected $table = 'send_quotation_rates';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function RoomType(){
		return $this->hasOne('App\RoomTypes', 'id', 'room_type_id');
	}
}
