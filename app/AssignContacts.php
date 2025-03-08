<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AssignContacts extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','mobile', 'email', 'location', 'contact_type', 'category','source','contact_id','operator_id','status','follow_up','follow_up_date','company_id','property_id','user_id' 
        ];

    /**
     * difine table name
     */
    protected $table = 'assign_contacts';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function followUpComment(){
		return $this->hasMany('App\FollowupContacts','assign_contact_id');
	}
	
	// Get asign contact operator
	public function asignContactOperator(){
		return $this->belongsTO('App\Operator','operator_id','id');
	}
}
