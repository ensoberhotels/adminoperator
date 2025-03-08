<?php

namespace App; 

use App\Notifications\AccountResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WebsiteOrder extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array 
     */
    protected $fillable = [
        'order_id','name','mobile','email','adult','kids','infant','checkin','checkout','total_room','room_name','meal_plan','room_charge','no_adult','no_of_kid','no_of_infant','created_at','updated_at','website','total_amount','hotel_name'
    ];

    /**
     * Table name
     */
    protected $table = 'website_orders';
	
	public function orderpayment(){
        return $this->belongsTo('App\WebsiteOrderPayment', 'order_id', 'order_id');
    }

   
}
