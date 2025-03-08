<?php

namespace App;

use App\Notifications\AccountResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class WebsiteOrderPayment extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'order_id','razorpay_payment_id','amount'
    ];

    /**
     * Table name
     */
    protected $table = 'website_order_payments';

   
}
