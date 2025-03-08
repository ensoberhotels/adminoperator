<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model 
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['send_quotation_no','name','no_of_peoples','pay_screenshort','amount','payment_to','payment_received','create_by','hotel','checkin_date','approval_date'
    ];

    /**
     * difine table name
     */
    protected $table = 'payment_histories';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
}
