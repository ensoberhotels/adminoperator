<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class ActivityVoucher extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'voucher_no','send_quotation_no','parent_booking_no','booked_no','client_name','adults','chields','total_visitors','date','time','slot','confirmed_by','source','booking_from','total_bill','advance_received','balance','booking_status','voucher_note','payment_source','date_of_advance','created_at','updated_at','activity_id','mobile','email','destination','payment_type','pickup_point','no_of_jeeps','company_id','property_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'activiti_vouchers';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function activity(){ 
		return $this->belongsTo('App\ActivityCatSubcat', 'activity_id','activity_id');
	}
	
	public function Vender(){ 
		return $this->belongsTo('App\Vender', 'vendor_id');
	}
}
