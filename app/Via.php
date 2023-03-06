<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Via extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_destination','to_destination', 'via', 'distance', 'duration', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'via_routes';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'created_at', 'updated_at'
    ];
	
	public function startDistination(){
		return $this->belongsTo('App\City', 'start_destination');
	}
	
	public function toDistination(){
		return $this->belongsTo('App\City', 'to_destination');
	}
	
} 
