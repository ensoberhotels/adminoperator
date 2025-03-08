<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITITranportPriceList extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','fare', 'perday_km','perkm_fare','car_name'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_tranport_price_list';

    
}
