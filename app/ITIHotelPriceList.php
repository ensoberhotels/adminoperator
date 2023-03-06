<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIHotelPriceList extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','rate', 'hotel_name'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_hotel_price_list';

    
}
