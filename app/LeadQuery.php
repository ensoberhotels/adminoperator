<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class LeadQuery extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'lead_id', 'enquiry_type', 'hotel_id', 'other_enquiry', 'hotel_type', 'city_id', 'region_id', 'country_id', 'start_date', 'end_date', 'no_nights', 'no_room', 'sharing', 'pax', 'kids', 'infant', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'lead_queries';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
