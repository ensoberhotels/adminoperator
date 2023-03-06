<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ITIRoute extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_no','start_distination', 'to_distination', 'via', 'distance', 'duration', 'status','pickup','dropup'
    ];

    /**
     * difine table name
     */
    protected $table = 'iti_routes';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];

    // Get the start distination
    public function getStartDistination(){
        return $this->belongsTo('App\City', 'start_distination');
    }

    // Get the to distination
    public function getToDistination(){
        return $this->belongsTo('App\City', 'to_distination');
    }
	
}
