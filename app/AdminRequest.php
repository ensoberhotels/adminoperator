<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AdminRequest extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'contact_id', 'operator_id','status','company_id','property_id','user_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'admin_requests';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function operator(){
		return $this->belongsTo('App\Operator');
	}
	
	public function contact(){
		return $this->belongsTo('App\Contacts','contact_id');
	}
	
    
   
}
