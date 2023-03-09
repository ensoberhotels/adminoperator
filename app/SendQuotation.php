<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SendQuotation extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'send_quotation_no', 'distination', 'hotel_id','checkin', 'checkout', 'room_type', 'meal_type', 'rooms', 'night', 'adult','kids', 'infant', 'name', 'mobile', 'email', 'cost', 'per_night_cost', 'total_cost','email_send','discount','final_cost','agent_name','confirmed_by','advance_received','balance','voucher_note','quotation_type','room_inventory_checkbox','booking_from','source','payment_source','date_of_advance','booking_status','comment','agent_email','agent_mobile','checkin_checkout_status','closed_f_owner','closed_f_vendor','quotation_note','company_id','property_id','user_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'send_quotations';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function QuotationRate(){
        return $this->hasOne('App\SendQuotationRate');
    }
	
	public function orderpayment(){
        return $this->hasMany('App\PaymentHistory', 'send_quotation_no', 'send_quotation_no');
    }
}
