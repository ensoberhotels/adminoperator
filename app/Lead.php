<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
  'lead_no', 'lead_source', 'reference_name', 'enquiry_type', 'hotel_id', 'other_enquiry', 'mobile', 'email', 'name', 'location', 'customer_type', 'lead_priority', 'trip_type', 'assign_to', 'hotel_type', 'city_id', 'region_id', 'country_id', 'start_date', 'end_date','no_nights', 'no_room', 'sharing', 'pax', 'kids', 'infant','create_date', 'status','lead_status','lead_comment','make_quatation','followup_date','followup_time','followup_status','today_followup','closed_status','company_id','property_id','user_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'leads';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function hotel(){
		return $this->belongsTo('App\Hotel');
	}
}
