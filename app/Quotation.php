<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
  'lead_no', 'lead_id', 'hotel_id','mobile', 'email', 'name', 'location', 'customer_type', 'lead_priority', 'trip_type','hotel_type', 'city_id', 'region_id', 'country_id', 'start_date', 'end_date','no_nights', 'no_room', 'sharing', 'pax', 'kids', 'infant','create_date', 'status','quotation_status','selected_hotel','price','assign_to','closed_reason','make_sale'
    ];

    /**
     * difine table name
     */
    protected $table = 'quotations';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
