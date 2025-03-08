<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIActivitiPriceList extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','activity_name', 'price'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_activiti_price_list';

    
}
