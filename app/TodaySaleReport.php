<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class TodaySaleReport extends Model 
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'send_quotation_no','name','mobile','email','checkin','checkout','rooms','night','adult','kids','infant','cost','per_night_cost','advance_received','confirmed_by','created_at'
    ];

    /**
     * difine table name
     */
    protected $table = 'today_sale_report';

}
