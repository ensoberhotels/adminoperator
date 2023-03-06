<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','operator_id', 'from', 'to', 'cc', 'to_name','subject','hotel_id', 'template','send_date','send_time','company_id','property_id','user_id'
        ];

    /**
     * difine table name
     */
    protected $table = 'email_historys';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
	
	// Get asign contact
	public function getOperator(){
		return $this->belongsTO('App\Operator','id','operator_id');
	}
}
