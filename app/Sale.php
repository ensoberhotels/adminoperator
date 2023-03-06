<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'lead_id', 'quotation_id', 'operator_id','vender_id', 'user_id', 'total_amount', 'paid_amount', 'due_amount', 'payment_method', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'sales';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
