<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RoomBookedDetails extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'booked_no', 'hotel', 'room_type','check_in', 'check_out', 'client_name', 'agent_name', 'total_rooms', 'noofrooms', 'plan', 'adults','kidswd', 'kidswd', 'infant', 'confirmed_by', 'source', 'booking_from', 'advance_amount','payment_source', 'date_of_advance', 'comment', 'payment_snapshot', 'comment_for_balace','extra_bill','extra_bill_comment','total_bill','parent_booking_no','booking_status','cancel_reason','company_id','property_id','user_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'room_booked_details';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function hotel(){
		return $this->belongsTo('App\Hotel','hotel','id');
	}
	
	public function hotelDetals(){
		return $this->belongsTo('App\Hotel','hotel','id');
	}
	
	/**
     * This function use for get meal plan short name by code
     *
     * @return string
     */
    public function getMealShortNameByCode($meal_plan){
		if($meal_plan == 'ep_price'){
			$plan_name = 'EP';
		}elseif($meal_plan == 'cp_price'){
			$plan_name = 'CP';
		}elseif($meal_plan == 'map_price'){
			$plan_name = 'MAP';
		}elseif($meal_plan == 'ap_price'){
			$plan_name = 'AP';
		}else{
			$plan_name = '';
		}
		return $plan_name;
    }
}
