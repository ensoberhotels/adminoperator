<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIPrice extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','price_type', 'price', 'total_price', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_prices';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
}
