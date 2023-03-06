<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class DayWiseDetail extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		  'distination','day','image','description','created_by','last_udated_by','change_des'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_daywisedetails';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function getDistination(){ 
		return $this->belongsTo('App\City', 'distination'); 
	}
	
}
