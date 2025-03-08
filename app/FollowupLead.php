<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FollowupLead extends Model 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lead_id','operator_id','followup_date','followup_time','comment','flag'
        ];

    /**
     * difine table name
     */
    protected $table = 'followup_leads';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	public function getOperator(){		
		return $this->hasOne('App\Operator', 'id', 'operator_id');	
	}
}
