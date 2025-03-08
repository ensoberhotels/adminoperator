<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ActivityName extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_cat_id', 'activity_name', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'activity_names';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function ActivityCat(){
		return $this->belongsTo('App\ActivityCat'); 
	}
}
