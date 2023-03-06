<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'name','mobile', 'email', 'location', 'contact_type', 'category','source','last_lead_no', 'lead_count','status','website','agency_name','operator_id','additional_info','company_id','property_id','user_id'
        ];

    /**
     * difine table name
     */
    protected $table = 'contacts';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
	
	// Get asign contact
	public function asignContact(){
		return $this->belongsTO('App\AssignContacts','id','contact_id')->with('asignContactOperator');
	}
}
